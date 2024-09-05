<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Plantillas extends Controller
{
    private $id_usuario;
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (!empty($_SESSION['id_usuario'])) {
            $this->id_usuario = $_SESSION['id_usuario'];
        }
    }

    private function verificarSesion()
    {
        if (empty($this->id_usuario)) {
            echo json_encode([
                'titulo' => 'Acceso Denegado',
                'desc' => 'Debes iniciar sesión para realizar esta acción.',
                'type' => 'error'
            ], JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Cargar datos en tabla
    public function listarPlantillas()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->listarPlantillas();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    

    public function descargarArchivo() {
        $this->verificarSesion();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (!$id) {
                die("ID inválido.");
            }
            
            $data = $this->model->obtenerRutaArchivo($id);
            
            $ruta_base = realpath('./assets/');
            $ruta_archivo = realpath($data['ruta_archivo']);

            // Verifica que el archivo está dentro del directorio permitido
            if (strpos($ruta_archivo, $ruta_base) !== 0) {
                die("Acceso no autorizado.");
            }

            if ($ruta_archivo && file_exists($ruta_archivo)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($ruta_archivo) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($ruta_archivo));

                ob_clean();
                flush();
                readfile($ruta_archivo);
                die();
            } else {
                echo "El archivo no se encuentra en el servidor.";
                die();
            }
        }
    }

}