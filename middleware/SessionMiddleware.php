<?php

class SessionMiddleware
{
    private $tiempoRegeneracion = 300; 
    private $tiempoInactividad = 900;

    public function __construct() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $this->regenerarSesion();

        $this->verificarInactividad();

        $this->verificarUsuarioActivo();

        $this->verificarCambios();

        $this->verificarSesion();
    }

    private function regenerarSesion() {
        if (!isset($_SESSION['ultimo_regenerado']) || (time() - $_SESSION['ultimo_regenerado']) > $this->tiempoRegeneracion) {
            session_regenerate_id(true);
            $_SESSION['ultimo_regenerado'] = time();
        }
    }

    private function verificarInactividad() {
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $this->tiempoInactividad) {
            $this->cerrarSesion('closed');
        }
        $_SESSION['last_activity'] = time(); 
    }

    private function verificarUsuarioActivo() {
        if (empty($_SESSION['id_usuario'])) {
            $this->cerrarSesion('notlogged');
        }
    }

    private function verificarCambios() {
        if (isset($_SESSION['user_ip']) && ($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR'] || 
            $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'])) {
            $this->cerrarSesion('closed');
        }
    }

    private function cerrarSesion($motivo) {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        // Redirige a la página de login con el motivo de cierre
        header('Location: ' . BASE_URL . 'login?session=' . $motivo);
        die();
    }

    private function verificarSesion()
    {
        if (empty($_SESSION['id_usuario'])) {
            echo json_encode([
                'titulo' => 'Acceso Denegado',
                'desc' => 'Debes iniciar sesión para realizar esta acción.',
                'type' => 'error'
            ], JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}
