<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Vacaciones extends Controller
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
    public function listarVacaciones()
    {
        $data = $this->model->getVacaciones();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getEmpleados(){
        $data = $this->model->getEmpleados();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getNombreEmpleado($id){
        $data = $this->model->getNombreEmpleado($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function insertarVacaciones() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEmpleado = strClean($_POST['num_empleado']);
            $estado = strClean($_POST['item_estado']);
            $fechaInicio = strClean($_POST['fecha_inicio']);
            $fechaFin = strClean($_POST['fecha_final']);
            $observaciones = strClean($_POST['observaciones']);
            $diasVacaciones = $this->calcularDiasEntreFechas($fechaInicio, $fechaFin);

            $data = $this->model->insertarVacaciones($idEmpleado,$fechaInicio,$fechaFin,$diasVacaciones,$observaciones);
            $dataUsuario = $this->model->actualizarEstado($idEmpleado,$estado);

            if ($dataUsuario > 0) {
                //$bitacora = new Bitacora();
                //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA ' . $nombres, 1);
                $res = array('titulo' => 'Vacaciones Registradas', 
                        'desc' => 'Las vacaciones se han registrado exitosamente', 
                        'type' => 'success');
            } else {
                $res = array('titulo' => 'Error', 
                            'desc' => 'Hubo un problema al registrar las vacaciones', 
                            'type' => 'error');
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

  
    public function actualizarVacaciones() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $idEmpleado = strClean($putData['num_empleado']);
                $estado = strClean($putData['item_estado']);
                $fechaInicio = strClean($putData['fecha_inicio']);
                $fechaFin = strClean($putData['fecha_final']);
                $observaciones = strClean($putData['observaciones']);
                $diasVacaciones = $this->calcularDiasEntreFechas($fechaInicio, $fechaFin);
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarVacaciones($idEmpleado,$fechaInicio,$fechaFin,$diasVacaciones,$observaciones, $id);
                $dataUsuario = $this->model->actualizarEstado($idEmpleado,$estado);

                if ($dataUsuario > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL AREA ' . $nombres, 1);
                    $res = array('titulo' => 'Vacaciones Actualizadas', 
                                 'desc' => 'Las vacaciones se han actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar las vacaciones', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Obtener datos para edicion
    public function editarVacacion($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->editarVacacion($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    

    public function eliminarVacaciones($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarVacaciones($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ELIMINACION', 'SE HA ELIMINADO EL AREA ' . $id, 1);
                    
                    $res = array('titulo' => 'Vacaciones Eliminadas', 
                                'desc' => 'Las vacaciones se han eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar las vacaciones seleccionadas', 
                                'type' => 'warning');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    private function calcularDiasEntreFechas($fechaInicio, $fechaFin) {
        // Crear objetos DateTime
        $inicio = new DateTime($fechaInicio);
        $fin = new DateTime($fechaFin);
    
        // Calcular la diferencia entre las dos fechas
        $diferencia = $inicio->diff($fin);
    
        // Retornar el número de días de diferencia
        return $diferencia->days;
    }

}