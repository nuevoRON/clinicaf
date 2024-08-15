<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Evaluados extends Controller
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
     public function listarOcupaciones()
     {
         $data = $this->model->listarOcupaciones();
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
     }
     

     //Cargar datos en tabla
     public function listarEscolaridad()
     {
         $data = $this->model->listarEscolaridad();
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
     }


     //Cargar datos en tabla
     public function listarInstrumentos()
     {
         $data = $this->model->listarInstrumentos();
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
     }


     //Cargar datos en tabla
     public function listarEvaluados()
     {
         $data = $this->model->listarEvaluados();
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
     }


     //Obtener datos de proveido para edición
    public function editarProveido($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->editarProveido($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //metodo para registrar y modificar
    public function insertarProveido() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['numero_solicitud_reg'])) {
                $res = array('msg' => 'EL NUMERO DE SOLICIUD ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['fecha_emision'])) {
                $res = array('msg' => 'LA FECHA DE EMISION ES REQUERIDA', 'type' => 'warning');
            }else if (empty($_POST['fecha_recepcion'])) {
                $res = array('msg' => 'LA FECHA DE RECEPCION ES REQUERIDA', 'type' => 'warning');
            }else if (empty($_POST['item_dependencia_reg'])) {
                $res = array('msg' => 'LA FISCALIA ES REQUERIDA', 'type' => 'warning');
            }else {
                /* Datos para la tabla de Proveidos */
                $numeroSolicitud = strClean($_POST['numero_solicitud_reg']);
                $fechaEmision = strClean($_POST['fecha_emision']);
                $fechaRecepcion = strClean($_POST['fecha_recepcion']);
                $fiscalia = strClean($_POST['item_dependencia_reg']);
                $numeroExterno = strClean($_POST['numero_externo_reg']);

                /* Datos para la tabla de Evaluado */
                $nombre = strClean($_POST['nombre']);
                $apellido = strClean($_POST['apellido']);
                $dni = strClean($_POST['dni']);

                /* Datos para la tabla de Hechos */
                $departamento = strClean($_POST['item_departamento_reg']);
                $municipio = strClean($_POST['item_municipio_reg']);
                $localidad = strClean($_POST['aldea_barrio']);
                $lugar = strClean($_POST['lugar']);
                $fechaHecho = strClean($_POST['fecha_hecho']);

                /* Datos para la tabla de Reconocimiento */
                $tipoReconocimiento = strClean($_POST['item_recon_reg']);
                $medico = strClean($_POST['medico']);
                $fechaCitacion = strClean($_POST['fecha_citacion']);

                $dataProveido = $this->model->insertarProveido($numeroSolicitud, $fechaEmision, $fechaRecepcion, $fiscalia, $numeroExterno);
                $dataEvaluado = $this->model->insertarEvaluado($nombre, $apellido, $dni, $dataProveido);
                $dataHechos = $this->model->insertarHecho($departamento, $municipio, $localidad, $lugar, $fechaHecho, $dataProveido);
                $dataReconocimiento = $this->model->insertarReconocimiento($dataProveido, $tipoReconocimiento, $medico, $fechaCitacion);

                if ($dataReconocimiento > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA ' . $nombres, 1);
                    $res = array('titulo' => 'Proveido Registrado', 'desc' => 'Los datos del proveido se guardaron exitosamente', 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 'desc' => 'Hubo un problema al registrar el proveido', 'type' => 'error');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function actualizarProveido() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);

            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                /* Datos para la tabla de Proveidos */
                $numeroSolicitud = strClean($putData['numero_solicitud_reg']);
                $fechaEmision = strClean($putData['fecha_emision']);
                $fechaRecepcion = strClean($putData['fecha_recepcion']);
                $fiscalia = strClean($putData['item_dependencia_reg']);
                $numeroExterno = strClean($putData['numero_externo_reg']);

                /* Datos para la tabla de Evaluado */
                $nombre = strClean($putData['nombre']);
                $apellido = strClean($putData['apellido']);
                $dni = strClean($putData['dni']);

                /* Datos para la tabla de Hechos */
                $departamento = strClean($putData['item_departamento_reg']);
                $municipio = strClean($putData['item_municipio_reg']);
                $localidad = strClean($putData['aldea_barrio']);
                $lugar = strClean($putData['lugar']);
                $fechaHecho = strClean($putData['fecha_hecho']);

                /* Datos para la tabla de Reconocimiento */
                $tipoReconocimiento = strClean($putData['item_recon_reg']);
                $medico = strClean($putData['medico']);
                $fechaCitacion = strClean($putData['fecha_citacion']);
                $id = strClean($putData['id']);

                $dataProveido = $this->model->actualizarProveido($numeroSolicitud, $numeroExterno, $fechaEmision, $fechaRecepcion, $fiscalia, $id);
                $dataEvaluado = $this->model->actualizarEvaluado($nombre, $apellido, $dni, $id);
                $dataHechos = $this->model->actualizarHecho($departamento, $municipio, $localidad, $lugar, $fechaHecho, $id);
                $dataReconocimiento = $this->model->actualizarReconocimiento($tipoReconocimiento, $medico, $fechaCitacion, $id);

                if ($dataReconocimiento > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA ' . $nombres, 1);
                    $res = array('titulo' => 'Proveido Actualizado', 'desc' => 'Los datos del proveido se actualizaron exitosamente', 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 'desc' => 'Hubo un problema al actualizar el proveido', 'type' => 'error');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    //Eliminar proveido
    public function eliminarProveido($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarProveido($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ELIMINACION', 'SE HA ELIMINADO EL AREA ' . $id, 1);
                    
                    $res = array('titulo' => 'Proveido Eliminado', 
                                'desc' => 'El proveido se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar el proveido seleccionado', 
                                'type' => 'warning');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
}