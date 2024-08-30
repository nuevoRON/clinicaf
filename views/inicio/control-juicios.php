<?php include "views/templates/sesion.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Citaciones</title>
	<?php include "views/templates/archivosCss.php"; ?>
<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<div class="full-box">
				<h4 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; CONTROL DE CITACIONES
				</h4>
			</div>
			<div class="container-fluid">
				<p class="text-center">
					<button type="button" class="btn btn-primary" id="btnModalCitacion"><i class="fas fa-user-plus"></i> &nbsp; Agregar Citacion</button>
				</p>
			</div>

			<div class="modal fade" id="ModalCitacion" tabindex="-1" role="dialog" aria-labelledby="ModalCitacion" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-title">Agregar Citacion</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="container-fluid">
							<form id="formulario" class="form-neon" >
								<input type="hidden" class="" name="id" id="id">
								<fieldset>
									<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DE LA CITACION</legend>
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
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="tipo_citacion" class="bmd-label-floating">Tipo de Citacion</label>
													<select class="form-control" name="tipo_citacion" id="tipo_citacion">
														<option value="" selected="" disabled="">Seleccione la Citacion</option>
														<option value="Juicio">Juicio</option>
														<option value="Juramentacion">Juramentacion</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_rec_citacion">Fecha que se recibe la citacion</label>
													<input type="date" class="form-control" name="fecha_rec_citacion" id="fecha_rec_citacion">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_citacion">Fecha de la citacion</label>
													<input type="date" class="form-control" name="fecha_citacion" id="fecha_citacion">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="medico" class="bmd-label-floating">Medico</label>
													<select class="form-control" name="medico" id="medico">
														<option value="" selected="" disabled="">Seleccione al Medico</option>

													</select>
												</div>
											</div>
											<div class="col-12 col-md-8">
												<div class="form-group">
													<label for="lugar_citacion" class="bmd-label-floating">Lugar de la citacion</label>
													<input type="text" class="form-control" name="lugar_citacion" id="lugar_citacion" maxlength="50">
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
					<table class="table table-dark table-sm text-center" id="tabla_citaciones">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>NUMERO DEL CASO</th>
								<th>TIPO DE CITACION</th>
								<th>FECHA DE RECEPCION DE CITACION</th>
								<th>FECHA DE LA CITACION</th>
								<th>NOMBRE DEL MEDICO</th>
								<th>APELLIDO DEL MEDICO</th>
								<th>LUGAR DE LA CITACION</th>
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
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/citaciones.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>