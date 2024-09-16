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
    public function getDictamenes()
    {
        $this->verificarSesion();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getDictamenes();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function getTranscripciones()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getTranscripciones();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function getNumerosCasosTranscripcion()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getNumerosCasosTranscripcion();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    /* Funciones para la sección de dictamenes */
    public function insertarDictamen() {
        $this->verificarSesion();

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

            $validacionFecharEvaluacion = $this->validarFechaEvaluacion($fechaEvaluacion);
            if($validacionFecharEvaluacion == false){
                $res = array('titulo' => 'Error', 
                            'desc' => 'La fecha de evaluación no puede ser mayor o igual que la fecha de hoy', 
                            'type' => 'error');
                echo json_encode($res, JSON_UNESCAPED_UNICODE);
                die();
            }

            $validacionFechaEntrega = $this->validarFechaEntrega($fechaEntrega);
            if($validacionFechaEntrega == false){
                $res = array('titulo' => 'Error', 
                            'desc' => 'La fecha de entrega no puede ser diferente de la fecha de hoy', 
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
        $this->verificarSesion();

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

                $validacionFecharEvaluacion = $this->validarFechaEvaluacion($fechaEvaluacion);
                if($validacionFecharEvaluacion == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha de evaluación no puede ser mayor o igual que la fecha de hoy', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

                $validacionFechaEntrega = $this->validarFechaEntrega($fechaEntrega);
                if($validacionFechaEntrega == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha de entrega no puede ser diferente de la fecha de hoy', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

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
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getDictamen($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar 
    public function eliminarDictamen($id){
        $this->verificarSesion();

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
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idDictamen = strClean($_POST['num_casoTranscripcion']);
            $fechaEvaluacion = strClean($_POST['fecha_evaluacionTranscripcion']);
            $fechaEntrega = strClean($_POST['fecha_entregaTranscripcion']);
            $autoridadSolicitante = strClean($_POST['autoridad_soliTranscripcion']);
            $medico = strClean($_POST['medicoTranscripcion']);
            $datosExtra = strClean($_POST['datos_extraTranscripcion']);
            $tipoDocumento = strClean($_POST['tipo_documentoTranscripcion']);

            $validacionFecharEvaluacion = $this->validarFechaEvaluacion($fechaEvaluacion);
            if($validacionFecharEvaluacion == false){
                $res = array('titulo' => 'Error', 
                            'desc' => 'La fecha de evaluación no puede ser mayor o igual que la fecha de hoy', 
                            'type' => 'error');
                echo json_encode($res, JSON_UNESCAPED_UNICODE);
                die();
            }
        
            $validacionFechaEntrega = $this->validarFechaEntrega($fechaEntrega);
            if($validacionFechaEntrega == false){
                $res = array('titulo' => 'Error', 
                            'desc' => 'La fecha de entrega no puede ser diferente de la fecha de hoy', 
                            'type' => 'error');
                echo json_encode($res, JSON_UNESCAPED_UNICODE);
                die();
            }

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
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getTranscripcion($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function actualizarTranscripcion() {
        $this->verificarSesion();

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

                $validacionFecharEvaluacion = $this->validarFechaEvaluacion($fechaEvaluacion);
                if($validacionFecharEvaluacion == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha de evaluación no puede ser mayor o igual que la fecha de hoy', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }
            
                $validacionFechaEntrega = $this->validarFechaEntrega($fechaEntrega);
                if($validacionFechaEntrega == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha de entrega no puede ser diferente de la fecha de hoy', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }
    
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
        $this->verificarSesion();
        
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


    private function validarFechaEvaluacion($fechaEvaluacion){
        $fechaEvaluacion = new DateTime($fechaEvaluacion);
        $fechaActual = new DateTime(); 
        
        // Normalizar ambas fechas al día, eliminando la parte de la hora
        $fechaEvaluacion->setTime(0, 0, 0);
        $fechaActual->setTime(0, 0, 0);
    
        if ($fechaEvaluacion < $fechaActual) {
            return true;
        } else {
            return false;
        }
    }

    private function validarFechaEntrega($fechaEntrega) {
        $fechaEntrega = new DateTime($fechaEntrega);
        $fechaActual = new DateTime(); 
        
        // Normalizar ambas fechas al día, eliminando la parte de la hora
        $fechaEntrega->setTime(0, 0, 0);
        $fechaActual->setTime(0, 0, 0);
    
        if ($fechaEntrega == $fechaActual) {
            return true;
        } else {
            return false;
        }
    }

}