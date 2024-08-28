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
                $usuario = strClean($_POST['usuario']);
                $clave = strClean($_POST['clave']);
                $data = $this->model->getDatos($usuario);
                
                if (empty($data)){
                    $res = array('msg' => 'Usuario o contraseña incorrecta', 'type' => 'warning');
                }else{
                    if(password_verify($clave, $data['contrasena'])){
                        session_regenerate_id(true);

                        $_SESSION['id_usuario'] = $data['id_usu'];
                        $_SESSION['nombre_usuario'] = $data['nombre'] . ' ' . $data['apellido'];
                        $_SESSION['usuario'] = $data['usuario'];
                        $_SESSION['estado'] = $data['estado'];
                        $_SESSION['sede'] = $data['ubicacion'];
                        $_SESSION['puesto'] = $data['nom_puesto'];
                        $_SESSION['id_puesto'] = $data['puesto'];
                        $_SESSION['last_activity'] = time();
                        $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                        
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
                        /* $intentos = $this->model->getParametro("'ADMIN_INTENTOS'");
                        $valorIntentos = $intentos['VALOR'];
                        // Actualizar intentos del usuario
                        $this->model->actualizarIntentos(($data['INTENTOS']+1), $data['ID_USUARIO']);
                        if ($data['INTENTOS'] == $valorIntentos && $data['ID_USUARIO'] != 1) {
                            $this->model->bloquearUsuario($data['ID_USUARIO']);
                            $res = array('msg' => 'CONTRASEÑA INCORRECTA, USUARIO BLOQUEADO', 'type' => 'warning');
                        } else { */
                            $res = array('msg' => 'Usuario o contraseña incorrecta', 'type' => 'warning');
                        //}
                    }
                }
            }     
        }else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function cerrarSesion(){
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        //se envía un objeto para validar el cierre de sesión y redirigir al login
        echo json_encode([
            "status" => "success",
            "redirect" => BASE_URL . "login"
        ]);
        die();
    }
}
?>