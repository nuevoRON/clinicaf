<?php
class Login extends Controller{
    public function __construct() {
        parent ::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Iniciar Sesion';
        $data['script'] = 'login.js';
        $this->views->getView('principal', 'login', $data);
    }

    
    public function home()
    {
        $data['title'] = 'Home';
        $data['script'] = 'home.js';
        $this->views->getView('principal', 'home', $data);
    }


    public function iniciarSesion()
    {
        if (isset($_POST['usuario']) && isset($_POST['clave'])){
            if(empty($_POST['usuario'])){
                $res = array('msg' => 'EL USUARIO ES REQUERIDO', 'type' => 'warning');
            }else if(empty($_POST['clave'])){
                $res = array('msg' => 'LA CONTRASEÑA ES REQUERIDO', 'type' => 'warning');
            }else {
                $correo = strClean($_POST['usuario']);
                $clave = strClean($_POST['clave']);
                $data = $this->model->getDatos($correo);
                
                if (empty($data)){
                    $res = array('msg' => 'EL USUARIO NO EXISTE', 'type' => 'warning');
                }else{
                    if(password_verify($clave, $data['contrasena'])){
                        //$_SESSION['id_usuario'] = $data['ID_USUARIO'];
                        //$_SESSION['nombre_usuario'] = $data['NOMBRE_USUARIO'];
                        //$_SESSION['usuario'] = $data['USUARIO'];
                        //$_SESSION['correo_usuario'] = $data['CORREO_ELECTRONICO'];
                        //$_SESSION['estado'] = $data['ESTADO_USUARIO'];
                        //$_SESSION['autoregistro'] = $data['AUTOREGISTRO'];
                        //$_SESSION['esEmpleado'] = $data['EMPLEADO'];
                        
                        //$rol = $this->model->getRol($data['id']);
                        //$_SESSION['permisos'] = $rol['permisos'];

                        //if($data['ESTADO_USUARIO'] == 3) {
                        //    $res = array('msg' => 'USUARIO BLOQUEADO', 'type' => 'warning');
                        //} else if ($data['ESTADO_USUARIO'] == 4){
//
                        //    $res = array('msg' => 'USUARIO INHABILITADO', 'type' => 'warning');
                        //} else {
//
                        //    $this->model->actualizarIntentos(0, $data['ID_USUARIO']);
                        $res = array('msg' => 'DATOS CORRECTOS', 'id_usuario' => $data['id_usu'], 'type' => 'success');
                        //}
                    }else {
                        $intentos = $this->model->getParametro("'ADMIN_INTENTOS'");
                        $valorIntentos = $intentos['VALOR'];
                        // Actualizar intentos del usuario
                        $this->model->actualizarIntentos(($data['INTENTOS']+1), $data['ID_USUARIO']);
                        if ($data['INTENTOS'] == $valorIntentos && $data['ID_USUARIO'] != 1) {
                            $this->model->bloquearUsuario($data['ID_USUARIO']);
                            $res = array('msg' => 'CONTRASEÑA INCORRECTA, USUARIO BLOQUEADO', 'type' => 'warning');
                        } else {
                            $res = array('msg' => 'CONTRASEÑA INCORRECTA', 'type' => 'warning');
                        }
                    }
                }
            }     
        }else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>