<?php
// Verifica si hay sesiones iniciadas
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Configuración para regenerar el ID de sesión cada 5 minutos 
$tiempoRegeneracion = 300; 
$tiempoInactividad = 1800; 

// Verifica si se debe regenerar la sesión
if (!isset($_SESSION['ultimo_regenerado']) || (time() - $_SESSION['ultimo_regenerado']) > $tiempoRegeneracion) {
    session_regenerate_id(true);
    $_SESSION['ultimo_regenerado'] = time(); 
}

// Verifica el tiempo de inactividad
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $tiempoInactividad) {
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
    header('Location: ' . BASE_URL . 'login?session=closed');
    die(); 
}

// Actualiza el tiempo de la última actividad
$_SESSION['last_activity'] = time();

// Cerrar sesión si no hay un usuario activo
if (empty($_SESSION['id_usuario'])) {
    session_unset();
    session_destroy();

    header('Location: ' . BASE_URL . '/login');
    die(); 
}

//Cerrar sesión si un usuario se conecta desde otra dirección IP
if ($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR'] || 
    $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

    header('Location: ' . BASE_URL . '/login');
    die();
}