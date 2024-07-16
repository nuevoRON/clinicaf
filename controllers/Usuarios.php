<?php
require 'Bitacora.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
class Usuarios extends Controller
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
    public function index()
    {
        $data['title'] = 'USUARIOS';
        $data['script'] = 'usuarios.js';
        $this->views->getView('usuarios', 'index', $data);
    }
    public function registro()
    {
        $data['title'] = 'REGISTRO';
        $data['script'] = 'usuarios.js';
        $this->views->getView('usuarios', 'registro', $data);
    }
    public function registroAdmin()
    {
        $data['title'] = 'REGISTRO';
        $data['script'] = 'usuarios.js';
        $this->views->getView('usuarios', 'registroAdmin', $data);
    }
    public function confPreguntas()
    {
        $data['title'] = 'CONF-PREGUNTAS';
        $data['script'] = 'confPreguntas.js';
        $this->views->getView('usuarios', 'confPreguntas', $data);
    }
    public function recuperarPreguntas()
    {
        $data['title'] = 'PREGUNTAS';
        $data['script'] = 'confPreguntas.js';
        $this->views->getView('usuarios', 'recuperarPregunta', $data);
    }
    public function homeCandidatos()
    {
        $data['title'] = 'HOME';
        $data['script'] = 'homeCandidato.js';
        $this->views->getView('usuarios', 'candidatoHome', $data);
    }

    public function plazasDisponibles()
    {
        $data['title'] = 'PLAZAS DISPONIBLES';
        $data['script'] = 'plazas.js';
        $this->views->getView('usuarios', 'plazasDisponibles', $data);
    }

    public function perfilCandidato()
    {
        $data['title'] = 'PERFIL DEL CANDIDATO';
        $data['script'] = 'candidatos-perfil.js';
        $this->views->getView('usuarios', 'perfilCandidato', $data);
    }

    public function llenarPerfilCandidato()
    {
        $data['title'] = 'LLENAR INFORMACION DE CANDIDATO';
        $data['script'] = 'candidatos.js';
        $this->views->getView('usuarios', 'llenarPerfilCandidato', $data);
    }
    
    public function editarPerfilCandidato()
    {
        $data['title'] = 'EDITAR INFORMACION DE CANDIDATO';
        $data['script'] = 'editarcandidatos-perfil.js';
        $this->views->getView('usuarios', 'editarPerfilCandidato', $data);
    }

    public function verOferta()
    {
        $data['title'] = 'VER OFERTA';
        $data['script'] = 'ofertas.js';
        $this->views->getView('usuarios', 'verOferta', $data);
    }

    public function procesosCandidato()
    {
        $data['title'] = 'MIS PROCESOS';
        $data['script'] = 'postulaciones-candidato.js';
        $this->views->getView('usuarios', 'procesosCandidato', $data);
    }


    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            if($data[$i]['EMPLEADO']) {
                $data[$i]['id'] = '<span class="badge bg-warning">CANDIDATO</span>';
            } else {
                if ($data[$i]['id'] == 1) {
                    $data[$i]['id'] = '<span class="badge bg-success">' . $data[$i]['ROL'] . '</span>';
                } else {
                    $data[$i]['id'] = '<span class="badge bg-info">' . $data[$i]['ROL'] . '</span>';
                }
            }
            
            
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="eliminarUsuario(' . $data[$i]['ID_USUARIO'] . ')"><i class = "fas fa-times-circle"></i></button>
            <button class="btn btn-info" type="button" onclick="editarUsuario(' . $data[$i]['ID_USUARIO'] . ')"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listarEmpleadoCandidato($isCandidato)
    {
        $data = $this->model->getUsuariosCandidatos($isCandidato);
        for ($i = 0; $i < count($data); $i++) {
            if($data[$i]['EMPLEADO']) {
                $data[$i]['id'] = '<span class="badge bg-warning">CANDIDATO</span>';
            } else {
                if ($data[$i]['id'] == 1) {
                    $data[$i]['id'] = '<span class="badge bg-success">' . $data[$i]['ROL'] . '</span>';
                } else {
                    $data[$i]['id'] = '<span class="badge bg-info">' . $data[$i]['ROL'] . '</span>';
                }
            }
            
            
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="eliminarUsuario(' . $data[$i]['ID_USUARIO'] . ')"><i class = "fas fa-times-circle"></i></button>
            <button class="btn btn-info" type="button" onclick="editarUsuario(' . $data[$i]['ID_USUARIO'] . ')"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function autoregistrar()
    {
        if (isset($_POST)) {
            if (empty($_POST['usuario'])) {
                $res = array('msg' => 'EL USUARIO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['nombres'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['apellido'])) {
                $res = array('msg' => 'EL APELLIDO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['correo'])) {
                $res = array('msg' => 'EL CORREO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['identidad'])) {
                $res = array('msg' => 'LA IDENTIDAD ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['direccion'])) {
                $res = array('msg' => 'LA DIRECCION ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['contraseña'])) {
                $res = array('msg' => 'LA CONTRASEÑA ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['confcontraseña'])) {
                $res = array('msg' => 'LA CONFIRMACIÓN DE LA CONTRASEÑA ES REQUERIDO', 'type' => 'warning');
            } else {
                $usuario = strClean($_POST['usuario']);
                $nombres = strClean($_POST['nombres']);
                $apellido = strClean($_POST['apellido']);
                $correo = strClean($_POST['correo']);
                $identidad = strClean($_POST['identidad']);
                $direccion = strClean($_POST['direccion']);
                $contraseña = strClean($_POST['contraseña']);

                // Requerimientos de contraseña
                $hasNumber = preg_match('/\d/', $contraseña);           // Al menos un número
                $hasSpecialChar = preg_match('/[^a-zA-Z0-9]/', $contraseña); // Al menos un carácter especial
                $hasUppercase = preg_match('/[A-Z]/', $contraseña);       // Al menos una letra mayúscula
                $hasLowercase = preg_match('/[a-z]/', $contraseña);       // Al menos una letra minúscula

                // Verifica si la contraseña tiene al menos 6 caracteres
                if (strlen($contraseña) < 6) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS 6 CARACTERES', 'type' => 'warning');
                } elseif (empty($usuario) || empty($nombres) || empty($apellido) || empty($correo) || empty($identidad) || empty($direccion) || empty($contraseña)) {
                    $res = array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'type' => 'warning');
                } elseif (!$hasNumber) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UN NÚMERO', 'type' => 'warning');
                } elseif (!$hasSpecialChar) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UN CARACTER ESPECIAL', 'type' => 'warning');
                } elseif (!$hasUppercase) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UNA LETRA MAYÚSCULA', 'type' => 'warning');
                } elseif (!$hasLowercase) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UNA LETRA MINÚSCULA', 'type' => 'warning');
                } else {
                    $hash = password_hash($contraseña, PASSWORD_DEFAULT);
                    //verificar si existe los datos
                    $verificarCorreo = $this->model->getValidar('CORREO_ELECTRONICO', $correo, 'registrar', 0);
                    if (empty($verificarCorreo)) {
                        try {
                            $data = $this->model->autoregistrar(
                                $usuario,
                                $nombres,
                                $apellido,
                                $correo,
                                $identidad,
                                $direccion,
                                $hash

                            );
                            if ($data > 0) {
                                $bitacora = new Bitacora();
                                $usuarioNuev = $this->model->getUsuario($usuario);
                                $bitacora->model->crearEvento($usuarioNuev['ID_USUARIO'], 2, 'REGISTRO', 'SE HA REGISTRADO EN EL SISTEMA', 1);
                                $res = array('msg' => 'USUARIO REGISTRADO', 'type' => 'success');

                                // Mandar correo
                                $mail = new PHPMailer(true);
                                try {
                                    //Server settings
                                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                                    $mail->isSMTP();                                            //Send using SMTP
                                    $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                    $mail->Username   = USER_SMTP;                     //SMTP username
                                    $mail->Password   = CLAVE_SMTP;                               //SMTP password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                    $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                    //Recipients
                                    $mail->setFrom('Carlos@gmail.com', 'LGB');
                                    $mail->addAddress($correo);

                                    //Content
                                    $mail->isHTML(true);
                                    $mail->CharSet = 'UTF-8';                            //Set email format to HTML
                                    $mail->Subject = 'Cuenta creada - ' . TITLE;
                                    $template = file_get_contents(__DIR__ . '/../views/templates/email.html');
                                    $template = str_replace('[titulo]', '¡Cuenta creada! Bienvenido', $template);
                                    $template = str_replace('[mensaje]', '<p>Usuario: <strong>' . $usuario . '</strong></p>
                                        <p>Contraseña: <strong>' . $contraseña . '</strong></p> </br>
                                        <p>Para ingresar <a href="' . BASE_URL . '">CLICK AQUI</a></p>', $template);
                                    // Establecer el cuerpo del correo como la plantilla modificada
                                    $mail->msgHTML($template);

                                    $mail->send();
                                } catch (Exception $e) {
                                    $res = array('msg' => 'ERROR AL ENVIAR EL CORREO: ' . $mail->ErrorInfo, 'type' => 'error');
                                }
                            } else {
                                $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                            }
                        } catch (PDOException $e) {
                            $res = array(
                                'type' => 'error',
                                'msg' => 'Error en la base de datos: ' . $e->getMessage()
                            );
                        }
                    } else {
                        $res = array('msg' => 'EL CORREO DEBE SER UNICO', 'type' => 'warning');
                    }
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function autoregistrarAdmin()
    {
        if (isset($_POST)) {
            if (empty($_POST['usuario'])) {
                $res = array('msg' => 'EL USUARIO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['nombres'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['apellido'])) {
                $res = array('msg' => 'EL APELLIDO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['correo'])) {
                $res = array('msg' => 'EL CORREO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['identidad'])) {
                $res = array('msg' => 'LA IDENTIDAD ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['direccion'])) {
                $res = array('msg' => 'LA DIRECCION ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['contraseña'])) {
                $res = array('msg' => 'LA CONTRASEÑA ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['confcontraseña'])) {
                $res = array('msg' => 'LA CONFIRMACIÓN DE LA CONTRASEÑA ES REQUERIDO', 'type' => 'warning');
            } else {
                $usuario = strClean($_POST['usuario']);
                $nombres = strClean($_POST['nombres']);
                $apellido = strClean($_POST['apellido']);
                $correo = strClean($_POST['correo']);
                $identidad = strClean($_POST['identidad']);
                $direccion = strClean($_POST['direccion']);
                $contraseña = strClean($_POST['contraseña']);

                // Requerimientos de contraseña
                $hasNumber = preg_match('/\d/', $contraseña);           // Al menos un número
                $hasSpecialChar = preg_match('/[^a-zA-Z0-9]/', $contraseña); // Al menos un carácter especial
                $hasUppercase = preg_match('/[A-Z]/', $contraseña);       // Al menos una letra mayúscula
                $hasLowercase = preg_match('/[a-z]/', $contraseña);       // Al menos una letra minúscula

                // Verifica si la contraseña tiene al menos 6 caracteres
                if (strlen($contraseña) < 6) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS 6 CARACTERES', 'type' => 'warning');
                } elseif (empty($usuario) || empty($nombres) || empty($apellido) || empty($correo) || empty($identidad) || empty($direccion) || empty($contraseña)) {
                    $res = array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'type' => 'warning');
                } elseif (!$hasNumber) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UN NÚMERO', 'type' => 'warning');
                } elseif (!$hasSpecialChar) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UN CARACTER ESPECIAL', 'type' => 'warning');
                } elseif (!$hasUppercase) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UNA LETRA MAYÚSCULA', 'type' => 'warning');
                } elseif (!$hasLowercase) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UNA LETRA MINÚSCULA', 'type' => 'warning');
                } else {
                    $hash = password_hash($contraseña, PASSWORD_DEFAULT);
                    //verificar si existe los datos
                    $verificarCorreo = $this->model->getValidar('CORREO_ELECTRONICO', $correo, 'registrar', 0);
                    if (empty($verificarCorreo)) {
                        try {
                            $data = $this->model->autoregistrarAdmin(
                                $usuario,
                                $nombres,
                                $apellido,
                                $correo,
                                $identidad,
                                $direccion,
                                $hash

                            );
                            if ($data > 0) {
                                $bitacora = new Bitacora();
                                $usuarioNuev = $this->model->getUsuario($usuario);
                                $bitacora->model->crearEvento($usuarioNuev['ID_USUARIO'], 2, 'REGISTRO', 'SE HA REGISTRADO EN EL SISTEMA', 1);
                                $res = array('msg' => 'USUARIO REGISTRADO', 'type' => 'success');

                                // Mandar correo
                                $mail = new PHPMailer(true);
                                try {
                                    //Server settings
                                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                                    $mail->isSMTP();                                            //Send using SMTP
                                    $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                    $mail->Username   = USER_SMTP;                     //SMTP username
                                    $mail->Password   = CLAVE_SMTP;                               //SMTP password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                    $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                    //Recipients
                                    $mail->setFrom('Carlos@gmail.com', 'LGB');
                                    $mail->addAddress($correo);

                                    //Content
                                    $mail->isHTML(true);
                                    $mail->CharSet = 'UTF-8';                            //Set email format to HTML
                                    $mail->Subject = 'Cuenta creada - ' . TITLE;
                                    $template = file_get_contents(__DIR__ . '/../views/templates/email.html');
                                    $template = str_replace('[titulo]', '¡Cuenta creada! Bienvenido', $template);
                                    $template = str_replace('[mensaje]', '<p>Usuario: <strong>' . $usuario . '</strong></p>
                                        <p>Contraseña: <strong>' . $contraseña . '</strong></p> </br>
                                        <p>Para ingresar <a href="' . BASE_URL . '">CLICK AQUI</a></p>', $template);
                                    // Establecer el cuerpo del correo como la plantilla modificada
                                    $mail->msgHTML($template);

                                    $mail->send();
                                } catch (Exception $e) {
                                    $res = array('msg' => 'ERROR AL ENVIAR EL CORREO: ' . $mail->ErrorInfo, 'type' => 'error');
                                }
                            } else {
                                $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                            }
                        } catch (PDOException $e) {
                            $res = array(
                                'type' => 'error',
                                'msg' => 'Error en la base de datos: ' . $e->getMessage()
                            );
                        }
                    } else {
                        $res = array('msg' => 'EL CORREO DEBE SER UNICO', 'type' => 'warning');
                    }
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    //metodo para registrar y modificar
    public function registrar()
    {
        if (isset($_POST)) {
            if (empty($_POST['usuario'])) {
                $res = array('msg' => 'EL USUARIO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['nombres'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['apellido'])) {
                $res = array('msg' => 'EL APELLIDO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['correo'])) {
                $res = array('msg' => 'EL CORREO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['identidad'])) {
                $res = array('msg' => 'LA IDENTIDAD ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['direccion'])) {
                $res = array('msg' => 'LA DIRECCION ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['contraseña'])) {
                $res = array('msg' => 'LA CONTRASEÑA ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['rol'])) {
                $res = array('msg' => 'EL ROL ES REQUERIDO', 'type' => 'warning');
            } else {
                $usuario = strClean($_POST['usuario']);
                $nombres = strClean($_POST['nombres']);
                $apellido = strClean($_POST['apellido']);
                $correo = strClean($_POST['correo']);
                $identidad = strClean($_POST['identidad']);
                $direccion = strClean($_POST['direccion']);
                $contraseña = strClean($_POST['contraseña']);
                $rol = strClean($_POST['rol']);
                $id = strClean($_POST['id']);
                $tipo = strClean($_POST['tipo']);
                $estado = 1;
                if ($tipo != 1) {
                    $estado = strClean(($_POST['estado']));
                }

                // Requerimientos de contraseña
                $hasNumber = preg_match('/\d/', $contraseña);           // Al menos un número
                $hasSpecialChar = preg_match('/[^a-zA-Z0-9]/', $contraseña); // Al menos un carácter especial
                $hasUppercase = preg_match('/[A-Z]/', $contraseña);       // Al menos una letra mayúscula
                $hasLowercase = preg_match('/[a-z]/', $contraseña);       // Al menos una letra minúscula
                // Verifica si la contraseña tiene al menos 6 caracteres
                if (strlen($contraseña) < 6 && empty($id)) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS 6 CARACTERES', 'type' => 'warning');
                } elseif (empty($usuario) || empty($nombres) || empty($apellido) || empty($correo) || empty($identidad) || empty($direccion) || empty($contraseña) || empty($rol)) {
                    $res = array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'type' => 'warning');
                } elseif (!$hasNumber && empty($id)) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UN NÚMERO', 'type' => 'warning');
                } elseif (!$hasSpecialChar && empty($id)) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UN CARACTER ESPECIAL', 'type' => 'warning');
                } elseif (!$hasUppercase && empty($id)) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UNA LETRA MAYÚSCULA', 'type' => 'warning');
                } elseif (!$hasLowercase && empty($id)) {
                    $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UNA LETRA MINÚSCULA', 'type' => 'warning');
                } else {
                    if ($id == '') {
                        $hash = password_hash($contraseña, PASSWORD_DEFAULT);
                        //verificar si existe los datos
                        $verificarCorreo = $this->model->getValidar('CORREO_ELECTRONICO', $correo, 'registrar', 0);
                        if (empty($verificarCorreo)) {
                            try {
                                $data = $this->model->registrar(
                                    $usuario,
                                    $nombres,
                                    $apellido,
                                    $correo,
                                    $identidad,
                                    $direccion,
                                    $hash,
                                    $rol

                                );
                                if ($data > 0) {
                                    $bitacora = new Bitacora();
                                    $bitacora->model->crearEvento($_SESSION['id_usuario'], 1, 'REGISTRO', 'SE HA REGISTRADO EN EL SISTEMA AL USUARIO ' . $usuario, 1);
                                    $res = array('msg' => 'USUARIO REGISTRADO', 'type' => 'success');

                                    // Mandar correo
                                    $mail = new PHPMailer(true);
                                    try {
                                        //Server settings
                                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                                        $mail->SMTPDebug = 0;                      //Enable verbose debug output
                                        $mail->isSMTP();                                            //Send using SMTP
                                        $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                        $mail->Username   = USER_SMTP;                     //SMTP username
                                        $mail->Password   = CLAVE_SMTP;                               //SMTP password
                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                        $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                        //Recipients
                                        $mail->setFrom('Carlos@gmail.com', 'LGB');
                                        $mail->addAddress($correo);

                                        //Content
                                        $mail->isHTML(true);
                                        $mail->CharSet = 'UTF-8';                            //Set email format to HTML
                                        $mail->Subject = 'Cuenta creada - ' . TITLE;
                                        $template = file_get_contents(__DIR__ . '/../views/templates/email.html');
                                        $template = str_replace('[titulo]', '¡Cuenta creada! Bienvenido', $template);
                                        $template = str_replace('[mensaje]', '<p>Usuario: <strong>' . $usuario . '</strong></p>
                                        <p>Contraseña: <strong>' . $contraseña . '</strong></p> </br>
                                        <p>Para ingresar <a href="' . BASE_URL . '">CLICK AQUI</a></p>', $template);
                                        // Establecer el cuerpo del correo como la plantilla modificada
                                        $mail->msgHTML($template);

                                        $mail->send();
                                    } catch (Exception $e) {
                                        $res = array('msg' => 'ERROR AL ENVIAR EL CORREO: ' . $mail->ErrorInfo, 'type' => 'error');
                                    }
                                } else {
                                    $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                                }
                            } catch (PDOException $e) {
                                $res = array(
                                    'type' => 'error',
                                    'msg' => 'Error en la base de datos: ' . $e->getMessage()
                                );
                            }
                        } else {
                            $res = array('msg' => 'EL CORREO DEBE SER UNICO', 'type' => 'warning');
                        }
                    } else {
                        //verificar si existe los datos
                        $verificarCorreo = $this->model->getValidar('CORREO_ELECTRONICO', $correo, 'modificar', $id);
                        if (empty($verificarCorreo)) {
                            $data = $this->model->actualizar(
                                $nombres,
                                $apellido,
                                $correo,
                                $identidad,
                                $direccion,
                                $rol,
                                $estado,
                                $id
                            );
                            if ($data > 0) {
                                $bitacora = new Bitacora();
                                $bitacora->model->crearEvento($_SESSION['id_usuario'], 1, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO AL USUARIO ' . $usuario, 1);
                                $res = array('msg' => 'USUARIO ACTUALIZADO', 'type' => 'success');
                            } else {
                                $res = array('msg' => 'ERROR AL ACTUALIZAR', 'type' => 'error');
                            }
                        } else {
                            $res = array('msg' => 'EL CORREO DEBE SER UNICO', 'type' => 'warning');
                        }
                    }
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    //metodo para eliminar registro
    public function eliminar($id)
    {
        if (isset($_GET)) {
            if (is_numeric($id)) {
                $data = $this->model->eliminar($id);
                if ($data == 1) {
                    $res = array('msg' => 'USUARIO DADO DE BAJA', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'error');
                }
            } else {
                $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    //metodo para editar usuario
    public function editar($id)
    {
        $data = $this->model->editar($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    //vista de inactivos
    public function inactivos()
    {
        $data['title'] = 'Usuarios Inactivos';
        $data['script'] = 'usuarios-inactivos.js';
        $this->views->getView('usuarios', 'inactivos', $data);
    }
    public function listarInactivos()
    {
        $data = $this->model->getUsuarios(0);
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['id'] == 1) {
                $data[$i]['id'] = '<span class="badge bg-success">ADMINISTRADOR</span>';
            } else {
                $data[$i]['id'] = '<span class="badge bg-info">ASISTENTE</span>';
            }
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="restaurarUsuario(' . $data[$i]['ID_USUARIO'] . ')"><i class = "fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    //metodo para eliminar registro
    public function restaurar($id)
    {
        if (isset($_GET)) {
            if (is_numeric($id)) {
                $data = $this->model->eliminar(1, $id);
                if ($data == 1) {
                    $res = array('msg' => 'USUARIO RESTAURADO', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL RESTAURAR', 'type' => 'error');
                }
            } else {
                $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getMedicos()
    {
        $data = $this->model->getMedicos();
        $res = array('medicos' => $data, 'type' => 'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function traerPreguntas()
    {
        $data = $this->model->getPreguntas();
        $res = array('preguntas' => $data, 'type' => 'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function traerDatosPreguntasRespondidas($id)
    {
        $configuradas = $this->model->getPreguntasConfiguradas($id);
        $usuario = $this->model->getUsuarioByID($id);
        $parametro = $this->model->getParametro("'ADMIN_PREGUNTAS'");
        $total = $parametro['VALOR'];

        // Verificar si activar usuario o no (Y QUE SEA AUTOREGISTRADO)
        if ($configuradas['configuradas'] == $total && $usuario['AUTOREGISTRO']) {
            $this->model->actualizarEstado($id, 2);
            $_SESSION['estado'] = 2;
        }

        $res = array('configuradas' => $configuradas, 'total' => $total, 'type' => 'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function guardarPregunta($id)
    {
        $pregunta = $_POST['preguntas'];
        $respuesta = $_POST['respuesta'];
        $respuesta = password_hash($respuesta, PASSWORD_DEFAULT);

        // Consultar si la pregunta ya fue utilizada
        $utilizada = $this->model->traerPregunta($pregunta, $id);
        if (!empty($utilizada)) {
            $res = array('msg' => 'PREGUNTA YA ESTA EN USO', 'type' => 'info');
        } else {
            $this->model->guardarPregunta($pregunta, $respuesta, $id);
            $res = array('msg' => 'PREGUNTA CONFIGURADA CON ÉXITO', 'type' => 'success');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validarRespuesta($usuario)
    {
        $pregunta = $_POST['preguntas'];
        $respuesta = $_POST['respuesta'];
        $usuario = $this->model->getUsuario($usuario);
        if (empty($usuario)) {
            $res = array('msg' => 'USUARIO NO EXISTE', 'type' => 'info');
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }

        $utilizada = $this->model->traerPregunta($pregunta, $usuario['ID_USUARIO']);
        // Si no existe la pregunta o la respuesta es erronea bloquear y decir que respuesta incorrecta
        if (empty($utilizada) || !password_verify($respuesta, $utilizada['RESPUESTA'])) {
            // Bloquear usuario
            $this->model->bloquearUsuario($usuario['ID_USUARIO']);
            $res = array('msg' => 'RESPUESTA INCORRECTA, USUARIO BLOQUEADO', 'type' => 'warning');
        } else {
            // Habilitar el cambio de contraseña
            $res = array('ok' => true, 'type' => 'success');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function cambiarClave($usuario)
    {
        $nueva = strClean($_POST['contraseña']);
        $confirmar = strClean($_POST['confcontraseña']);
        $usuario = $this->model->getUsuario($usuario);

        // Requerimientos de contraseña
        $hasNumber = preg_match('/\d/', $nueva);           // Al menos un número
        $hasSpecialChar = preg_match('/[^a-zA-Z0-9]/', $nueva); // Al menos un carácter especial
        $hasUppercase = preg_match('/[A-Z]/', $nueva);       // Al menos una letra mayúscula
        $hasLowercase = preg_match('/[a-z]/', $nueva);       // Al menos una letra minúscula

        // Check if passwords meet the minimum length requirement
        if (strlen($nueva) < 6) {
            $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS 6 CARACTERES', 'type' => 'warning');
        } elseif (empty($nueva) || empty($confirmar)) {
            $res = array('msg' => 'TODOS LOS CAMPOS CON * SON REQUERIDOS', 'type' => 'warning');
        } elseif ($nueva != $confirmar) {
            $res = array('msg' => 'LAS CONTRASEÑAS NO COINCIDEN', 'type' => 'warning');
        } elseif (!$hasNumber) {
            $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UN NÚMERO', 'type' => 'warning');
        } elseif (!$hasSpecialChar) {
            $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UN CARACTER ESPECIAL', 'type' => 'warning');
        } elseif (!$hasUppercase) {
            $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UNA LETRA MAYÚSCULA', 'type' => 'warning');
        } elseif (!$hasLowercase) {
            $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UNA LETRA MINÚSCULA', 'type' => 'warning');
        } else {
            // Rest of your code remains unchanged
            $hash = password_hash($nueva, PASSWORD_DEFAULT);
            $data = $this->model->modificarClave($hash, $usuario['ID_USUARIO']);
            if ($data == 1) {
                // Activar usuario
                if ($usuario['ESTADO_USUARIO'] == 4) {
                    $res = array('msg' => 'EL USUARIO ESTA INHABILITADO', 'type' => 'error');
                } else {
                    // Contar preguntas configuradas
                    $configuradas = $this->model->getPreguntasConfiguradas($usuario['ID_USUARIO']);
                    $parametro = $this->model->getParametro("'ADMIN_PREGUNTAS'");
                    $total = $parametro['VALOR'];
                    // Actualizar fechas

                    // Verificar si activar usuario o no
                    if ($configuradas['configuradas'] == $total) {
                        $this->model->actualizarEstado($usuario['ID_USUARIO'], 2);
                        $_SESSION['estado'] = 2;
                    } else {
                        $this->model->actualizarEstado($usuario['ID_USUARIO'], 1);
                    }
                    $res = array('msg' => 'CONTRASEÑA MODIFICADA', 'type' => 'success');
                }
            } else {
                $res = array('msg' => 'ERROR AL MODIFICAR', 'type' => 'error');
            }
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function perfil()
    {
        $data['title'] = 'Datos del Usuario';
        $data['script'] = 'perfil.js';
        $data['usuario'] = $this->model->editar($this->id_usuario);
        $this->views->getView('usuarios', 'perfil', $data);
    }

    public function modificarDatos($usuario)
    {
        $contraseñaActual = strClean($_POST['contraseñaActual']);
        $contraseñaNueva = strClean($_POST['nuevaContraseña']);
        $contraseñaConfirmar = strClean($_POST['confirmarContraseña']);
        $usuario = $this->model->getUsuarioByID($usuario);

        // Validar contraseña
        if (password_verify($contraseñaActual, $usuario['CONTRASEÑA'])) {
            // Requerimientos de contraseña
            $hasNumber = preg_match('/\d/', $contraseñaNueva);           // Al menos un número
            $hasSpecialChar = preg_match('/[^a-zA-Z0-9]/', $contraseñaNueva); // Al menos un carácter especial
            $hasUppercase = preg_match('/[A-Z]/', $contraseñaNueva);       // Al menos una letra mayúscula
            $hasLowercase = preg_match('/[a-z]/', $contraseñaNueva);       // Al menos una letra minúscula

            // Check if passwords meet the minimum length requirement
            if (strlen($contraseñaNueva) < 6) {
                $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS 6 CARACTERES', 'type' => 'warning');
            } elseif (empty($contraseñaNueva) || empty($contraseñaConfirmar || $contraseñaActual)) {
                $res = array('msg' => 'TODOS LOS CAMPOS CON * SON REQUERIDOS', 'type' => 'warning');
            } elseif ($contraseñaNueva != $contraseñaConfirmar) {
                $res = array('msg' => 'LAS CONTRASEÑAS NO COINCIDEN', 'type' => 'warning');
            } elseif (!$hasNumber) {
                $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UN NÚMERO', 'type' => 'warning');
            } elseif (!$hasSpecialChar) {
                $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UN CARACTER ESPECIAL', 'type' => 'warning');
            } elseif (!$hasUppercase) {
                $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UNA LETRA MAYÚSCULA', 'type' => 'warning');
            } elseif (!$hasLowercase) {
                $res = array('msg' => 'LA CONTRASEÑA DEBE TENER AL MENOS UNA LETRA MINÚSCULA', 'type' => 'warning');
            } elseif ($contraseñaNueva == $contraseñaActual) {
                $res = array('msg' => 'LA NUEVA CONTRASEÑA YA ESTA EN USO', 'type' => 'info');
            } else {
                // Rest of your code remains unchanged
                $hash = password_hash($contraseñaNueva, PASSWORD_DEFAULT);
                $data = $this->model->modificarClave($hash, $usuario['ID_USUARIO']);
                if ($data == 1) {
                    // Activar usuario
                    if ($usuario['ESTADO_USUARIO'] == 4) {
                        $res = array('msg' => 'EL USUARIO ESTA INHABILITADO', 'type' => 'error');
                    } else {
                        $res = array('msg' => 'CONTRASEÑA MODIFICADA', 'type' => 'success');
                    }
                } else {
                    $res = array('msg' => 'ERROR AL MODIFICAR', 'type' => 'error');
                }
            }
        } else {
            $res = array('msg' => 'CONTRASEÑA INCORRECTA', 'type' => 'warning');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function modificarDatosPerfil($usuario)
    {
        $nombre = strClean($_POST['nombre']);
        $apellido = strClean($_POST['apellido']);
        $correo = strClean($_POST['correo']);
        $identidad = strClean($_POST['identidad']);
        $direccion = strClean($_POST['direccion']);
        $usuario = $this->model->getUsuarioByID($usuario);

        $data = $this->model->modificarPerfil($nombre, $apellido, $correo, $identidad, $direccion, $usuario['ID_USUARIO']);
        if ($data == 1) {
            // Activar usuario
            if ($usuario['ESTADO_USUARIO'] == 4) {
                $res = array('msg' => 'EL USUARIO ESTA INHABILITADO', 'type' => 'error');
            } else {
                $res = array('msg' => 'PERFIL MODIFICADO', 'type' => 'success');
            }
        } else {
            $res = array('msg' => 'ERROR AL MODIFICAR', 'type' => 'error');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}
