<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Citaciones extends Controller
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
    public function getCitaciones()
    {
        $data = $this->model->getCitaciones();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getNumerosCasos(){
        $data = $this->model->getNumerosCasos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    //Registrar Puestos
    public function insertarCitacion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numeroCaso = strClean($_POST['num_caso']);
            $tipoCitacion = strClean($_POST['tipo_citacion']);
            $fechaRecibe = strClean($_POST['fecha_rec_citacion']);
            $fechaCitacion = strClean($_POST['fecha_citacion']);
            $medico = strClean($_POST['medico']);
            $lugarCitacion = strClean($_POST['lugar_citacion']);

            $data = $this->model->insertarCitacion($numeroCaso,$tipoCitacion,$fechaRecibe,$fechaCitacion,$medico,$lugarCitacion);
            
            if ($data > 0) {
                $bitacora = new Bitacora();
                $bitacora->model->crearEvento($_SESSION['id_usuario'], 5, 'CREACION', 'Se creó una nueva citación en el sistema', date('Y-m-d H:i:s'));
                $res = array('titulo' => 'Citación Registrada', 
                        'desc' => 'La citación se ha registrado exitosamente', 
                        'type' => 'success');
            } else {
                $res = array('titulo' => 'Error', 
                            'desc' => 'Hubo un problema al registrar la citación', 
                            'type' => 'error');
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Actualizar Puestos
    public function actualizarCitacion() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $numeroCaso = strClean($putData['num_caso']);
                $tipoCitacion = strClean($putData['tipo_citacion']);
                $fechaRecibe = strClean($putData['fecha_rec_citacion']);
                $fechaCitacion = strClean($putData['fecha_citacion']);
                $medico = strClean($putData['medico']);
                $lugarCitacion = strClean($putData['lugar_citacion']);
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarCitacion($numeroCaso,$tipoCitacion,$fechaRecibe,$fechaCitacion,$medico,$lugarCitacion, $id);
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 5, 'ACTUALIZACION', 'Se actualizó la citación con id '.$id, date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Citación Actualizada', 
                                 'desc' => 'La citación se ha actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar la citación', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Obtener datos de citacion para edición
    public function obtenerCitacion($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getCitacion($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar Puesto
    public function eliminarCitacion($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarCitacion($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 5, 'CREACION', 'Se eliminó la citación con id '.$id, date('Y-m-d H:i:s'));
                    
                    $res = array('titulo' => 'Citación Eliminada', 
                                'desc' => 'La citación se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar la citación seleccionada', 
                                'type' => 'warning');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

}