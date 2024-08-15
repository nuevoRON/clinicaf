<?php include "views/templates/sesion.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Lista de proveido</title>
	<?php include "views/templates/archivosCss.php"; ?>

</head>

<body>
	<!-- Main container -->
	<main class="full-box main-container">
		<!-- INICIO Nav lateral -->
		<?php include "views/templates/NavBar.php"; ?>

		<!-- Page content -->
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>

			<!-- Page header -->
			<h3 class="text-left">
				<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PROVEÍDO
			</h3>
			<div class="container-fluid">
				<div class="container-fluid">
					<p class="text-center">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modalproveído"><i class="fas fa-user-plus"></i> &nbsp; Agregar Proveído</button>
					</p>
				</div>
			</div>
			<!-- Content here-->
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm text-center" id="tabla_proveidos">
						<thead>
							<tr class="text-center roboto-medium">
								<th># DE SOLICITUD</th>
								<th>DNI</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>DEPENDIA SOLICITANTE</th>
								<th>TIPO RECONOCIMINETO</th>
								<th>FECHA PARA LA CUAL FUE CITADO</th>
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

	<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* -->
	<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* -->
	<!-- MODAL PROVEÍDO -->
	<div class="modal fade" id="Modalproveído" tabindex="-1" role="dialog" aria-labelledby="Modalproveído" data-backdrop="static" aria-hidden="true">
		<!-- caja de dialogo -->
		<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
			<!-- caja de contenido -->
			<div class="modal-content">
				<!-- encanezado de la caja -->
				<div class="modal-header">
					<h5 class="modal-title" id="Modalproveído">Agregar Proveído</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form action="" class="form-neon" id="formulario">
							<fieldset>
								<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DEL PROVEÍDO</legend>
								<input type="hidden" class="form-control" name="id" id="id">
								<div class="container-fluid">
									<div class="row">
										<div class="form-group">
											<label for="numero_solicitud_reg" class="bmd-label-floating">Numero de solicitud</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="numero_solicitud_reg" id="numero_solicitud_reg" maxlength="27">
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label for="numero_externo_reg" class="bmd-label-floating">Numero Externos (Oficios, Denuncias, Expediente.)</label>
												<input type="text" class="form-control" name="numero_externo_reg" id="numero_externo_reg" maxlength="27">
											</div>
										</div>
										&nbsp; &nbsp;
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label for="fecha_emision">Fecha de Emision del proveído</label>
												<input type="date" class="form-control" name="fecha_emision" id="fecha_emision">
											</div>
										</div>
										&nbsp; &nbsp;
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label for="fecha_recepcion">Fecha de recepción del proveído</label>
												<input type="date" class="form-control" name="fecha_recepcion" id="fecha_recepcion">
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label for="item_dependencia_reg" class="bmd-label-floating">Fiscalía que Remite</label>
												<select class="form-control" name="item_dependencia_reg" id="item_dependencia_reg">
													<option value="" selected="" disabled="">Seleccione la Fiscalía</option>

												</select>
											</div>
										</div>
										<div class="col-12 col-md-6">

											<div class="form-group">
												<label for="especificar" class="bmd-label-floating">Especifique Cual</label>
												<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="especificar" id="especificar" maxlength="27">
											</div>
										</div>
										&nbsp; &nbsp; &nbsp; &nbsp;
										<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DEL EVALUADO</legend>
										<div class="container-fluid">
											<div class="row">
												<div class="col-12 col-md-4">
													<div class="form-group">
														<label for="nombre" class="bmd-label-floating">Nombre</label>
														<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="nombre" id="nombre" maxlength="40">
													</div>
												</div>
												<div class="col-12 col-md-4">
													<div class="form-group">
														<label for="apellido" class="bmd-label-floating">Apellido</label>
														<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="apellido" id="apellido" maxlength="40">
													</div>
												</div>
												<div class="col-12 col-md-4">
													<div class="form-group">
														<label for="cliente_apellido" class="bmd-label-floating">DNI</label>
														<input type="text" pattern="[0-9]{1,13}" class="form-control" name="dni" id="dni" maxlength="40">
													</div>
												</div>

												<!-- Contenedor-->
												&nbsp; &nbsp; &nbsp; &nbsp;
												<div class="container-fluid">
													<fieldset>
														<legend><i class="fas fa-user"></i> &nbsp;DATOS DEL HECHO</legend>
														<div class="container-fluid">
															<div class="row">

																<div class="col-12 col-md-7">
																	<div class="form-group">
																		<label for="item_departamento_reg" class="bmd-label-floating">Departamento</label>
																		<select class="form-control" name="item_departamento_reg" id="item_departamento_reg">
																			<option value="" selected="" disabled="">Seleccione el Departamento</option>

																		</select>
																	</div>
																</div>
																&nbsp; &nbsp;
																<div class="col-12 col-md-4">
																	<div class="form-group">
																		<label for="item_municipio_reg" class="bmd-label-floating">Municipio</label>
																		<select class="form-control" name="item_municipio_reg" id="item_municipio_reg">
																			<option value="" selected="" disabled="">Seleccione el Municipio</option>

																		</select>
																	</div>
																</div>
																<div class="col-12 col-md-6">
																	<div class="form-group">
																		<label for="aldea_barrio" class="bmd-label-floating">Caserío, Aldea o Barrio, del Hecho</label>
																		<input type="text" class="form-control" name="aldea_barrio" id="aldea_barrio" maxlength="40">
																	</div>
																</div>
																<div class="col-12 col-md-6">
																	<div class="form-group">
																		<label for="lugar" class="bmd-label-floating">Lugar Donde Ocurrió el Hecho</label>
																		<input type="text" class="form-control" name="lugar" id="lugar" maxlength="40">
																	</div>
																</div>
																<div class="col-12 col-md-6">
																	<div class="form-group">
																		<label for="fecha_hecho">Fecha que Ocurrió el Hecho</label>
																		<input type="date" class="form-control" name="fecha_hecho" id="fecha_hecho">
																	</div>
																</div>



															</div>
														</div>
													</fieldset>
												</div>


											</div>
										</div>
										<!--=============================================
										=            prueba de contenedor           =
										==============================================-->

										<div class="container-fluid">
											<fieldset>
												<legend><i class="fas fa-user"></i> &nbsp;TIPO DE RECONOCIMIENTO </legend>
												<div class="container-fluid">
													<div class="row">


													</div>
												</div>
											</fieldset>
										</div>

										<!--=============================================
										=            prueba de contenedor           =
										==============================================-->
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label for="item_recon_reg" class="bmd-label-floating">Reconocimiento</label>
												<select class="form-control" name="item_recon_reg" id="item_recon_reg">
													<option value="" selected="" disabled="">Seleccione el Tipo de Reconocimiento</option>
												</select>
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
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label for="fecha_citacion">Fecha Para la cual fue citado</label>
												<input type="date" class="form-control" name="fecha_citacion" id="fecha_citacion">
											</div>
										</div>
									</div>
				
									<p class="text-center" style="margin-top: 40px;">
										<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
										&nbsp; &nbsp;
										<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
									</p>
						</form>
					</div>
				</div>
					<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* -->
					<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* -->



					<!--=============================================
	=            Include JavaScript files           =
	==============================================-->
					<?php include "views/templates/archivosJS.php"; ?>
					<script src="<?php echo BASE_URL; ?>assets/js/modulos/proveidos.js"></script>
</body>

</html>