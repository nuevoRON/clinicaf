<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Reconocimiento extends Controller
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
    public function listarReconocimientos()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getReconocimientos();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    //Registrar reconocimiento
    public function insertarReconocimientos() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['reconocimiento'])) {//recocnocimiento viene de la vista
                $res = array('titulo' => 'Error', 
                            'desc' => 'El reconocimiento no puede ir vacío', 
                            'type' => 'warning');
            }else {
                $nom_reco = strClean($_POST['reconocimiento']);//reconocimiento viene de la vista
    
                $data = $this->model->insertarReconocimientos($nom_reco);
                
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'Se creó un nuevo tipo de reconocimiento en el sistema ', date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Reconocimiento Registrado', 
                            'desc' => 'El reconocimiento se ha registrado exitosamente', 
                            'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un problema al registrar el reconocimiento', 
                                'type' => 'error');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Actualizar Puestos
    public function actualizarReconocimientos() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['reconocimiento'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $nom_reco = strClean($putData['reconocimiento']);
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarReconocimientos($nom_reco, $id);
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACION', 'Se actualizó la información del reconocimiento con id '.$id, date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Reconocimiento Actualizado', 
                                 'desc' => 'El reconocimiento se ha actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar el reconocimiento', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Obtener datos de sexo para edición
    public function obtenerReconocimientos($id) {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->obtenerReconocimientos($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar Puesto
    public function eliminarReconocimientos($id){
        $this->verificarSesion();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarReconocimientos($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ELIMINACION', 'Se eliminó el reconocimiento con id '.$id, date('Y-m-d H:i:s'));
                    
                    $res = array('titulo' => 'Reconocimiento Eliminado', 
                                'desc' => 'El reconocimiento se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar el reconocimiento seleccionada', 
                                'type' => 'warning');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

}