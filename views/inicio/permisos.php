<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Permisos</title>
	<?php include "views/templates/archivosCss.php"; ?>
</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<h3 class="text-left">
				<i class="fas fa-user-shield"></i> &nbsp; LISTA DE PERMISOS
			<div class="container-fluid">
				<p class="text-center">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalPermisos"><i class="fas fa-user-plus"></i> &nbsp; Agregar Permiso</button>
			</div>

			<div class="modal fade" id="ModalPermisos" tabindex="-1" role="dialog" aria-labelledby="ModalPermisos" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-title">Agregar Permiso</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="container-fluid">
							<form class="form-neon" autocomplete="off" id="formulario">
								<input type="hidden" name="id" id="id">
								<fieldset>

									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label for="puesto" class="bmd-label" style="margin-top:-3%;">Puesto</label>
													<select name="puesto" id="puesto" class="form-control" required>
														<option value="">Seleccione una opción</option>
													</select>
												</div>

											</div>
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label for="modulo" class="bmd-label" style="margin-top:-3%;">Modulo</label>
													<select name="modulo" id="modulo" class="form-control" required>
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-12 mb-3">
												<h6>Permisos:</h6>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="consulta" name="consulta">
													<label class="form-check-label" for="consulta">Consulta</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="insercion" name="insercion">
													<label class="form-check-label" for="insercion">Inserción</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="actualizacion" name="actualizacion">
													<label class="form-check-label" for="actualizacion">Actualización</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="eliminacion" name="eliminacion">
													<label class="form-check-label" for="eliminacion">Eliminación</label>
												</div>
											</div>
										</div>
									</div>
								</fieldset>

								<br></br>
								<p class="text-center" style="margin-top: 40px;">
									<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
									&nbsp; &nbsp;
									<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm text-center" id="tablaPermisos">
						<thead>
							<tr class="text-center roboto-medium">
								<th>PUESTO</th>
								<th>MODULO</th>
								<th>CONSULTA</th>
								<th>INSERCION</th>
								<th>ACTUALIZACION</th>
								<th>ELIMINACION</th>

								<th>MODIFICAR</th>
								<th>ELIMINAR</th>
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
	<script type="module" src="<?php echo BASE_URL; ?>assets/js/modulos/permisos.js"></script>
</body>

</html>