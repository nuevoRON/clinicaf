<?php include "views/templates/sesion.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Control de Dictamenes</title>
	<?php include "views/templates/archivosCss.php"; ?>
</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<div class="full-box">
				<h4 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; CONTROL DE DICTAMENES
				</h4>
			</div>
			<div class="container-fluid">
				<p class="text-center">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalDictamen"><i class="fas fa-user-plus"></i> &nbsp; Nuevo Control</button>
				</p>
			</div>

			<div class="modal fade" id="ModalDictamen" tabindex="-1" role="dialog" aria-labelledby="ModalDictamen" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-title">Agregar</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="container-fluid">
							<form id="formulario" class="form-neon" autocomplete="off">
								<input type="hidden" name="id" id="id">
								<fieldset>
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label for="num_caso" class="bmd-label-floating">Numero del Caso</label>
													<select class="form-control" name="num_caso" id="num_caso">
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label for="medico" class="bmd-label-floating">Nombre del medico</label>
													<select class="form-control" name="medico" id="medico">
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_evaluacion">Fecha de Evaluacion</label>
													<input type="date" class="form-control" name="fecha_evaluacion" id="fecha_evaluacion">
												</div>
											</div>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label for="autoridad_soli" class="bmd-label-floating">Autoridad Solicitante </label>
													<input type="text" class="form-control" name="autoridad_soli" id="autoridad_soli" maxlength="27">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="tipo_documento" class="bmd-label-floating">Tipo de Docuemnto</label>
													<select class="form-control" name="tipo_documento" id="tipo_documento">
														<option value="" selected="" disabled="">Selecciones su Opcion</option>
														<option value="Dictamen">Dictamen</option>
														<option value="Transcripcion">Transcripcion</option>
														<option value="Ampliacion">Ampliacion</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_entrega">Fecha de Entrega</label>
													<input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega">
												</div>
											</div>
											<div class="col-12 col-md-10">
												<div class="form-group">
													<label for="datos_extra" class="bmd-label-floating">Datos extra</label>
													<input type="text" class="form-control" name="datos_extra" id="datos_extra" maxlength="27">
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
					<table class="table table-dark table-sm" id="tabla-dictamenes">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>NUMERO DEL CASO</th>
								<th>TIPO DE DOCUMENTO</th>
								<th>NOMBRE DEL MEDICO</th>
								<th>FECHA DE EVALUACION</th>
								<th>AUTORIDAD SOLICITANTE</th>

								<th>FECHA DE ENTREGA</th>
								<th>DATOS EXTRA</th>
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
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/dictamenes.js"></script>
</body>

</html>