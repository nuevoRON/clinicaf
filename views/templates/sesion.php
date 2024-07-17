<?php
//verifica si hay sesiones iniciadas
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Cerrar sesión
if (empty($_SESSION['id_usuario'])) {
	// Borra todas las variables de sesión
	session_unset();

	// Destruye la sesión
	session_destroy();

	header('Location: ' . BASE_URL);
	exit(); // Termina la ejecución del script
}
?>