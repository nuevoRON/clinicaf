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
    public function getCitaciones()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getCitaciones();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function getNumerosCasos(){
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getNumerosCasos();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Registrar Puestos
    public function insertarCitacion() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numeroCaso = strClean($_POST['num_caso']);
            $tipoCitacion = strClean($_POST['tipo_citacion']);
            $fechaRecibe = strClean($_POST['fecha_rec_citacion']);
            $fechaCitacion = strClean($_POST['fecha_citacion']);
            $medico = strClean($_POST['medico']);
            $lugarCitacion = strClean($_POST['lugar_citacion']);

            $validacionFecha = $this->validarFecha($fechaCitacion);
                if($validacionFecha == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha de citación no puede ser menor que la fecha actual', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

            $validacionFechaCitacion = $this->validarFechaCitacion($fechaRecibe);
                if($validacionFechaCitacion == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha en que se recibe la citación no puede ser diferente de la fecha de hoy', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

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
        $this->verificarSesion();

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

                $validacionFecha = $this->validarFecha($fechaCitacion);
                if($validacionFecha == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha de citación no puede ser menor que la fecha actual', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

                $validacionFechaCitacion = $this->validarFechaCitacion($fechaRecibe);
                if($validacionFechaCitacion == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha en que se recibe la citación no puede ser diferente de la fecha de hoy', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

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
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getCitacion($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar Puesto
    public function eliminarCitacion($id){
        $this->verificarSesion();

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

    private function validarFecha($fechaCitacion){
        $fechaCitacion = new DateTime($fechaCitacion);
        $fechaActual = new DateTime(); 
        
        // Normalizar ambas fechas al día, eliminando la parte de la hora
        $fechaCitacion->setTime(0, 0, 0);
        $fechaActual->setTime(0, 0, 0);
    
        if ($fechaCitacion >= $fechaActual) {
            return true;
        } else {
            return false;
        }
    }

    private function validarFechaCitacion($fechaRecibe) {
        $fechaRecibe = new DateTime($fechaRecibe);
        $fechaActual = new DateTime(); 
        
        // Normalizar ambas fechas al día, eliminando la parte de la hora
        $fechaRecibe->setTime(0, 0, 0);
        $fechaActual->setTime(0, 0, 0);
    
        if ($fechaRecibe == $fechaActual) {
            return true;
        } else {
            return false;
        }
    }

}