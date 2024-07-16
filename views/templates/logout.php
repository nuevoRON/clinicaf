<?php
    // Borra todas las variables de sesión
	session_unset();

	// Destruye la sesión
	session_destroy();

	header('Location: ' . BASE_URL);
	exit(); // Termina la ejecución del script