<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Sedes extends Controller
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
    public function listarSedes()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getSedes();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Registrar sexos
    public function insertarSede() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['ubicacion'])) {
                $res = array('titulo' => 'Error', 
                            'desc' => 'La ubicación no puede ir vacío', 
                            'type' => 'warning');
            }else {
                $depatamento = strClean($_POST['departamento']);
                $municipio = strClean($_POST['municipio']);
                $ubicacion = strClean($_POST['ubicacion']);
                $cod_alfabetico = strClean($_POST['cod_alfabetico']);
                $cod_numerico = strClean($_POST['cod_numerico']);
    
                $data = $this->model->insertarSede($depatamento,$municipio,$ubicacion, $cod_alfabetico, $cod_numerico);
                
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 8, 'CREACION', 'Se creó una nueva sede', date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Sede Registrada', 
                            'desc' => 'La sede se ha registrado exitosamente', 
                            'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un problema al registrar la sede', 
                                'type' => 'error');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Actualizar sexos
    public function actualizarSede() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['ubicacion'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $ubicacion = strClean($putData['ubicacion']);
                $departamento = strClean($putData['departamento']);
                $municipio = strClean($putData['municipio']);
                $cod_alfabetico = strClean($putData['cod_alfabetico']);
                $cod_numerico = strClean($putData['cod_numerico']);
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarSede($departamento, $municipio, $ubicacion, $cod_alfabetico, $cod_numerico, $id);
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 8, 'ACTUALIZACION', 'Se actualizó la sede con id '.$id, date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Sede Actualizada', 
                                 'desc' => 'La sede se ha actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar la sede', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Obtener datos de sexo para edición
    public function obtenerSede($id) {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->obtenerSede($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar sede
    public function eliminarSede($id){
        $this->verificarSesion();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarSede($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 8, 'ELIMINACION', 'Se eliminó la sede con id '.$id, date('Y-m-d H:i:s'));
                    
                    $res = array('titulo' => 'Sede Eliminada', 
                                'desc' => 'La sede se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar la sede seleccionada', 
                                'type' => 'warning');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

}