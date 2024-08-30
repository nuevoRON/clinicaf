<?php include "views/templates/sesion.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Perfil de Usuario</title>
	<?php include "views/templates/archivosCss.php"; ?>

</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>

			<div class="container rounded bg-white mt-5 mb-5">
				<div class="row">
					<div class="col-md-3 border-right">
						<div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
							<span class="font-weight-bold" id="span-usuario"></span>
							<span class="text-black-50" id="span-correo"></span>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalPerfil"><i class="fas fa-user-plus"></i> &nbsp; EDITAR PERFIL</button>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalClave"><i class="fas fa-user-plus"></i> &nbsp; CAMBIAR CONTRASEÑA</button>
						</div>
					</div>
					<div class="col-md-5 border-right">
						<div class="p-3 py-5">
							<div class="d-flex justify-content-between align-items-center mb-3">
								<h4 class="text-right">Perfil de Empleado</h4>
							</div>
							<div class="row mt-2">
								<div class="col-md-6"><label class="labels">Nombres</label><input type="text" class="form-control" placeholder="first name" id="nombre" readonly></div>
								<div class="col-md-6"><label class="labels">Apellidos</label><input type="text" class="form-control" id="apellido" readonly></div>
							</div>
							<div class="row mt-3">
								<div class="col-md-12"><label class="labels">Teléfono</label><input type="text" class="form-control" id="telefono" readonly></div>
								<div class="col-md-12"><label class="labels">N° de Colegiación</label><input type="text" class="form-control" id="colegiacion" readonly></div>
								<div class="col-md-12"><label class="labels">N° de Empleado</label><input type="text" class="form-control" id="empleado" readonly></div>
								<div class="col-md-12"><label class="labels">Jornada</label><input type="text" class="form-control" id="jornada" readonly></div>
								<div class="col-md-12"><label class="labels">Puesto</label><input type="text" class="form-control" id="puesto" readonly></div>
								<div class="col-md-12"><label class="labels">Sede</label><input type="text" class="form-control" id="sede" readonly></div>
							</div>
						</div>
					</div>

				</div>
			</div>
			</div>
			</div>

		</section>
	</main>


	<div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog" aria-labelledby="ModalPerfil" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Editar Información de Perfil</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form action="" class="form-neon" id="formulario">
							<input type="hidden" name="id" id="id">
							<div class="container-fluid">
								<div class="row">
									<div class="col-12 col-md-8">
										<div class="form-group">
											<label for="nombre_perfil" class="bmd-label-floating">Nombre</label>
											<input type="text" class="form-control" name="nombre_perfil" id="nombre_perfil">
										</div>
									</div>
									<div class="col-12 col-md-8">
										<div class="form-group">
											<label for="apellido_perfil" class="bmd-label-floating">Apellido</label>
											<input type="text" class="form-control" name="apellido_perfil" id="apellido_perfil" maxlength="27">
										</div>
									</div>
									<div class="col-12 col-md-8">
										<div class="form-group">
											<label for="telefono_perfil" class="bmd-label-floating">Telefono</label>
											<input type="number" class="form-control" name="telefono_perfil" id="telefono_perfil" maxlength="27">
										</div>
									</div>
									<div class="col-12 col-md-8">
										<div class="form-group">
											<label for="correo_perfil" class="bmd-label-floating">Correo Electrónico</label>
											<input type="email" class="form-control" name="correo_perfil" id="correo_perfil" maxlength="27">
										</div>
									</div>
								</div>
							</div>

							<p class="text-center">
								&nbsp; &nbsp;
								<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save" id="btnAccion"></i> &nbsp; GUARDAR</button>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="ModalClave" tabindex="-1" role="dialog" aria-labelledby="ModalClave" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Cambiar Contraseña</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form action="" class="form-neon" id="formularioClave">
							<input type="hidden" name="id" id="id">
							<div class="container-fluid">
								<div class="row">
									<div class="col-12 col-md-8">
										<div class="form-group">
											<label for="contrasena" class="bmd-label-floating">Contraseña</label>
											<input type="text" class="form-control" name="contrasena" id="contrasena"
												pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[#@$!%*?&_])[A-Za-z\d#@$!%*?&_]{8,}$"
												title="La contraseña debe contener al menos una letra mayúscula, 
											un número, un carácter especial (@$!%*?&) y 8 caracteres mínimo">
										</div>
									</div>
									<div class="col-12 col-md-8">
										<div class="form-group">
											<label for="conf_contrasena" class="bmd-label-floating">Confirmar Contraseña</label>
											<input type="text" class="form-control" name="conf_contrasena" id="conf_contrasena" maxlength="27">
											<span id="error-message"></span>
										</div>
									</div>
								</div>
							</div>

							<p class="text-center">
								&nbsp; &nbsp;
								<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save" id="btnAccion"></i> &nbsp; GUARDAR</button>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include "views/templates/archivosJS.php"; ?>
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/perfil.js"></script>
</body>

</html>