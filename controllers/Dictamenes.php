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


    //Registrar
    public function insertarDictamen() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numeroCaso = strClean($_POST['num_caso']);
            $tipoDocumento = strClean($_POST['tipo_documento']);
            $fechaEvaluacion = strClean($_POST['fecha_evaluacion']);
            $fechaEntrega = strClean($_POST['fecha_entrega']);
            $autoridadSolicitante = strClean($_POST['autoridad_soli']);
            $medico = strClean($_POST['medico']);
            $datosExtra = strClean($_POST['datos_extra']);

            $data = $this->model->insertarDictamen($numeroCaso,$tipoDocumento,$fechaEvaluacion,$fechaEntrega,
            $autoridadSolicitante,$medico,$datosExtra);
            
            if ($data > 0) {
                //$bitacora = new Bitacora();
                //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA ' . $nombres, 1);
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

    //Actualizar Puestos
    public function actualizarDictamen() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $numeroCaso = strClean($putData['num_caso']);
                $tipoDocumento = strClean($putData['tipo_documento']);
                $fechaEvaluacion = strClean($putData['fecha_evaluacion']);
                $fechaEntrega = strClean($putData['fecha_entrega']);
                $autoridadSolicitante = strClean($putData['autoridad_soli']);
                $medico = strClean($putData['medico']);
                $datosExtra = strClean($putData['datos_extra']);
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarDictamen($numeroCaso,$tipoDocumento,$fechaEvaluacion,$fechaEntrega,
                $autoridadSolicitante,$medico,$datosExtra, $id);
                if ($data > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL AREA ' . $nombres, 1);
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
    
    //Eliminar Puesto
    public function eliminarDictamen($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarDictamen($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ELIMINACION', 'SE HA ELIMINADO EL AREA ' . $id, 1);
                    
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

}