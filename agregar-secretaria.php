<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Clinica Forense</title>
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
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR SECRETARIA
				</h3>
				<p class="text-justify">
					Asegúrese de agregar la información de manera clara y correcta
				</p>
			</div>
<!--FIN Page header -->
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a class="active" href="proveido.php"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR SECRETARIA</a>
					</li>
					<li>
						<a href="lista-proveido.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE SECRETARIAS</a>
					</li>
				</ul>	
			</div>
			
<!-- Contenedor-->
			<div class="container-fluid">
				<form action="" class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DEL SECRETARIA</legend>
						<div class="container-fluid">
						<div class="row">
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Nombre del secretaria</label>
										<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
									</div>
									<div class="col-12 col-md-4">
									</div>
								</div>
								<div class="col-12 col-md-2">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Apellido del secretaria</label>
										<input type="text"  class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
									</div>
									<div class="col-12 col-md-4">
									</div>
								</div>
								<div class="col-12 col-md-2">									
										<div class="form-group">
											<label for="cliente_dni" class="bmd-label-floating">DNI</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
										</div>
								</div>
								<div class="col-12 col-md-2">									
										<div class="form-group">
											<label for="cliente_dni" class="bmd-label-floating">Nº de Empleado</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
										</div>
								</div>
								<div class="col-12 col-md-2">
										<div class="form-group">
											<label for="cliente_dni" class="bmd-label-floating">Correo Electronico</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
										</div>
								</div>
								<div class="col-12 col-md-2">
										<div class="form-group">
											<label for="cliente_dni" class="bmd-label-floating">Nº de Telefono</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
										</div>
								</div>
					</div>
					</div>
				</fieldset>
<!-- CAMBIO -->

<fieldset>
	<legend><i class="fas fa-user"></i> &nbsp; Estados</legend>						
	<div class="container-fluid">						
		<div class="row">
				<div class="col-12 col-md-2">
					<div class="form-group">
						<label for="item_estado" class="bmd-label-floating">Jornada</label>
						<select class="form-control" name="item_estado_reg" id="item_estado">
							<option value="" selected="" disabled="">Seleccione la Jornanda</option>
							<option value="Habilitado">Matunina</option>
							<option value="Deshabilitado">Vespertina</option>
							<option value="Deshabilitado">Nocturna</option>
						</select>
					</div>								
				</div>
				<div class="col-12 col-md-2">
					<div class="form-group">
						<label for="item_estado" class="bmd-label-floating">Estado</label>
						<select class="form-control" name="item_estado_reg" id="item_estado">
							<option value="" selected="" disabled="">Seleccione el Estado</option>
							<option value="Habilitado">Activo</option>
							<option value="Deshabilitado">Inactivo</option>
							<option value="Deshabilitado">incapacitado</option>
							<option value="Deshabilitado">Vacaciones</option>
						</select>
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

		</section>
	</main>
	
	
	<!--=============================================
	=            Include JavaScript files           =
	==============================================-->
	<?php include "./inc/java.php"; ?>
</body>
</html>