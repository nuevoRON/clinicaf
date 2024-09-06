<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Proveidos</title>
	<?php include "views/templates/archivosCss.php"; ?>

</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<h3 class="text-left">
				<i class="fas fa-users fa-fw"></i> &nbsp; LISTA DE PROVEÍDOS
			</h3>
			<div class="container-fluid">
				<div class="text-center">
					<button type="button" class="btn btn-primary" id="btnModalProveido1">
						<i class="fas fa-user-plus"></i> &nbsp; Agregar Proveído
					</button>
					<button type="button" class="btn btn-danger" id="btnPDFProveido">
						<i class="fas fa-file-pdf"></i> &nbsp; Exportar PDF
					</button>
					<button type="button" class="btn btn-success" id="btnExcelProveido">
						<i class="fas fa-file-excel"></i> &nbsp; Exportar Excel
					</button>
				</div>
			</div>
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


	<div class="modal fade" id="Modalproveído" tabindex="-1" role="dialog" aria-labelledby="Modalproveído" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal-title">Agregar Proveído</h5>
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
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label for="numero_solicitud_reg" class="bmd-label-floating">Numero de solicitud</label>
												<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="numero_solicitud_reg" id="numero_solicitud_reg" readonly>
											</div>
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
												<input type="date" class="form-control" name="fecha_emision" id="fecha_emision" required>
											</div>
										</div>
										&nbsp; &nbsp;
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label for="fecha_recepcion">Fecha de recepción del proveído</label>
												<input type="date" class="form-control" name="fecha_recepcion" id="fecha_recepcion" required>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label for="item_dependencia_reg" class="bmd-label-floating">Fiscalía que Remite</label>
												<select class="form-control" name="item_dependencia_reg" id="item_dependencia_reg" required>
													<option value="" selected="" disabled="">Seleccione la Fiscalía</option>

												</select>
											</div>
										</div>
										<div class="col-12 col-md-6">

											<div class="form-group">
												<label for="especificar" class="bmd-label-floating">Especifique Cual</label>
												<input type="text" class="form-control" name="especificar" id="especificar" maxlength="30">
												<span id="spanEspecificar" style="color: red; font-size:1rem;"></span>
											</div>
										</div>
										&nbsp; &nbsp; &nbsp; &nbsp;
										<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DEL EVALUADO</legend>
										<div class="container-fluid">
											<div class="row">
												<div class="col-12 col-md-4">
													<div class="form-group">
														<label for="nombre" class="bmd-label-floating">Nombre</label>
														<input type="text" class="form-control" name="nombre" id="nombre" required>
														<span id="spanNombre" style="color: red; font-size:1rem;"></span>
													</div>
												</div>
												<div class="col-12 col-md-4">
													<div class="form-group">
														<label for="apellido" class="bmd-label-floating">Apellido</label>
														<input type="text" class="form-control" name="apellido" id="apellido" required>
														<span id="spanApellido" style="color: red; font-size:1rem;"></span>
													</div>
												</div>
												<div class="col-12 col-md-4">
													<div class="form-group">
														<label for="dni" class="bmd-label-floating">DNI</label>
														<input type="text" pattern="[0-9]{1,13}" title="Este campo solo acepta números"
															class="form-control" name="dni" id="dni" required maxlength="13">
													</div>
												</div>

												<!-- Contenedor-->
												&nbsp; &nbsp; &nbsp; &nbsp;
												<div class="container-fluid">
													<fieldset>
														<legend><i class="fas fa-user"></i> &nbsp;DATOS DEL HECHO</legend>
														<div class="container-fluid">
															<div class="row">

																<div class="col-12 col-md-6">
																	<div class="form-group">
																		<label for="item_departamento_reg" class="bmd-label-floating">Departamento</label>
																		<select class="form-control" name="item_departamento_reg" id="item_departamento_reg" required>
																			<option value="" selected="" disabled="">Seleccione el Departamento</option>

																		</select>
																	</div>
																</div>
																&nbsp; &nbsp;
																<div class="col-12 col-md-5">
																	<div class="form-group">
																		<label for="item_municipio_reg" class="bmd-label-floating">Municipio</label>
																		<select class="form-control" name="item_municipio_reg" id="item_municipio_reg" required>
																			<option value="" selected="" disabled="">Seleccione el Municipio</option>

																		</select>
																	</div>
																</div>
																<div class="col-12 col-md-6">
																	<div class="form-group">
																		<label for="aldea_barrio" class="bmd-label-floating">Caserío, Aldea o Barrio, del Hecho</label>
																		<input type="text" class="form-control" name="aldea_barrio" id="aldea_barrio" required>
																		<span id="spanBarrio" style="color: red; font-size:1rem;"></span>
																	</div>
																</div>
																<div class="col-12 col-md-6">
																	<div class="form-group">
																		<label for="lugar" class="bmd-label-floating">Lugar Donde Ocurrió el Hecho</label>
																		<input type="text" class="form-control" name="lugar" id="lugar" required>
																		<span id="spanLugar" style="color: red; font-size:1rem;"></span>
																	</div>
																</div>
																<div class="col-12 col-md-6">
																	<div class="form-group">
																		<label for="fecha_hecho">Fecha que Ocurrió el Hecho</label>
																		<input type="date" class="form-control" name="fecha_hecho" id="fecha_hecho" required>
																	</div>
																</div>



															</div>
														</div>
													</fieldset>
												</div>


											</div>
										</div>
										

										<div class="container-fluid">
											<fieldset>
												<legend><i class="fas fa-user"></i> &nbsp;TIPO DE RECONOCIMIENTO </legend>
												<div class="container-fluid">
													<div class="row">

													</div>
												</div>
											</fieldset>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label for="item_recon_reg" class="bmd-label-floating">Reconocimiento</label>
												<select class="form-control" name="item_recon_reg" id="item_recon_reg" required>
													<option value="" selected="" disabled="">Seleccione el Tipo de Reconocimiento</option>
												</select>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label for="medico" class="bmd-label-floating">Medico</label>
												<select class="form-control" name="medico" id="medico" required>
													<option value="" selected="" disabled="">Seleccione al Medico</option>

												</select>
											</div>
										</div>
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label for="fecha_citacion">Fecha Para la cual fue citado</label>
												<input type="date" class="form-control" name="fecha_citacion" id="fecha_citacion" required>
											</div>
										</div>
									</div>

									<p class="text-center" style="margin-top: 40px;">
										<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
										&nbsp; &nbsp;
										<button type="submit" class="btn btn-raised btn-info btn-sm" id="btn-enviar"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
									</p>
						</form>
					</div>
				</div>
				
	<?php include "views/templates/archivosJS.php"; ?>
	<script type="module" src="<?php echo BASE_URL; ?>assets/js/modulos/proveidos.js"></script>
	<script type="module" src="<?php echo BASE_URL; ?>assets/js/validaciones/validacionProveidos.js"></script>
</body>

</html>