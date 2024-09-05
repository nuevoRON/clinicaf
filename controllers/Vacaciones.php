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
    public function listarVacaciones()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getVacaciones();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function getEmpleados(){
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getEmpleados();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function getNombreEmpleado($id){
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getNombreEmpleado($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function insertarVacaciones() {
        $this->verificarSesion();

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
                $bitacora = new Bitacora();
                $bitacora->model->crearEvento($_SESSION['id_usuario'], 10, 'CREACION', 'Se crearon nuevas vacaciones', date('Y-m-d H:i:s'));
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
        $this->verificarSesion();

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
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 10, 'ACTUALIZACION', 'Se actualizó la información de las vacaciones con id '.$id, date('Y-m-d H:i:s'));
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
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->editarVacacion($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    

    public function eliminarVacaciones($id){
        $this->verificarSesion();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarVacaciones($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 10, 'ELIMINACION', 'Se elimiaron las vacaciones con id '.$id, date('Y-m-d H:i:s'));
                    
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
        $inicio = new DateTime($fechaInicio);
        $fin = new DateTime($fechaFin);
    
        if ($inicio > $fin) {
            return 0;
        }
    
        $diasHabiles = 0;
    
        while ($inicio <= $fin) {
            // Obtener el día de la semana (1 = Lunes, 7 = Domingo)
            $diaSemana = $inicio->format('N');
    
            // Contar solo si es un día hábil (Lunes-Viernes)
            if ($diaSemana >= 1 && $diaSemana <= 5) {
                $diasHabiles++;
            }
    
            $inicio->modify('+1 day');
        }
    
        return $diasHabiles;
    }
    

}