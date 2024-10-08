<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Puestos extends Controller
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
    public function listarPuestos()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getPuestos();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function getPuestosSelect()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getPuestosSelect();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function getEstados(){
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getEstados();
            $res = array('estados'=>$data, 'type'=>'success');
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Registrar Puestos
    public function insertarPuestos() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['puesto'])) {//puesto viene de la vista
                $res = array('titulo' => 'Error', 
                            'desc' => 'El puesto no puede ir vacío', 
                            'type' => 'warning');
            }else {
                $nom_puesto = strClean($_POST['puesto']);//puesto viene de la vista
                $estado = strClean($_POST['estado']);
    
                $data = $this->model->insertarPuestos($nom_puesto,$estado);
                
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 11, 'CREACION', 'Se creó un nuevo puesto en el sistema', date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Puesto Registrado', 
                            'desc' => 'El puesto se ha registrado exitosamente', 
                            'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un problema al registrar el puesto', 
                                'type' => 'error');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Actualizar Puestos
    public function actualizarPuestos() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['puesto'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $puesto = strClean($putData['puesto']);
                $estado = strClean($putData['estado']);
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarPuestos($puesto, $estado, $id);
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 11, 'ACTUALIZACION', 'Se actualizó la información del puesto con id '.$id, date('Y-m-d H:i:s'));
                    $res = array('titulo' => 'Puesto Actualizado', 
                                 'desc' => 'El puesto se ha actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar el puesto', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Obtener datos de sexo para edición
    public function obtenerPuestos($id) {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->obtenerPuestos($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar Puesto
    public function eliminarPuestos($id){
        $this->verificarSesion();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarPuestos($id);
                
                if ($data > 0) {
                    $bitacora = new Bitacora();
                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 11, 'ELIMINACION', 'Se eliminó el puesto con id '.$id, date('Y-m-d H:i:s'));
                    
                    $res = array('titulo' => 'Puesto Eliminado', 
                                'desc' => 'El puesto se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar el puesto seleccionado', 
                                'type' => 'warning');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

}