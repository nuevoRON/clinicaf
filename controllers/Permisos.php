<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Permisos extends Controller
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
    public function listarPermisos()
    {
        $data = $this->model->getPermisos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    //Registrar
    public function insertarPermiso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $puesto = strClean($_POST['puesto']);
            $modulo = strClean($_POST['modulo']);
            $consulta = isset($_POST['consulta']) ? 1 : 0;
            $insercion = isset($_POST['insercion']) ? 1 : 0;
            $actualizacion = isset($_POST['actualizacion']) ? 1 : 0;
            $eliminacion = isset($_POST['eliminacion']) ? 1 : 0;
        
            $data = $this->model->insertarPermiso($puesto,$modulo,$consulta,$insercion,$actualizacion,$eliminacion);
            if ($data > 0) {
                //$bitacora = new Bitacora();
                //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA ' . $nombres, 1);
                $res = array('titulo' => 'Permiso Registrado', 
                        'desc' => 'El permiso se ha registrado exitosamente', 
                        'type' => 'success');
            } else {
                $res = array('titulo' => 'Error', 
                            'desc' => 'Hubo un problema al registrar el permiso', 
                            'type' => 'error');
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Actualizar sexos
    public function actualizarPermiso() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $puesto = strClean($putData['puesto']);
                $modulo = strClean($putData['modulo']);
                $consulta = isset($putData['consulta']) ? 1 : 0;
                $insercion = isset($putData['insercion']) ? 1 : 0;
                $actualizacion = isset($putData['actualizacion']) ? 1 : 0;
                $eliminacion = isset($putData['eliminacion']) ? 1 : 0;
                $id = strClean($putData['id']);
    
                $data = $this->model->actualizarPermiso($puesto,$modulo,$consulta,$insercion,$actualizacion,$eliminacion, $id);
                if ($data > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL AREA ' . $nombres, 1);
                    $res = array('titulo' => 'Permiso Actualizado', 
                                 'desc' => 'El permiso se ha actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar el permiso', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
  
    public function obtenerPermisos($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->obtenerPermisos($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar 
    public function eliminarPermiso($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarPermiso($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ELIMINACION', 'SE HA ELIMINADO EL AREA ' . $id, 1);
                    
                    $res = array('titulo' => 'Permiso Eliminado', 
                                'desc' => 'El permiso se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar el permiso seleccionado', 
                                'type' => 'success');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    
    /* Funcion para validar los permisos de los usuarios conectados en base al puesto que pertenecen
    Recibe dos parámetros: 
    - El tipo de permiso a validar (consulta, insercion, actualizacion, eliminacion)
    - La vista o módulo en la que se está en el momento */
    public function validarPermisos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            $consulta = isset($input['consulta']) ? intval($input['consulta']) : null;
            $modulo = isset($input['modulo']) ? intval($input['modulo']) : null;
    
            if ($consulta !== null && $modulo !== null) {
                $data = $this->model->validarPermisos($consulta, $modulo);
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(['error' => 'Parámetros faltantes.'], JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode(['error' => 'Método no permitido.'], JSON_UNESCAPED_UNICODE);
        }
    }
    

}