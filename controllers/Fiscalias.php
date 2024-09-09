<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Fiscalias extends Controller
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
    public function listarFiscalias()
    {
        $this->verificarSesion();
        $data = $this->model->getFiscalias();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    //Registrar sexos
    public function insertarFiscalia() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = strClean($_POST['nombre']);

            $data = $this->model->insertarFiscalia($nombre);
            if ($data > 0) {
                $bitacora = new Bitacora();
                $bitacora->model->crearEvento($_SESSION['id_usuario'], 16, 'CREACION', 'Se creó una fiscalia en el sistema', date('Y-m-d H:i:s'));
                $res = array('titulo' => '  Fiscalia Registrado', 
                        'desc' => 'La fiscalia se ha registrado exitosamente', 
                        'type' => 'success');
            } else {
                $res = array('titulo' => 'Error', 
                            'desc' => 'Hubo un problema al registrar la fiscalia', 
                            'type' => 'error');
            }
            
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Actualizar sexos
    public function actualizarFiscalia() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $nombre = strClean($putData['nombre']);
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarFiscalia($nombre, $id);
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 16, 'ACTUALIZACION', 'Se actualizó la fiscalia con id '.$id, date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Fiscalia Actualizada', 
                                 'desc' => 'La fiscalia se ha actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar la fiscalia', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Obtener datos para edición
    public function obtenerFiscalia($id) {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->obtenerFiscalia($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar 
    public function eliminarFiscalia($id){
        $this->verificarSesion();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarFiscalia($id);
                
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 16, 'ELIMINACION', 'Se actualizó la fiscalia con id '.$id, date('Y-m-d H:i:s'));
                    
                    $res = array('titulo' => 'Fiscalia Eliminada', 
                                'desc' => 'La fiscalia se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar la fiscalia seleccionada', 
                                'type' => 'success');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

}