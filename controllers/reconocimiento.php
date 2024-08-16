<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Reconocimiento extends Controller
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
    public function listarReconocimientos()
    {
        $data = $this->model->getReconocimientos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


 /*    public function getReconocimientos(){
        $data = $this->model->getReconocimientos();
        $res = array('estados'=>$data, 'type'=>'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    } */

    //Registrar reconocimiento
    public function insertarReconocimientos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['reconocimiento'])) {//reconocimiento viene de la vista
                $res = array('titulo' => 'Error', 
                            'desc' => 'El reconocimiento no puede ir vacío', 
                            'type' => 'warning');
            }else {
                $nom_reco = strClean($_POST['reconocimiento']);//reconocimiento viene de la vista
                // $estado = strClean($_POST['estado']);
    
                $data = $this->model->insertarReconocimientos($nom_reco);
                
                if ($data > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA ' . $nombres, 1);
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
    public function actualizarReconocimientos() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['reconocimiento'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $nom_reco = strClean($putData['reconocimiento']);
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarReconocimientos($nom_reco, $id);
                if ($data > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL AREA ' . $nombres, 1);
                    $res = array('titulo' => 'reconocimiento Actualizado', 
                                 'desc' => 'El reconocimiento se ha actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar el reconocimiento', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Obtener datos de sexo para edición
    public function obtenerReconocimientos($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->obtenerReconocimientos($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar Puesto
    public function eliminarReconocimientos($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarReconocimientos($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ELIMINACION', 'SE HA ELIMINADO EL AREA ' . $id, 1);
                    
                    $res = array('titulo' => 'Sede Eliminada', 
                                'desc' => 'El puesto se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar el puesto seleccionada', 
                                'type' => 'warning');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

}