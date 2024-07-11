<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Login</title>
	<?php include "templates/archivosCss.php"; ?>
</head>
<body>

	<div class="login-container">
		<div class="login-content">
			<p class="text-center">
				<i class="fas fa-user-circle fa-5x"></i>
			</p>
			<p class="text-center">
				Inicia sesión con tu cuenta
			</p>
			<form id="formulario" method="POST" autocomplete="off" >
				<div class="form-group">
					<label for="UserName" class="bmd-label-floating"><i class="fas fa-user-secret"></i> &nbsp; Usuario</label>
					<input type="text" class="form-control" id="usuario" name="usuario" pattern="[a-zA-Z0-9]{1,35}" maxlength="35">
				</div>
				<div class="form-group">
					<label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
					<input type="password" class="form-control" id="clave" name="clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
				</div>
				<button type="submit" class="btn-login text-center">INICIAR</button>
				<a href="home.php"></a>
			</form>
		</div>
	</div>

	
	<!--=============================================
	=            Include JavaScript files           =
	==============================================-->
	<?php include "templates/archivosJS.php"; ?>
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/login.js?<?php echo time(); ?>"></script>
</body>
</html>