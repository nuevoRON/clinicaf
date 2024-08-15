<?php include "views/templates/sesion.php"; 

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
    }
?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Clínica Forense</title>
	<?php include "views/templates/archivosCss.php"; ?>
</head>

<body>

	<!-- Main container -->
	<main class="full-box main-container">
		<!-- INICIO Nav lateral -->
		<?php include "views/templates/NavBar.php"; ?>
		<!-- FIN Nav lateral -->

		<!-- Page content -->
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<input type="hidden" value="<?php echo $id?>" id="id_evaluado" class="text">
			<div class="container-fluid">
				<form action="" class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DEL PROVEÍDO</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Numero de Solicitud</label>
										<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="numero_solicitud" id="numero_solicitud" maxlength="27" disabled>
									</div>
									<div class="col-12 col-md-4">
									</div>
								</div>
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Numero de Caso</label>
										<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="numero_caso" id="numero_caso" maxlength="27">
									</div>
									<div class="col-12 col-md-4">
									</div>
								</div>
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Numero Externos (Oficios, Denuncias, Expediente.)</label>
										<input type="text" class="form-control" name="numero_caso_ext" id="numero_caso_ext" maxlength="27" disabled>
									</div>
									<div class="col-12 col-md-4">
									</div>
								</div>
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="prestamo_fecha_inicio">Fecha de Emision del proveído</label>
										<input type="date" class="form-control" name="fecha_emision" id="fecha_emision" disabled>
									</div>
								</div>
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="prestamo_fecha_inicio">Fecha de recepción del proveído</label>
										<input type="date" class="form-control" name="fecha_recepcion" id="fecha_recepcion" disabled>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="item_estado" class="bmd-label-floating">Fiscalía que Remite</label>
										<input type="date" class="form-control" name="fiscalia" id="fiscalia" disabled>
									</div>
								</div>
								<div class="col-12 col-md-6">

									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Especifique Cual</label>
										<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="especifique" id="especifique" maxlength="27" disabled>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="item_estado" class="bmd-label-floating">Evaluación</label>
										<input type="date" class="form-control" name="tipo_evaluacion" id="tipo_evaluacion" disabled>
									</div>
								</div>
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
												<label for="dni" class="bmd-label-floating">DNI</label>
												<input type="text" pattern="[0-9]{1,13}" class="form-control" name="dni" id="dni" maxlength="40">
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="telefono" class="bmd-label-floating">Nº de Telefono</label>
												<input type="text" pattern="[0-9]{1,13}" class="form-control" name="telefono" id="telefono" maxlength="40">
											</div>
										</div>
										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="nacionalidad" class="bmd-label-floating">Nacionalidad</label>
												<select class="form-control" name="nacionalidad" id="nacionalidad">
													<option value="" selected="" disabled="">Seleccione la Nacionalidad</option>
													<option value="Habilitado">Hondureña</option>
													<option value="Deshabilitado">Desconocida</option>
													<option value="Deshabilitado">Otra</option>
												</select>
											</div>
										</div>

										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="sexo" class="bmd-label-floating">Sexo</label>
												<select class="form-control" name="sexo" id="sexo">
													<option value="" selected="" disabled="">Seleccione el Sexo</option>
													
												</select>

											</div>
										</div>


										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="diversidad" class="bmd-label-floating">diversidad</label>
												<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="diversidad" id="diversidad" maxlength="20">
											</div>
										</div>
										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="estadoCivil" class="bmd-label-floating">Estado Civil</label>
												<select class="form-control" name="estadoCivil" id="estadoCivil">
													<option value="" selected="" disabled="">Seleccione el Estado Civil</option>
													<option value="Habilitado">Soltero</option>
													<option value="Deshabilitado">Casado</option>
													<option value="Deshabilitado">Union Libre</option>
													<option value="Deshabilitado">No Aplica</option>
												</select>
											</div>
										</div>
					
										<div class="col-12 col-md-2">
											<div class="form-group">
												<label for="ocupacion" class="bmd-label-floating">Ocupacion</label>
												<select class="form-control" name="ocupacion" id="ocupacion">
													<option value="" selected="" disabled="">Seleccione la Ocupacion</option>
													
												</select>
											</div>
										</div>
										<!-- MODAL AGREGAR OCUPACION -->
										<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-    BOTON PARA AGREGAR    -*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* -->
										<div class="">
											<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalOcupacion">
												<i class="fas fa-plus"></i>
											</button>
										</div>
										<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- -->

										<div class="modal fade" id="ModalOcupacion" tabindex="-1" role="dialog" aria-labelledby="ModalOcupacion" data-backdrop="static" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="ModalOcupacion">Agregar Nueva Ocupacion</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<!-- Contenedor-->
													<div class="container-fluid">
														<form action="" class="form-neon" autocomplete="off">
															<fieldset>
																<div class="container-fluid">
																	<div class="row">
																		<div class="col-12 col-md-8">
																			<div class="form-group">
																				<label for="instrumento" class="bmd-label-floating">Ocupacion</label>
																				<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="instrumento_reg" id="id_instrumento	" maxlength="27">
																			</div>
																		</div>
																	</div>
																</div>
															</fieldset>

															<p class="text-center" style="margin-top: 40px;">
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

										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="escolaridad" class="bmd-label-floating">Escolaridad</label>
												<select class="form-control" name="escolaridad" id="escolaridad">
													<option value="" selected="" disabled="">Seleccione la Escolaridad</option>
													
												</select>
											</div>
										</div>
										<div class="col-12 col-md-2">
											<div class="form-group">
												<label for="edad" class="bmd-label-floating">Edad</label>
												<input type="number" pattern="[0-9()+]{8,20}" class="form-control" name="edad" id="edad" maxlength="3">
											</div>
										</div>
										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="tiempo" class="bmd-label-floating">Tiempo</label>
												<select class="form-control" name="tiempo" id="tiempo">
													<option value="" selected="" disabled="">Seleccione el Tiempo</option>
													<option value="Habilitado">Horas</option>
													<option value="Deshabilitado">Dias</option>s
													<option value="Deshabilitado">Semanas</option>
													<option value="Deshabilitado">Meses</option>
													<option value="Deshabilitado">Años</option>
												</select>
											</div>
										</div>
										<div class="col-12 col-md-2">
											<div class="form-group">
												<label for="lugar_procedencia" class="bmd-label-floating">Lugar de Procdencia del Evaluado</label>
												<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="lugar_procedencia" id="lugar_procedencia" maxlength="3">
											</div>
										</div>
									</div>
								</div>
								<br><br><br>
								<fieldset>
									<legend><i class="fas fa-user"></i> &nbsp;DATOS DEL ACOMPAÑANTE</legend>
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="nombre_acomp" class="bmd-label-floating">Nombre</label>
													<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="nombre_acomp" id="nombre_acomp" maxlength="40">
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="apellido_acomp" class="bmd-label-floating">Apellido</label>
													<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="apellido_acomp" id="apellido_acomp" maxlength="40">
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="dni_acomp" class="bmd-label-floating">DNI</label>
													<input type="text" pattern="[0-9]{1,13}" class="form-control" name="dni_acomp" id="dni_acomp" maxlength="40">
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="relacion" class="bmd-label-floating">Relacion</label>
													<select class="form-control" name="relacion" id="relacion">
														<option value="" selected="" disabled="">Seleccione el Tipo de Relacion</option>
														<option value="Habilitado">Familiar</option>
														<option value="Deshabilitado">Desconocida</option>
														<option value="Deshabilitado">Policia Militar</option>
														<option value="Deshabilitado">Fiscal</option>
														<option value="Deshabilitado">Custodio penitenciario</option>
														<option value="Deshabilitado">Otra</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</fieldset>
								<div class="container-fluid">
									<form action="" class="form-neon" autocomplete="off">
										<fieldset>
											<legend><i class="fas fa-user"></i> &nbsp;CONSENTIMIENTO INFORMADO</legend>
											<div class="container-fluid">
												<div class="row">
													<div class="col-12 col-md-3">
														<div class="form-group">
															<label for="permiso_evaluacion" class="bmd-label-floating">PERMITE LA EVALUACION</label>
															<select class="form-control" name="permiso_evaluacion" id="permiso_evaluacion">
																<option value="" selected="" disabled="">Seleccione el Estado</option>
																<option value="Habilitado">Si</option>
																<option value="Deshabilitado">No</option>
																<option value="Habilitado">No Se Encontro</option>
																<option value="Habilitado">No Se Presento a la Evaluacion</option>
															</select>
														</div>
													</div>

												</div>
											</div>
										</fieldset>
								</div>
								<br><br><br><br><br><br>
								<div class="container-fluid">
									<form action="" class="form-neon" autocomplete="off">
										<fieldset>
											<legend><i class="fas fa-user"></i> &nbsp;DATOS DEL HECHO</legend>
											<div class="container-fluid">
												<div class="row">

													<div class="col-12 col-md-3">
														<div class="form-group">
															<label for="departamento" class="bmd-label-floating">Departamento</label>
															<select class="form-control" name="departamento" id="departamento">
																<option value="" selected="" disabled="">Seleccione el Departamento</option>
																
															</select>
														</div>
													</div>
													<div class="col-12 col-md-4">
														<div class="form-group">
															<label for="municipio" class="bmd-label-floating">Municipio</label>
															<select class="form-control" name="municipio" id="municipio">
																<option value="" selected="" disabled="">Seleccione el Departamento</option>
																
															</select>
														</div>
													</div>
													<div class="col-12 col-md-4">
														<div class="form-group">
															<label for="aldea_barrio" class="bmd-label-floating">Caserio, Aldea o Barrio, del Hecho</label>
															<input type="text" class="form-control" name="aldea_barrio" id="aldea_barrio" maxlength="40">
														</div>
													</div>
													<div class="col-12 col-md-4">
														<div class="form-group">
															<label for="lugar_hecho" class="bmd-label-floating">Lugar Donde Ocurrio el Hecho</label>
															<input type="text" class="form-control" name="lugar_hecho" id="lugar_hecho" maxlength="40">
														</div>
													</div>
													<div class="col-12 col-md-4">
														<div class="form-group">
															<label for="fecha_hecho">Fecha que Ocurrio el Hecho</label>
															<input type="date" class="form-control" name="fecha_hecho" id="fecha_hecho">
														</div>
													</div>



												</div>
											</div>
										</fieldset>
								</div>

								<!--  /*/*/*/*/*/*/*/*/*/*/*/*/*            INICIO DE LA EVALUACION MEDICA       /*/*/*/*/*/*/*/*/*/*/*/*/ -->
								<br><br><br><br><br><br><br><br><br><br>
								<legend><i class="fas fa-user"></i> &nbsp; EVALUACION MEDICA</legend>

								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="instrumento" class="bmd-label-floating">Instrumemto Utilizado</label>
										<select class="form-control" name="instrumento" id="instrumento">
											<option value="" selected="" disabled="">Seleccione el Instrumemto</option>
											
										</select>
									</div>
									<!-- MODAL AGREGAR INSTRUMENTO -->
									<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-    BOTON PARA AGREGAR    -*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* -->
									<div class="">
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalInstru">
											<i class="fas fa-plus"></i>
										</button>
									</div>
									<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- -->

									<div class="modal fade" id="ModalInstru" tabindex="-1" role="dialog" aria-labelledby="ModalInstru" data-backdrop="static" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="ModalInstru">Agregar Nuevo Instrumento</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<!-- Contenedor-->
												<div class="container-fluid">
													<form action="" class="form-neon" autocomplete="off">
														<fieldset>
															<div class="container-fluid">
																<div class="row">
																	<div class="col-12 col-md-8">
																		<div class="form-group">
																			<label for="instrumento" class="bmd-label-floating">Instrumento</label>
																			<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="instrumento_reg" id="id_instrumento	" maxlength="27">
																		</div>
																	</div>
																</div>
															</div>
														</fieldset>

														<p class="text-center" style="margin-top: 40px;">
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
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="relacion_agresor" class="bmd-label-floating">Relacion Con el Agresor</label>
										<select class="form-control" name="relacion_agresor" id="relacion_agresor">
											<option value="" selected="" disabled="">Seleccione</option>
											<option value="Habilitado">Conocido</option>
											<option value="Deshabilitado">Desconocido</option>
											<option value="Deshabilitado">Autoridad Militar</option>
											<option value="Deshabilitado">No Aplica</option>
										</select>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="agresor_conocido" class="bmd-label-floating">En Caso de ser Conocido Especifique</label>
										<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="agresor_conocido" id="agresor_conocido" maxlength="3">
									</div>
								</div>


					</fieldset>

					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="descripcion_evaluacion" class="bmd-label-floating">Descripcion de la Evaluacion</label>
							<textarea name="descripcion_evaluacion" id="descripcion_evaluacion" cols="80" rows="4"></textarea><!--  /*/*/*/  ESTA ES LA CAJA DE TEXTO   /*/*/*/ -->
						</div>
					</div>
					<form method="post" action="tratamiento.php">

						Por favor, Indique el Lugar de la Evaluacion:<br>
						<!-- seran las 27 locales mas las ciudades principales TEGUCIGALPA, CEIBA, SPS. -->

						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="sede_evaluacion" class="bmd-label-floating">Sede de Evaluacion</label>
								<select class="form-control" name="sede_evaluacion" id="sede_evaluacion">
									<option value="" selected="" disabled="">Elija la Sede</option>
									<option value="Habilitado">Comayagua</option>
									<option value="Deshabilitado">Choluteca</option>
									<option value="Deshabilitado">Siguatepeque</option>
									<option value="Deshabilitado">Juticalpa</option>
									<option value="Deshabilitado">Catacamas</option>
									<option value="Deshabilitado">La Esperanza</option>
									<option value="Deshabilitado">Marcala</option>
									<option value="Deshabilitado">La Paz</option>
									<option value="Deshabilitado">Nacaome</option>
									<option value="Deshabilitado">Danli</option>
									<option value="Deshabilitado">Yuscaran</option>
									<option value="Deshabilitado">Talanga</option>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="prestamo_fecha_inicio">Fecha de Finalizacion de la Evaluacion</label>
								<input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
							</div>
						</div>
					</form>

					<!--  /*/*/*/*/*/*/*/*/*/*/*/*/*            botones de  guardado y limpiar         /*/*/*/*/*/*/*/*/*/*/*/*/ -->
					<br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
			</div>

		</section>
	</main>


	<!--=============================================
	=            Include JavaScript files           =
	==============================================-->
	<?php include "views/templates/archivosJS.php"; ?>
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/evaluados.js"></script>
</body>

</html>