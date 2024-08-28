<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Casos extends Controller
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
    public function listarRevisiones()
    {
        $data = $this->model->getRevisiones();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    //Registrar Casos
    public function insertarRevision()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $medico = strClean($_POST['medico']);
            $enviadoPara = strClean($_POST['enviado_para']);
            $fechaRevision = strClean($_POST['fecha_revision']);
            $tipoDictamen = strClean($_POST['tipo_dictamen']);
            $numDictamen = strClean($_POST['num_dictamen']);
            $nombreEvaluado = strClean($_POST['nombre_evaluado']);
            $fechaRealizacion = strClean($_POST['fecha_realizacion']);
            $tipoReconocimiento = strClean($_POST['tipo_reconocimiento']);
            $obsReconocimiento = strClean($_POST['observaciones_rec']);
            $estadoDictamen = strClean($_POST['estado_dictamen']);
            $obsDictamen = strClean($_POST['obs_dictamen']);
            $sedeMedico = strClean($_POST['sede_medico']);
            $sedeClinica = strClean($_POST['sede_clinica']);

            $data = $this->model->insertarRevision(
                $medico,
                $enviadoPara,
                $fechaRevision,
                $tipoDictamen,
                $numDictamen,
                $nombreEvaluado,
                $fechaRealizacion,
                $tipoReconocimiento,
                $obsReconocimiento,
                $estadoDictamen,
                $obsDictamen,
                $sedeMedico,
                $sedeClinica
            );

            if ($data > 0) {
                //$bitacora = new Bitacora();
                //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA ' . $nombres, 1);
                $res = array(
                    'titulo' => 'Revisón Registrada',
                    'desc' => 'La revisión del caso se ha registrado exitosamente',
                    'type' => 'success'
                );
            } else {
                $res = array(
                    'titulo' => 'Error',
                    'desc' => 'Hubo un problema al registrar la revisión',
                    'type' => 'error'
                );
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Actualizar Casos
    public function actualizarRevision()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);

            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $medico = strClean($putData['medico']);
                $enviadoPara = strClean($putData['enviado_para']);
                $fechaRevision = strClean($putData['fecha_revision']);
                $tipoDictamen = strClean($putData['tipo_dictamen']);
                $numDictamen = strClean($putData['num_dictamen']);
                $nombreEvaluado = strClean($putData['nombre_evaluado']);
                $fechaRealizacion = strClean($putData['fecha_realizacion']);
                $tipoReconocimiento = strClean($putData['tipo_reconocimiento']);
                $obsReconocimiento = strClean($putData['observaciones_rec']);
                $estadoDictamen = strClean($putData['estado_dictamen']);
                $obsDictamen = strClean($putData['obs_dictamen']);
                $sedeMedico = strClean($putData['sede_medico']);
                $sedeClinica = strClean($putData['sede_clinica']);
                $id = strClean($putData['id']);

                $data = $this->model->actualizarRevision(
                    $medico,
                    $enviadoPara,
                    $fechaRevision,
                    $tipoDictamen,
                    $numDictamen,
                    $nombreEvaluado,
                    $fechaRealizacion,
                    $tipoReconocimiento,
                    $obsReconocimiento,
                    $estadoDictamen,
                    $obsDictamen,
                    $sedeMedico,
                    $sedeClinica,
                    $id
                );
                if ($data > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL AREA ' . $nombres, 1);
                    $res = array(
                        'titulo' => 'Revisón Actualizada',
                        'desc' => 'La revisión del caso se ha actualizado exitosamente',
                        'type' => 'success'
                    );
                } else {
                    $res = array(
                        'titulo' => 'Error',
                        'desc' => 'Error al actualizar la revisión',
                        'type' => 'success'
                    );
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Obtener datos de empleado para edición
    public function obtenerRevision($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->obtenerRevision($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function eliminarRevision($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarRevision($id);

                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ELIMINACION', 'SE HA ELIMINADO EL AREA ' . $id, 1);

                    $res = array(
                        'titulo' => 'Revisión Eliminada',
                        'desc' => 'La revisión del caso se ha eliminado exitosamente',
                        'type' => 'success'
                    );
                } else {
                    $res = array(
                        'titulo' => 'Error',
                        'desc' => 'Hubo un error al eliminar la revisión seleccionado',
                        'type' => 'warning'
                    );
                }
            }

            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}
