<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Sedes</title>
	<?php include "views/templates/archivosCss.php"; ?>
</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<div class="full-box">
				<h4 class="text-left">
					<i class="fas fa-clinic-medical"></i> &nbsp; SEDES
				</h4>
			</div>
			<div class="container-fluid">
				<p class="text-center">
					<button type="button" class="btn btn-primary" id="btnModalSedes"><i class="fas fa-user-plus"></i> &nbsp; Agregar Sedes</button>
				</p>
			</div>

			<div class="modal fade" id="ModalSedes" tabindex="-1" role="dialog" aria-labelledby="ModalSedes" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-title">Agregar Nueva Sede</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="container-fluid">
							<form action="" class="form-neon" autocomplete="off" id="formulario">
								<fieldset>
									<legend><i class="fas fa-user"></i> &nbsp; DATOS DE LA SEDE</legend>
									<div class="container-fluid">
										<input type="hidden" name="id" id="id">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="departamento" class="bmd-label" style="margin-top:-3%;">Departamento</label>
													<select class="form-control" name="departamento" id="departamento" required>
														<option value="" selected="" disabled="">Seleccione el Departamento</option>

													</select>
												</div>
											</div>
											<div class="col-12 col-md-8">
												<div class="form-group">
													<label for="municipio" class="bmd-label" style="margin-top:-3%;">Municipio</label>
													<select class="form-control" name="municipio" id="municipio" required>

													</select>
												</div>
											</div>
											<div class="col-12 col-md-8">
												<div class="form-group">
													<label for="ubicacion" class="bmd-label" style="margin-top:-3%;">Lugar de Ubicacion</label>
													<input type="text" class="form-control" name="ubicacion" id="ubicacion" maxlength="50" required>
												</div>
											</div>
											<div class="col-12 col-md-8">
												<div class="form-group">
													<label for="ubicacion" class="bmd-label" style="margin-top:-3%;">Codigo Alfábetico</label>
													<input type="text" class="form-control" name="cod_alfabetico" id="cod_alfabetico" maxlength="5" required>
												</div>
											</div>
											<div class="col-12 col-md-8">
												<div class="form-group">
													<label for="ubicacion" class="bmd-label" style="margin-top:-3%;">Código Numérico</label>
													<input type="number" class="form-control" name="cod_numerico" id="cod_numerico" maxlength="5" required>
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
					<table class="table table-dark table-sm text-center" id="tabla_sedes">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>DEPARTAMENTO</th>
								<th>MUNICIPIO</th>
								<th>UBICACION</th>
								<th>CODIGO ALFABETICO</th>
								<th>CODIGO NUMERICO</th>
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
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/sedes.js"></script>

</body>

</html>