<?php include "views/templates/sesion.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Lista de citaciones</title>
	<?php include "views/templates/archivosCss.php"; ?>
<body>

	<!-- Main container -->
	<main class="full-box main-container">
		<!-- INICIO Nav lateral -->
		<?php include "views/templates/NavBar.php"; ?>
		<!-- FIN Nav lateral -->

		<!-- Page content -->
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>

			<!-- Page header -->
			<div class="full-box">
				<h4 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; CONTROL DE CITACIONES
				</h4>
			</div>


			<!--=====================================================================================================================================================================================
	=                      ==                      ==                      ==                      ==                      ==                      ==                      ==               =
	======================================================================================================================================================================================-->

			<!-- MODAL CITACION -->

			<div class="container-fluid">
				<p class="text-center">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCitacion"><i class="fas fa-user-plus"></i> &nbsp; Agregar Citacion</button>
				</p>

			</div>



			<div class="modal fade" id="ModalCitacion" tabindex="-1" role="dialog" aria-labelledby="ModalCitacion" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ModalCitacion">Agregar Citacion</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<!-- Contenedor-->
						<div class="container-fluid">
							<form action="" class="form-neon" autocomplete="off">
								<fieldset>
									<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DE LA CITACION</legend>
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label for="cliente_dni" class="bmd-label-floating">Numero del Caso</label>
													<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="item_estado" class="bmd-label-floating">Tipo de Citacion</label>
													<select class="form-control" name="item_estado_reg" id="item_estado">
														<option value="" selected="" disabled="">Seleccione la Citacion</option>
														<option value="Habilitado">Juicio</option>
														<option value="Habilitado">Juramentacion</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="prestamo_fecha_inicio">Fecha que se recibe la citacion</label>
													<input type="date" class="form-control" name="fecha_citacion" id="fecha_citacion_id">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="prestamo_fecha_inicio">Fecha de la citacion</label>
													<input type="date" class="form-control" name="fecha_citacion" id="fecha_citacion_id">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="item_estado" class="bmd-label-floating">Medico</label>
													<select class="form-control" name="item_estado_reg" id="item_estado">
														<option value="" selected="" disabled="">Seleccione al Medico</option>
														<option value="Habilitado">Fernando Flores</option>
														<option value="Deshabilitado">Raul Aguilar</option>
														<option value="Deshabilitado">Claudia Lagos</option>
														<option value="Deshabilitado">Arnoldo Castillo</option>
														<option value="Deshabilitado">Jose Lobo</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-8">
												<div class="form-group">
													<label for="cliente_dni" class="bmd-label-floating">Lugar de la citacion</label>
													<input type="text" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="50">
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
			<!--=====================================================================================================================================================================================
	=                      ==                      ==                      ==                      ==                      ==                      ==                      ==               =
======================================================================================================================================================================================-->

			<!-- Content here-->
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>NUMERO DEL CASO</th>
								<th>TIPO DE CITACION</th>
								<th>FECHA DE RECEPCION DE CITACION</th>
								<th>FECHA DE LA CITACION</th>
								<th>NOMBRE DEL MEDICO</th>
								<th>LUGAR DE LA CITACION</th>
								<th>MODIFICAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>
							<tr class="text-center">
								<td>1</td>
								<td>4250-2017</td>
								<td>Juicio</td>
								<td>25/03/2024</td>
								<td>14/04/2024</td>
								<td>juan fernando</td>
								<td>tribunal de setencias tegucigalpa</td>
								<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalCitacion">
										<i class="fas fa-sync-alt"></i>
									</button>
								</td>
								<td>
									<form action="">
										<button type="button" class="btn btn-warning">
											<i class="far fa-trash-alt"></i>
										</button>
									</form>
								</td>
							</tr>
							<tr class="text-center">
								<td>2</td>
								<td>8520-2023</td>
								<td>Juramentacion</td>
								<td>26/01/2024</td>
								<td>14/04/2024</td>
								<td>jose argueta</td>
								<td>jusgado de la comyagaua</td>
								<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalCitacion">
										<i class="fas fa-sync-alt"></i>
									</button>
								</td>
								<td>
									<form action="">
										<button type="button" class="btn btn-warning">
											<i class="far fa-trash-alt"></i>
										</button>
									</form>
								</td>
							</tr>
							<tr class="text-center">
								<td>3</td>
								<td>5628-2023</td>
								<td>Juramentacion</td>
								<td>18/12/2023</td>
								<td>15/06/2024</td>
								<td>julio fernandez</td>
								<td>tribunal de sentencias tegucigalpa</td>
								<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalCitacion">
										<i class="fas fa-sync-alt"></i>
									</button>
								</td>
								<td>
									<form action="">
										<button type="button" class="btn btn-warning">
											<i class="far fa-trash-alt"></i>
										</button>
									</form>
								</td>
							</tr>
							<tr class="text-center">
								<td>4</td>
								<td>4230-2022</td>
								<td>Juicio</td>
								<td>24/06s/2024</td>
								<td>25/06/2024</td>
								<td>julio fernandez</td>
								<td>tribunal de sentencias juticalpa</td>
								<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalCitacion">
										<i class="fas fa-sync-alt"></i>
									</button>
								</td>
								<td>
									<form action="">
										<button type="button" class="btn btn-warning">
											<i class="far fa-trash-alt"></i>
										</button>
									</form>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item disabled">
							<a class="page-link" href="#" tabindex="-1">Previous</a>
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item">
							<a class="page-link" href="#">Next</a>
						</li>
					</ul>
				</nav>
			</div>

		</section>
	</main>


	<!--=============================================
	=            Include JavaScript files           =
	==============================================-->
	<?php include "views/templates/archivosJS.php"; ?>

</body>

</html>