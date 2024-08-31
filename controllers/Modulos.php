<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Modulos extends Controller
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

    //Cargar datos en tabla
    public function listarModulos()
    {
        $data = $this->model->getModulos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getModulosSelect()
    {
        $data = $this->model->getModulosSelect();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function insertarModulo() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $nombre = strClean($_POST['nombre']);
            $descripcion = strClean($_POST['descripcion']);
            $fechaCreacion = date('Y-m-d H:i:s');
            $creadoPor = $_SESSION['usuario'];

            $data = $this->model->insertarModulo($nombre,$descripcion,$fechaCreacion,$creadoPor);
            if ($data > 0) {
                $bitacora = new Bitacora();
                $bitacora->model->crearEvento($_SESSION['id_usuario'], 13, 'CREACION', 'Se creó un nuevo módulo en el sistema', date('Y-m-d H:i:s'));
                $res = array('titulo' => 'Módulo Registrado', 
                        'desc' => 'El módulo se ha registrado exitosamente', 
                        'type' => 'success');
            } else {
                $res = array('titulo' => 'Error', 
                            'desc' => 'Hubo un problema al registrar el módulo', 
                            'type' => 'error');
            }
            
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Actualizar sexos
    public function actualizarModulo() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $nombre = strClean($putData['nombre']);
                $descripcion = strClean($putData['descripcion']);
                $fechaModificacion = date('Y-m-d H:i:s');
                $modificadoPor = $_SESSION['usuario'];
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarModulo($nombre,$descripcion,$fechaModificacion,$modificadoPor, $id);
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 13, 'ACTUALIZACION', 'Se actualizó la información del módulo con id '.$id, date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Módulo Actualizado', 
                                 'desc' => 'El módulo se ha actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar el módulo', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Obtener datos de sexo para edición
    public function obtenerModulo($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->obtenerModulo($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
   

    public function eliminarModulo($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarModulo($id);
                
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 13, 'ELIMINACION', 'Se eliminó el módulo con id '.$id, date('Y-m-d H:i:s'));
                    
                    $res = array('titulo' => 'Modulo Eliminado', 
                                'desc' => 'El modulo se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar el modulo seleccionado', 
                                'type' => 'success');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

}