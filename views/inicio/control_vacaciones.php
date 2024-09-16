<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Vacaciones</title>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<?php include "views/templates/archivosCss.php"; ?>
</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<h3 class="text-left">
				<i class="fas fa-calendar-week"></i> &nbsp; CONTROL DE VACACIONES
			</h3>
			<div class="container-fluid">
				<div class="text-center">
					<p class="text-center">
						<button type="button" class="btn btn-primary" id="btnModalVacacion"><i class="fas fa-user-plus"></i> &nbsp; Agregar Vacacion</button>
					</p>
				</div>
			</div>

			<div class="modal fade" id="ModalVacacion" tabindex="-1" role="dialog" aria-labelledby="ModalVacacion" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-title">Agregar Vacaciones</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="container-fluid">
							<form id="formulario" class="form-neon" autocomplete="off">
								<input type="hidden" name="id" id="id">
								<fieldset>
									<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES</legend>
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="num_empleado" class="bmd-label" style="margin-top:-9%;">Nº de Empleado</label>
													<select name="num_empleado" id="num_empleado" class="form-control" required>
														<option value="">Seleccione una opcion</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="nombre_empleado" class="bmd-label" style="margin-top:-6%;">Nombre</label>
													<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="nombre_empleado" id="nombre_empleado" maxlength="27" readonly>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="item_estado" class="bmd-label" style="margin-top:-6%;">Estado</label>
													<select class="form-control" name="item_estado" id="item_estado" required>
														<option value="" selected="" disabled="">Seleccione el Estado</option>>
														<option value="3">Incapacitado</option>
														<option value="4">Vacaciones</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_inicio" class="bmd-label" style="margin-top:-6%;">Fecha de Inicio</label>
													<input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_final" class="bmd-label" style="margin-top:-6%;">Fecha Final</label>
													<input type="date" class="form-control" name="fecha_final" id="fecha_final" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="observaciones" class="bmd-label" style="margin-top:-6%;">Observaciones</label>
													<input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="27">
												</div>
											</div>


										</div>
								</fieldset>

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
					<table class="table table-dark table-sm" id="tabla_vacaciones">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>Nº EMPLEADO</th>
								<th>NOMBRE</th>
								<th>ESTADO</th>
								<th>FECHA DE INICIO</th>
								<th>FECHA FINAL</th>
								<th>DIAS VACACIONES</th>
								<th>OBSERVACION</th>
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
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/vacaciones.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>