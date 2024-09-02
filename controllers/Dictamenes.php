<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Dictamenes extends Controller
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
    public function getDictamenes()
    {
        $data = $this->model->getDictamenes();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getTranscripciones()
    {
        $data = $this->model->getTranscripciones();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getNumerosCasosTranscripcion()
    {
        $data = $this->model->getNumerosCasosTranscripcion();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    /* Funciones para la sección de dictamenes */
    public function insertarDictamen() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numeroCaso = strClean($_POST['num_caso']);
            $fechaEvaluacion = strClean($_POST['fecha_evaluacion']);
            $fechaEntrega = strClean($_POST['fecha_entrega']);
            $autoridadSolicitante = strClean($_POST['autoridad_soli']);
            $medico = strClean($_POST['medico']);
            $datosExtra = strClean($_POST['datos_extra']);

            $validarDictamen = $this->model->verExistenciaCaso($numeroCaso);
            if ($validarDictamen > 0){
                $res = array('titulo' => 'Error', 
                            'desc' => 'El número de caso ya se encuentra registrado en un dictamen, seleccione otro', 
                            'type' => 'error');
                echo json_encode($res, JSON_UNESCAPED_UNICODE);
                die();
            }

            $data = $this->model->insertarDictamen($numeroCaso,$fechaEvaluacion,$fechaEntrega,
            $autoridadSolicitante,$medico,$datosExtra);
            
            if ($data > 0) {
                $bitacora = new Bitacora();
                $bitacora->model->crearEvento($this->id_usuario, 6, 'CREACION', 'Se creó un nuevo dictamen en el sistema', date('Y-m-d H:i:s'));
                $res = array('titulo' => 'Dictamen Registrado', 
                        'desc' => 'El dictamen se ha registrado exitosamente', 
                        'type' => 'success');
            } else {
                $res = array('titulo' => 'Error', 
                            'desc' => 'Hubo un problema al registrar el dictamen', 
                            'type' => 'error');
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Actualizar
    public function actualizarDictamen() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $numeroCaso = strClean($putData['num_caso']);
                $fechaEvaluacion = strClean($putData['fecha_evaluacion']);
                $fechaEntrega = strClean($putData['fecha_entrega']);
                $autoridadSolicitante = strClean($putData['autoridad_soli']);
                $medico = strClean($putData['medico']);
                $datosExtra = strClean($putData['datos_extra']);
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarDictamen($numeroCaso,$fechaEvaluacion,$fechaEntrega,
                $autoridadSolicitante,$medico,$datosExtra, $id);
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($this->id_usuario, 6, 'ACTUALIZACION', 'Se actualizó el dictamen con id '.$id, date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Dictamen Actualizado', 
                                 'desc' => 'El dictamen se ha actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar el dictamen', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Obtener datos de dictamen para edición
    public function obtenerDictamen($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getDictamen($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar 
    public function eliminarDictamen($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarDictamen($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($this->id_usuario, 6, 'ELIMINACION', 'Se eliminó el dictamen con id '.$id, date('Y-m-d H:i:s'));
                    
                    $res = array('titulo' => 'Dictamen Eliminado', 
                                'desc' => 'El dictamen se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar el dictamen seleccionado', 
                                'type' => 'warning');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    /* Funciones para la sección de transcripciones y ampliaciones */
    public function insertarTranscripcion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idDictamen = strClean($_POST['num_casoTranscripcion']);
            $fechaEvaluacion = strClean($_POST['fecha_evaluacionTranscripcion']);
            $fechaEntrega = strClean($_POST['fecha_entregaTranscripcion']);
            $autoridadSolicitante = strClean($_POST['autoridad_soliTranscripcion']);
            $medico = strClean($_POST['medicoTranscripcion']);
            $datosExtra = strClean($_POST['datos_extraTranscripcion']);
            $tipoDocumento = strClean($_POST['tipo_documentoTranscripcion']);

            $data = $this->model->insertarTranscripcion($idDictamen,$fechaEvaluacion,$fechaEntrega,
            $autoridadSolicitante,$medico,$datosExtra,$tipoDocumento);
            
            if ($data > 0) {
                
                if($tipoDocumento == 'Transcripcion'){
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($this->id_usuario, 6, 'CREACION', 'Se creó una nueva transcripción del dictamen con id '.$idDictamen, date('Y-m-d H:i:s'));

                    $res = array('titulo' => 'Transcripcion Registrada', 
                    'desc' => 'La transcripcion se ha registrado exitosamente', 
                    'type' => 'success');
                }else{
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($this->id_usuario, 6, 'CREACION', 'Se creó una nueva ampliacion del dictamen con id '.$idDictamen, date('Y-m-d H:i:s'));
                    
                    $res = array('titulo' => 'Ampliacion Registrada', 
                    'desc' => 'La ampliacion se ha registrado exitosamente', 
                    'type' => 'success');
                }
                
            } else {
                $res = array('titulo' => 'Error', 
                            'desc' => 'Hubo un problema al registrar el dictamen', 
                            'type' => 'error');
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function obtenerTranscripcion($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getTranscripcion($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function actualizarTranscripcion() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['idTranscripcion'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $idDictamen = strClean($putData['num_casoTranscripcion']);
                $fechaEvaluacion = strClean($putData['fecha_evaluacionTranscripcion']);
                $fechaEntrega = strClean($putData['fecha_entregaTranscripcion']);
                $autoridadSolicitante = strClean($putData['autoridad_soliTranscripcion']);
                $medico = strClean($putData['medicoTranscripcion']);
                $datosExtra = strClean($putData['datos_extraTranscripcion']);
                $tipoDocumento = strClean($putData['tipo_documentoTranscripcion']);
                $id = strClean($putData['idTranscripcion']);
    
                $data = $this->model->actualizarTranscripcion($idDictamen,$fechaEvaluacion,$fechaEntrega,
                $autoridadSolicitante,$medico,$datosExtra, $tipoDocumento, $id);
                if ($data > 0) {
                    if($tipoDocumento == 'Transcripcion'){
                        $bitacora = new Bitacora();
                        $bitacora->model->crearEvento($this->id_usuario, 6, 'Actualizacion', 'Se actualizó una transcripción del dictamen con id '.$idDictamen, date('Y-m-d H:i:s'));
    
                        $res = array('titulo' => 'Transcripcion Actualizada', 
                        'desc' => 'La transcripcion se ha actualizado exitosamente', 
                        'type' => 'success');
                    }else{
                        $bitacora = new Bitacora();
                        $bitacora->model->crearEvento($this->id_usuario, 6, 'Actualizacion', 'Se actualizó una ampliacion del dictamen con id '.$idDictamen, date('Y-m-d H:i:s'));
                        
                        $res = array('titulo' => 'Ampliacion Actualizada', 
                        'desc' => 'La ampliacion se ha actualizado exitosamente', 
                        'type' => 'success');
                    }
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar el dictamen', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function eliminarTranscripcion($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarTranscripcion($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($this->id_usuario, 6, 'ELIMINACION', 'Se eliminó una transcripcion / ampliacion con id '.$id, date('Y-m-d H:i:s'));
                    
                    $res = array('titulo' => 'Registro Eliminado', 
                                'desc' => 'El registro se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar el registro seleccionado', 
                                'type' => 'warning');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

}