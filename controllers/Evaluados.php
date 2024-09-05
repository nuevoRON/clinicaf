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
     public function listarOcupaciones()
     {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->listarOcupaciones();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
     }
     

     //Cargar datos en tabla
     public function listarEscolaridad()
     {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->listarEscolaridad();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
     }


     //Cargar datos en tabla
     public function listarInstrumentos()
     {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->listarInstrumentos();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
     }


     public function listarEstadoCivil()
     {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->listarEstadoCivil();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
     }


     public function listarNacionalidad()
     {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->listarNacionalidad();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
     }

     //Cargar datos en tabla
     public function listarEvaluados()
     {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->listarEvaluados();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
     }


     //Obtener datos de proveido para edición
    public function editarEvaluado($id) {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->editarEvaluado($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function insertarOcupacion() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['ocupacion_nueva'])) {
                $res = array('msg' => 'EL NOMBRE DE OCUPACION ES REQUERIDO', 'type' => 'warning');
            }else {
                $ocupacion = strClean($_POST['ocupacion_nueva']);
                $data = $this->model->insertarOcupacion($ocupacion);

                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 15, 'CREACION', 'Se creó una nueva ocupacion', date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Ocupacion Registrada', 'desc' => 'Los datos del proveido se guardaron exitosamente', 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 'desc' => 'Hubo un problema al registrar el proveido', 'type' => 'error');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function insertarInstrumento() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['instrumento_nuevo'])) {
                $res = array('msg' => 'EL NOMBRE DE INSTRUMENTO ES REQUERIDO', 'type' => 'warning');
            }else {
                $instrumento = strClean($_POST['instrumento_nuevo']);
                $data = $this->model->insertarInstrumento($instrumento);

                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 15, 'CREACION', 'Se creó un nuevo instrumento en el sistema', date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Instrumento Registrado', 'desc' => 'Los datos del proveido se guardaron exitosamente', 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 'desc' => 'Hubo un problema al registrar el proveido', 'type' => 'error');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function insertarNacionalidad() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nacionalidad_nuevo'])) {
                $res = array('msg' => 'EL NOMBRE DE INSTRUMENTO ES REQUERIDO', 'type' => 'warning');
            }else {
                $nacionalidad = strClean($_POST['nacionalidad_nuevo']);
                $data = $this->model->insertarNacionalidad($nacionalidad);

                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 15, 'CREACION', 'Se creó una nueva nacionalidad en el sistema', date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Nacionalidad Registrada', 'desc' => 'Los datos del proveido se guardaron exitosamente', 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 'desc' => 'Hubo un problema al registrar el proveido', 'type' => 'error');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function actualizarEvaluado() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);

            if (empty($putData['id_evaluado'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                /* Datos para la tabla de Evaluado */
                $nombre = strClean($putData['nombre']);
                $apellido = strClean($putData['apellido']);
                $dni = strClean($putData['dni']);
                $telefono = strClean($putData['telefono']);
                $nacionalidad = strClean($putData['nacionalidad']);
                $sexo = strClean($putData['sexo']);
                $diversidad = strClean($putData['diversidad']);
                $estadoCivil = strClean($putData['estadoCivil']);
                $ocupacion = isset($putData['ocupacion']) ? strClean($putData['ocupacion']) : null;
                $escolaridad = strClean($putData['escolaridad']);
                $edad = strClean($putData['edad']);
                $tiempo = strClean($putData['tiempo']);
                $nombreAcomp = strClean($putData['nombre_acomp']);
                $lugarProcedencia = strClean($putData['lugar_procedencia']);
                $apellidoAcomp = strClean($putData['apellido_acomp']);
                $dniAcomp = strClean($putData['dni_acomp']);
                $relacion = strClean($putData['relacion']);

                /* Datos para la tabla de Evaluacion */
                $consentimiento = strClean($putData['permiso_evaluacion']);
                $instrumento = isset($putData['instrumento']) ? strClean($putData['instrumento']) : null;
                $relacionAgresor = isset($putData['relacion_agresor']) ? strClean($putData['relacion_agresor']) : null;
                $conocido = $putData['agresor_conocido'] != '' ? strClean($putData['agresor_conocido']) :'';
                $descripcion = strClean($putData['descripcion_evaluacion']);
                $sede = strClean($putData['sede_evaluacion']);
                $fechaFinalizacion = $putData['fecha_finalizacion'] != '' ? strClean($putData['fecha_finalizacion']) : null;

                /* Datos para la tabla de Hechos */
                $departamento = strClean($putData['departamento']);
                $municipio = strClean($putData['municipio']);
                $localidad = strClean($putData['aldea_barrio']);
                $lugar = strClean($putData['lugar_hecho']);
                $fechaHecho = strClean($putData['fecha_hecho']);

                $id = strClean($putData['id_evaluado']);
                $estadoEvaluacion = $putData['fecha_finalizacion'] != '' ? 'Realizado' : 'Pendiente';

                $dataEvaluado = $this->model->actualizarEvaluado($nombre, $apellido, $dni,$telefono,$sexo,$edad,
                $diversidad, $tiempo,$nombreAcomp, $apellidoAcomp,$relacion,$nacionalidad,$estadoCivil,$ocupacion,
                $lugarProcedencia, $escolaridad, $dniAcomp, $estadoEvaluacion, $id);

                $dataEvaluacion = $this->model->actualizarEvaluacion($consentimiento, $instrumento, $descripcion, $relacionAgresor,
                $conocido, $sede, $fechaFinalizacion, $id);

                $dataHechos = $this->model->actualizarHecho($departamento, $municipio, $localidad, $lugar, $fechaHecho, $id);
            
                if ($dataHechos > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 15, 'ACTUALIZACION', 'Se actualizó la evaluación del proveido '. $id, date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Evaluación Actualizada', 'desc' => 'Los datos de la evaluación se actualizaron exitosamente', 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 'desc' => 'Hubo un problema al actualizar la evaluación', 'type' => 'error');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    //Eliminar proveido
    public function eliminarProveido($id){
        $this->verificarSesion();
        
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