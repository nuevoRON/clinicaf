<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Clínica Forense</title>
	<?php include "./inc/link.php"; ?>


</head>
<body>
	
	<!-- Main container -->
	<main class="full-box main-container">
<!-- INICIO Nav lateral -->
<?php include "./inc/NavBar.php"; ?>
<!-- FIN Nav lateral -->

		<!-- Page content -->
		<section class="full-box page-content">
		<?php include "./inc/NavSup.php"; ?>

<!-- Page header -->
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR PROVEÍDO
				</h3>
				<p class="text-justify">
					Asegúrese de agregar la información de manera clara y correcta
				</p>
<!--FIN Page header -->
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a class="active" href="proveido.php"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR PROVEÍDO</a>
					</li>
					<li>
						<a href="lista-proveido.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PROVEÍDOS</a>
					</li>
				</ul>	
			</div>
			
<!-- Contenedor-->
			<div class="container-fluid">
				<form action="" class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DEL PROVEÍDO</legend>
						<div class="container-fluid">
						<div class="row">
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Numero de solicitud</label>
										<input type="text" pattern="[0-9-]{1,27}" class="form-control" value="4410-2024" name="cliente_dni_reg" id="cliente_dni" maxlength="27" disabled>
									</div>
									<div class="col-12 col-md-4">
									</div>
								</div>
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Numero Externos (Oficios, Denuncias, Expediente.)</label>
										<input type="text"  class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
									</div>
								</div>
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="prestamo_fecha_inicio">Fecha de Emision del proveído</label>
										<input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
									</div>
								</div>
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="prestamo_fecha_inicio">Fecha de recepción del proveído</label>
										<input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio" disabled>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="item_estado" class="bmd-label-floating">Fiscalía que Remite</label>
										<select class="form-control" name="item_estado_reg" id="item_estado">
											<option value="" selected="" disabled="">Seleccione la Fiscalía</option>
											<option value="Habilitado">CONADEH</option>
											<option value="Deshabilitado">CONAPREV</option>
											<option value="Deshabilitado">Corte Suprema de Justicia (CSJ)</option>
											<option value="Deshabilitado">RNP</option>
											<option value="Deshabilitado">Unidad de Muertes Violentas Bajo Aguan (UMVIBA)</option>
										</select>
									</div>
								</div>
								<div class="col-12 col-md-6">
									
										<div class="form-group">
											<label for="cliente_dni" class="bmd-label-floating">Especifique Cual</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
										</div>
								</div>

						<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DEL EVALUADO</legend>
						<div class="container-fluid">
						<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="cliente_nombre" class="bmd-label-floating">Nombre</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="cliente_nombre_reg" id="cliente_nombre" maxlength="40">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="cliente_apellido" class="bmd-label-floating">Apellido</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="40">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="cliente_apellido" class="bmd-label-floating">DNI</label> 
										<input type="text" pattern="[0-9]{1,13}" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="40">
									</div>
								</div>

<!-- 							Contenedor-->
								<div class="container-fluid">
									<form action="" class="form-neon" autocomplete="off">
								<fieldset>
									<legend><i class="fas fa-user"></i> &nbsp;DATOS DEL HECHO</legend>
									<div class="container-fluid">
										<div class="row">

											<div class="col-12 col-md-3">
												<div class="form-group">
													<label for="item_estado" class="bmd-label-floating">Departamento</label>
													<select class="form-control" name="item_estado_reg" id="item_estado">
														<option value="" selected="" disabled="">Seleccione el Departamento</option>
														<option value="Habilitado">Atlantida</option>
														<option value="Deshabilitado">Choluteca</option>
														<option value="Deshabilitado">Colon</option>
														<option value="Deshabilitado">Comayagua</option>
														<option value="Deshabilitado">Copan</option>
													</select>
												</div>
											</div>	
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="cliente_apellido" class="bmd-label-floating">Municipio</label>
													<input type="text" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="40">
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="cliente_apellido" class="bmd-label-floating">Caserío, Aldea o Barrio, del Hecho</label>
													<input type="text"  class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="40">
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="cliente_apellido" class="bmd-label-floating">Lugar Donde Ocurrió el Hecho</label>
													<input type="text" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="40">
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label for="prestamo_fecha_inicio">Fecha que Ocurrió el Hecho</label>
													<input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
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
							<form action="" class="form-neon" autocomplete="off">
								<fieldset>
									<legend><i class="fas fa-user"></i> &nbsp;Tipo de Reconocimiento (consultar si se cambia por evaluacion)</legend>
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
								<label for="item_estado" class="bmd-label-floating">Reconocimiento</label>
								<select class="form-control" name="item_estado_reg" id="item_estado">
									<option value="" selected="" disabled="">Seleccione el Tipo de Reconocimiento</option>
									<option value="Habilitado">Estado de Salud</option>
									<option value="Deshabilitado">Delito Sexual</option>
									<option value="Deshabilitado">Lesiones</option>
									<option value="Deshabilitado">Expediente Clínico</option>
								</select>
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
					</fieldset>
					<br><br><br>
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
	<?php include "./inc/java.php"; ?>

</body>
</html>