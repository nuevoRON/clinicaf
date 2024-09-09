<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Proveidos extends Controller
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
     public function listarProveidos()
     {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->listarProveidos();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
     }


     //Obtener datos de proveido para edición
    public function editarProveido($id) {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->editarProveido($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function getMedicos()
    {
        $this->verificarSesion();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getMedicos();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //metodo para registrar y modificar
    public function insertarProveido() {
        $this->verificarSesion();

        $sede = '';
        $laboratorio = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['fecha_emision'])) {
                $res = array('msg' => 'LA FECHA DE EMISION ES REQUERIDA', 'type' => 'warning');
            }else if (empty($_POST['fecha_recepcion'])) {
                $res = array('msg' => 'LA FECHA DE RECEPCION ES REQUERIDA', 'type' => 'warning');
            }else if (empty($_POST['item_dependencia_reg'])) {
                $res = array('msg' => 'LA FISCALIA ES REQUERIDA', 'type' => 'warning');
            }else {
                /* Datos para la tabla de Proveidos */
                $fechaEmision = strClean($_POST['fecha_emision']);
                $fechaRecepcion = strClean($_POST['fecha_recepcion']);
                $fiscalia = strClean($_POST['item_dependencia_reg']);
                $numeroExterno = strClean($_POST['numero_externo_reg']);
                $especificar = isset($_POST['especificar']) ? strClean($_POST['especificar']) : null;

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

                //Validar que la fecha de emision no sea mayor que la de recepcion
                $validacionFechas = $this->validarFechas($fechaEmision,$fechaRecepcion);
                if($validacionFechas == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha de emisión no puede ser mayor que la fecha de recepción', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

                $validacionFechaCita = $this->validarFechaCitacion($fechaCitacion);
                if($validacionFechaCita == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha de citación no puede ser menor que la fecha actual', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

                $data = $this->model->obtenerDatosSedes($medico);

                foreach($data as $val){
                    $sede = $val['cod_numerico'];
                    $laboratorio = $val['codigo_numerico'];
                }

                // Generar el número de solicitud correlativo
                $numeroSolicitudCorrelativo = $this->generarNumeroSolicitudCorrelativo($sede, $laboratorio);
                $numeroCasoCorrelativo = $this->generarNumeroCasoCorrelativo($sede);

                $dataProveido = $this->model->insertarProveido($numeroSolicitudCorrelativo, $fechaEmision, $fechaRecepcion, $fiscalia, 
                $numeroExterno,$numeroCasoCorrelativo,$especificar);
                $dataEvaluado = $this->model->insertarEvaluado($nombre, $apellido, $dni, $dataProveido);
                $dataHechos = $this->model->insertarHecho($departamento, $municipio, $localidad, $lugar, $fechaHecho, $dataProveido);
                $dataReconocimiento = $this->model->insertarReconocimiento($dataProveido, $tipoReconocimiento, $medico, $fechaCitacion);
                $dataEvaluacion = $this->model->insertarEvaluacion($dataProveido);

                if ($dataEvaluacion > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 3, 'CREACION', 'Se creó un proveido en el sistema', date('Y-m-d H:i:s'));
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
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);

            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                /* Datos para la tabla de Proveidos */
                $fechaEmision = strClean($putData['fecha_emision']);
                $fechaRecepcion = strClean($putData['fecha_recepcion']);
                $fiscalia = strClean($putData['item_dependencia_reg']);
                $numeroExterno = strClean($putData['numero_externo_reg']);
                $especificar = strClean($putData['especificar']);

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

                //Validar que la fecha de emision no sea mayor que la de recepcion
                $validacionFechas = $this->validarFechas($fechaEmision,$fechaRecepcion);
                if($validacionFechas == false){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'La fecha de emisión no puede ser mayor que la fecha de recepción', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

                $dataProveido = $this->model->actualizarProveido($fechaEmision, $fechaRecepcion, $fiscalia, $numeroExterno, $especificar, $id);
                $dataEvaluado = $this->model->actualizarEvaluado($nombre, $apellido, $dni, $id);
                $dataHechos = $this->model->actualizarHecho($departamento, $municipio, $localidad, $lugar, $fechaHecho, $id);
                $dataReconocimiento = $this->model->actualizarReconocimiento($tipoReconocimiento, $medico, $fechaCitacion, $id);
                $dataReconocimiento = $this->model->actualizarReconocimiento($tipoReconocimiento, $medico, $fechaCitacion, $id);
                if ($dataReconocimiento > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 3, 'ACTUALIZCION', 'Se actualizó el proveido con id  ' . $id, date('Y-m-d H:i:s'));
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
        $this->verificarSesion();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                $data = $this->model->eliminarProveido($id);
                
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 3, 'ELIMINACION', 'Se eliminó el proveido con id ' . $id, date('Y-m-d H:i:s'));
                    
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


    private function generarNumeroSolicitudCorrelativo($sede, $laboratorio) {
        $this->model->iniciarTransaccion();
    
        try {
            // Obtener el último correlativo y el año registrado desde el modelo
            $ultimoCorrelativo = $this->model->obtenerUltimoCorrelativo($sede, $laboratorio);
            $añoActual = date("Y");
    
            // Verificar si hay un registro previo
            if ($ultimoCorrelativo === false) {
                $ultimoCorrelativo = 0;
                $this->model->insertarNuevoCorrelativo($sede, $laboratorio, $ultimoCorrelativo, $añoActual);
            } else {
                $ultimoAño = $this->model->obtenerAnioCorrelativo($sede, $laboratorio);
    
                // Si el año actual es diferente al último año registrado, reiniciar el correlativo a 1
                if ($añoActual != $ultimoAño) {
                    $ultimoCorrelativo = 0; 
                }
            }
    
            $nuevoCorrelativo = $ultimoCorrelativo + 1;
    
            $this->model->actualizarUltimoCorrelativo($sede, $laboratorio, $nuevoCorrelativo, $añoActual);
    
            $this->model->confirmarTransaccion();
    
            // Formatear el número de solicitud
            return "{$añoActual}-{$sede}-{$laboratorio}-" . str_pad($nuevoCorrelativo, 5, "0", STR_PAD_LEFT);
    
        } catch (Exception $e) {
            $this->model->revertirTransaccion();
            throw new Exception("Error al generar el número de solicitud: " . $e->getMessage());
        }
    }
    


    private function generarNumeroCasoCorrelativo($sede) {
        $this->model->iniciarTransaccion();
    
        try {
            // Obtener el último correlativo y el último año registrado desde el modelo
            $ultimoCorrelativo = $this->model->obtenerUltimoCorrelativoCaso($sede);
            $añoActual = date("Y");
    
            if ($ultimoCorrelativo === false) {
                // Si no hay registro previo, establecer correlativo en 0 y guardar el nuevo año
                $ultimoCorrelativo = 0;
                $this->model->insertarNuevoCorrelativoCaso($sede, $ultimoCorrelativo, $añoActual);
            } else {
                $ultimoAño = $this->model->obtenerAnioCorrelativoCaso($sede);
    
                // Si el año actual es diferente al último año registrado, reiniciar el correlativo a 1
                if ($añoActual != $ultimoAño) {
                    $ultimoCorrelativo = 0; 
                }
            }
    
            $nuevoCorrelativo = $ultimoCorrelativo + 1;
    
            $this->model->actualizarUltimoCorrelativoCaso($sede, $nuevoCorrelativo, $añoActual);
    
            $this->model->confirmarTransaccion();
    
            // Formatear el número de solicitud
            return "{$añoActual}-{$sede}-" . str_pad($nuevoCorrelativo, 5, "0", STR_PAD_LEFT);
    
        } catch (Exception $e) {
            $this->model->revertirTransaccion();
            throw new Exception("Error al generar el número de solicitud: " . $e->getMessage());
        }
    }
    

    private function validarFechas($fechaEmision, $fechaRecepcion){
        $dateEmision = new DateTime($fechaEmision);
        $dateRecepcion = new DateTime($fechaRecepcion);

        // Validar que la fecha de emisión no sea mayor que la fecha de recepción
        if ($dateEmision > $dateRecepcion) {
            return false;
        } else {
            return true;
        }
    }


    private function validarFechaCitacion($fechaCitacion) {
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
    
    
}