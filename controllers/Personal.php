<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Personal extends Controller
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
    public function listarEmpleados()
    {
        $data = $this->model->listarEmpleados();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function listarPerfilEmpleado()
    {
        $id = $_SESSION['id_usuario'];
        $data = $this->model->listarPerfilEmpleado($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getJornadas(){
        $data = $this->model->getJornadas();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getPuestos(){
        $data = $this->model->getPuestos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getEstados(){
        $data = $this->model->getEstados();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getClinicas(){
        $data = $this->model->getClinicas();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    //Registrar Puestos
    public function insertarPersonal() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = strClean($_POST['nombre']);//puesto viene de la vista
            $apellido = strClean($_POST['apellido']);
            $numColegiacion = strClean($_POST['numero_colegiacion']);
            $numEmpleado = strClean($_POST['numero_empleado']);
            $email = strClean($_POST['email']);
            $telefono = strClean($_POST['telefono']);
            $jornada = strClean($_POST['jornada']);
            $puesto = strClean($_POST['puesto']);
            $sede = strClean($_POST['sede']);
            $estado = strClean($_POST['item_estado']);
            $usuario = strClean($_POST['usuario']);
            $clave = strClean($_POST['password']);
            $clinica = isset($_POST['clinica']) ? strClean($_POST['clinica']) : null;

            $validarUsuario = $this->model->verExistenciaUsuario($usuario);
                if ($validarUsuario > 0){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'El usuario ingresado ya existe en el sistema, ingrese otro por favor', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

                $validarColegiacion = $this->model->verExistenciaColegiacion($numColegiacion);
                if ($validarColegiacion > 0){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'El número de colegiacion ingresado ya se encuentra registrado en el sistema', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

                $validarNumEmpleado = $this->model->verExistenciaNumEmpleado($numEmpleado);
                if ($validarNumEmpleado > 0){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'El número de empleado ingresado ya se encuentra registrado en el sistema', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }

                $validarEmail = $this->model->verExistenciaEmail($email);
                if ($validarEmail > 0){
                    $res = array('titulo' => 'Error', 
                                'desc' => 'El email ingresado ya se encuentra en el sistema', 
                                'type' => 'error');
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                    die();
                }
    

            $data = $this->model->insertarPersonal($nombre,$apellido,$numColegiacion,$numEmpleado,$email,
                            $telefono,$jornada,$puesto,$sede,$estado,$usuario,$clave,$clinica);
            
            if ($data > 0) {
                //$bitacora = new Bitacora();
                //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA ' . $nombres, 1);
                $res = array('titulo' => 'Empleado Registrado', 
                        'desc' => 'El empleado se ha registrado exitosamente', 
                        'type' => 'success');
            } else {
                $res = array('titulo' => 'Error', 
                            'desc' => 'Hubo un problema al registrar el empleado', 
                            'type' => 'error');
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //Actualizar Puestos
    public function actualizarPersonal() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            if (empty($putData['id'])) {
                $res = array('msg' => 'ID REQUERIDO PARA ACTUALIZACIÓN', 'type' => 'warning');
            } else {
                $nombre = strClean($putData['nombre']);
                $apellido = strClean($putData['apellido']);
                $numColegiacion = strClean($putData['numero_colegiacion']);
                $numEmpleado = strClean($putData['numero_empleado']);
                $email = strClean($putData['email']);
                $telefono = strClean($putData['telefono']);
                $jornada = strClean($putData['jornada']);
                $puesto = strClean($putData['puesto']);
                $sede = strClean($putData['sede']);
                $estado = strClean($putData['item_estado']);
                $usuario = strClean($putData['usuario']);
                $clinica = isset($putData['clinica']) ? strClean($putData['clinica']) : null;
                $id = strClean($putData['id']);

                $data = $this->model->actualizarPersonal($nombre,$apellido,$numColegiacion,$numEmpleado,$email,
                $telefono,$jornada,$puesto,$sede,$estado,$usuario,$clinica,$id);
                if ($data > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL AREA ' . $nombres, 1);
                    $res = array('titulo' => 'Empleado Actualizado', 
                                 'desc' => 'El empleado se ha actualizado exitosamente', 
                                 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Error al actualizar el empleado', 
                                'type' => 'success');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    
    public function actualizarPerfil() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            $nombre = strClean($putData['nombre_perfil']);
            $apellido = strClean($putData['apellido_perfil']);
            $email = strClean($putData['correo_perfil']);
            $telefono = strClean($putData['telefono_perfil']);
            $id = $_SESSION['id_usuario'];

            $data = $this->model->actualizarPerfil($nombre,$apellido,$email,$telefono,$id);
            if ($data > 0) {
                //$bitacora = new Bitacora();
                //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL AREA ' . $nombres, 1);
                $res = array('titulo' => 'Perfil Actualizado', 
                             'desc' => 'Se actualizaron los datos del perfil', 
                             'type' => 'success');
            } else {
                $res = array('titulo' => 'Error', 
                            'desc' => 'Error al actualizar el perfil de su usuario', 
                            'type' => 'success');
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function actualizarClave() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);
    
            $contrasena = strClean($putData['contrasena']);
            $id = $_SESSION['id_usuario'];

            $data = $this->model->actualizarClave($contrasena,$id);
            if ($data > 0) {
                //$bitacora = new Bitacora();
                //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL AREA ' . $nombres, 1);
                $res = array('titulo' => 'Contraseña Actualizada', 
                             'desc' => 'Se actualizó la contraseña de su usuario', 
                             'type' => 'success');
            } else {
                $res = array('titulo' => 'Error', 
                            'desc' => 'Error al actualizar su contraseña, intente nuevamente', 
                            'type' => 'success');
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    //Obtener datos de empleado para edición
    public function obtenerEmpleado($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->obtenerEmpleado($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    //Eliminar Puesto
    public function eliminarEmpleado($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
            if ($id === null) {
                $res = array('msg' => 'ID inválido o no proporcionado', 'type' => 'error');
            } else {
                // Realizar la eliminación en la base de datos
                $data = $this->model->eliminarEmpleado($id);
                
                if ($data > 0) {
                    // Registro de evento en la bitácora (ejemplo)
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ELIMINACION', 'SE HA ELIMINADO EL AREA ' . $id, 1);
                    
                    $res = array('titulo' => 'Empleado Eliminado', 
                                'desc' => 'El empleado se ha eliminado exitosamente', 
                                'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 
                                'desc' => 'Hubo un error al eliminar el empleado seleccionado', 
                                'type' => 'warning');
                }
            }
            
            // Devolver respuesta en formato JSON
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

}