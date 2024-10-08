<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Personal</title>
	<?php include "views/templates/archivosCss.php"; ?>
</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<h3 class="text-left">
				<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PERSONAL
			</h3>
			
			<div class="container-fluid">
				<p class="text-center">
					<button type="button" class="btn btn-primary" id="btnModalPersonal"><i class="fas fa-user-plus"></i> &nbsp; Agregar Nuevo Personal</button>
				</p>
			</div>

			<div class="modal fade" id="Modalmedico" tabindex="-1" role="dialog" aria-labelledby="Modalmedico" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-title">Agregar Nuevo Personal</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="container-fluid">
							<form class="form-neon" autocomplete="off" id="formulario">
								<input type="hidden" name="id" id="id">
								<fieldset>
									<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DEL PERSONAL</legend>
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="nombre" class="bmd-label" style="margin-top:-5%;">Nombre</label>
													<input type="text" class="form-control" name="nombre" id="nombre" required>
													<span id="spanNombre" style="color: red; font-size:1rem;"></span>
												</div>
												<div class="col-12 col-md-4">
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="apellido" class="bmd-label" style="margin-top:-5%;">Apellido</label>
													<input type="text" class="form-control" name="apellido" id="apellido" required>
													<span id="spanApellido" style="color: red; font-size:1rem;"></span>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="numero_colegiacion" class="bmd-label-floating">Numero de Colegiación</label>
													<input type="text" class="form-control" name="numero_colegiacion" id="numero_colegiacion" required>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="numero_empleado" class="bmd-label" style="margin-top:-5%;">Nº de Empleado</label>
													<input type="text" class="form-control" name="numero_empleado" id="numero_empleado" required>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="usuario" class="bmd-label" style="margin-top:-5%;">Usuario</label>
													<input type="text" class="form-control" name="usuario" id="usuario" required>
													<span id="spanUsuario" style="color: red; font-size:1rem;"></span>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="telefono" class="bmd-label" style="margin-top:-5%;">Nº de Telefono</label>
													<input type="number" class="form-control" name="telefono" id="telefono" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="email" class="bmd-label" style="margin-top:-3%;">Correo Electronico</label>
													<input type="email" class="form-control" name="email" id="email" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="password" class="bmd-label" id="label-password" style="margin-top:-3%;">Contraseña</label>
													<input type="password" class="form-control" name="password" id="password">
												</div>
											</div>
										</div>
									</div>
								</fieldset>

								<fieldset>
									<legend><i class="fas fa-user"></i> &nbsp; Estados</legend>
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="jornada" class="bmd-label" style="margin-top:-5%;">Jornada</label>
													<select class="form-control" name="jornada" id="jornada" required>
														<option value="" selected="" disabled="">Seleccione la Jornanda</option>

													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="item_estado" class="bmd-label" style="margin-top:-5%;">Estado</label>
													<select class="form-control" name="item_estado" id="item_estado" required>
														<option value="" selected="" disabled="">Seleccione el Estado</option>

													</select>
												</div>
											</div>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label for="puesto" class="bmd-label" style="margin-top:-5%;">Puesto de Trabajo</label>
													<select class="form-control" name="puesto" id="puesto" required>
														<option value="" selected="" disabled="">Seleccione el Puesto</option>

													</select>
												</div>
											</div>
											<div class="col-12 col-md-7">
												<div class="form-group">
													<label for="sede" class="bmd-label" style="margin-top:-5%;">Sede</label>
													<select class="form-control" name="sede" id="sede" required>
														<option value="" selected="" disabled="">Seleccione la sede</option>

													</select>
												</div>
											</div>
											<div class="col-12 col-md-7">
												<div class="form-group">
													<label for="clinica" class="bmd-label" style="margin-top:-5%;">Clinica (en caso de ser médico)</label>
													<select class="form-control" name="clinica" id="clinica">
														<option value="" selected="" disabled="">Seleccione la clinica sede</option>

													</select>
												</div>
											</div>
										</div>
									</div>
								</fieldset>


								<br></br>
								<p class="text-center" style="margin-top: 40px;">
									<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
									&nbsp; &nbsp;
									<button type="submit" class="btn btn-raised btn-info btn-sm" id="btn-enviar"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm" id="tabla_empleados">
						<thead>
							<tr class="text-center roboto-medium">
								<th>NOMBRE</th>
								<th>USUARIO</th>
								<th>COLEGIACION</th>
								<th>Nº EMPLEADO</th>
								<th>Nº CORREO ELECTRONICO</th>
								<th>Nº DE TELEFONO</th>
								<th>JORNADA</th>
								<th>ESTADO</th>
								<th>PUESTO</th>
								<th>SEDE</th>
								<th>MODIFICAR</th>
								<th>ELIMINAR</th>
								<th>DESBLOQUEAR</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</section>
	</main>

	<?php include "views/templates/archivosJS.php"; ?>
	<script type="module" src="<?php echo BASE_URL; ?>assets/js/modulos/personal.js"></script>
	<script type="module" src="<?php echo BASE_URL; ?>assets/js/validaciones/validacionPersonal.js"></script>
</body>

</html>