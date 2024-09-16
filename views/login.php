<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Login</title>
	<?php include "templates/archivosCssLogin.php"; ?>

	<style>
		body {
			background-image: url('http://localhost/clinicaf/assets/images/lgclinica.png');
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center center;
			background-attachment: fixed;
		}
	</style>
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
			<form id="formulario" method="POST" autocomplete="off">
				<div class="col-12">
					<div id="error-message" class="alert alert-danger text-center" style="display: none;">

					</div>
				</div>
				<div class="form-group">
					<label for="UserName" class="bmd-label" style="margin-top: -4%;"><i class="fas fa-user-secret"></i> &nbsp; Usuario</label>
					<input type="text" class="form-control" id="usuario" name="usuario" required>
				</div>
				<div class="form-group">
					<label for="UserPassword" class="bmd-label" style="margin-top: -4%;"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
					<input type="password" class="form-control" id="clave" name="clave" required>
				</div>
				<button type="submit" class="btn-login text-center">INICIAR</button>
				<a href="home.php"></a>
			</form>
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const params = new URLSearchParams(window.location.search);
			const sessionStatus = params.get('session');

			if (sessionStatus === 'closed') {
				const errorMessage = document.querySelector('#error-message');
				errorMessage.style.display = 'block';
				errorMessage.textContent = 'Su sesión ha sido cerrada por inactividad. Por favor ingrese nuevamente';
			}
		});
	</script>

	<?php include "templates/archivosJSLogin.php"; ?>
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/login.js?<?php echo time(); ?>"></script>
</body>

</html>