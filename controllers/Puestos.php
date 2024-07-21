<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Puestos extends Controller
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
    public function listarPuestos()
    {
        $data = $this->model->getPuestos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getEstados(){
        $data = $this->model->getEstados();
        $res = array('estados'=>$data, 'type'=>'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    //Registrar sexos
    public function insertarSede() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['ubicacion'])) {
                $res = array('titulo' => 'Error', 
                            'desc' => 'La ubicación no puede ir vacío', 
                            'type' => 'warning');
            }else {
                $depatamento = strClean($_POST['departamento']);
                $municipio = strClean($_POST['municipio']);
                $ubicacion = strClean($_POST['ubicacion']);
    
                $data = $this->model->insertarSede($depatamento,$municipio,$ubicacion);
                
                if ($data > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA ' . $nombres, 1);
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
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarSede($departamento, $municipio, $ubicacion, $id);
                if ($data > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL AREA ' . $nombres, 1);
                    $res = array('titulo' => 'Sexo Actualizado', 
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
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->obtenerSede($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar sede
    public function eliminarSede($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarSede($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ELIMINACION', 'SE HA ELIMINADO EL AREA ' . $id, 1);
                    
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