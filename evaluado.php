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

			<nav class="full-box navbar-info">
				<a href="#" class="float-left show-nav-lateral">
					<i class="fas fa-exchange-alt"></i>
				</a>
				<a href="user-update.html">
					<i class="fas fa-user-cog"></i>
				</a>
				<a href="#" class="btn-exit-system">
					<i class="fas fa-power-off"></i>
				</a>
			</nav>


									<!--=============================================
									=           se comento por que se requiere           =
									==============================================-->
<!-- Page header -->
<!-- 			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR PROVEÍDO
				</h3>
				<p class="text-justify">
					Asegúrese de agregar la información de manera clara y correcta
				</p>
			</div> -->
<!--FIN Page header -->
									<!--=============================================
									=           se comento por que se requiere           =
									==============================================-->
<!-- 			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a class="active" href="proveido.html"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR PROVEÍDO</a>
					</li>
					<li>
						<a href="lista-proveido.html"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PROVEÍDOS</a>
					</li>
					<li>
						<a href="client-search.html"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PROVEÍDOS</a>
					</li>
				</ul>	
			</div> -->
			
<!-- Contenedor-->
<div class="container-fluid">
<form action="" class="form-neon" autocomplete="off">
	<fieldset>
		<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DEL PROVEÍDO</legend>
		<div class="container-fluid">
		<div class="row">
				<div class="col-12 col-md-2">
					<div class="form-group">
						<label for="cliente_dni" class="bmd-label-floating">Numero de Solicitud</label>
						<input type="text" pattern="[0-9-]{1,27}" class="form-control" value="4410-2024" name="cliente_dni_reg" id="cliente_dni" maxlength="27" disabled>
					</div>
					<div class="col-12 col-md-4">
					</div>
				</div>
				<div class="col-12 col-md-2">
					<div class="form-group">
						<label for="cliente_dni" class="bmd-label-floating">Numero de Caso</label>
						<input type="text" pattern="[0-9-]{1,27}" class="form-control" value="4300-2024" name="cliente_dni_reg" id="cliente_dni" maxlength="27" >
					</div>
					<div class="col-12 col-md-4">
					</div>
				</div>
				<div class="col-12 col-md-2">
					<div class="form-group">
						<label for="cliente_dni" class="bmd-label-floating">Numero Externos (Oficios, Denuncias, Expediente.)</label>
						<input type="text"  class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27" disabled>
					</div>
					<div class="col-12 col-md-4">
					</div>
				</div>
				<div class="col-12 col-md-2">
					<div class="form-group">
						<label for="prestamo_fecha_inicio">Fecha de Emision del proveído</label>
						<input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio" disabled>
					</div>
				</div>
				<div class="col-12 col-md-2">
					<div class="form-group">
						<label for="prestamo_fecha_inicio">Fecha de recepcion del proveído</label>
						<input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio" disabled>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<label for="item_estado" class="bmd-label-floating">Fiscalia que Remite</label>
						<select class="form-control" name="item_estado_reg" id="item_estado" disabled>
							<option value="" selected="" disabled="">Seleccione la Fiscalia</option>
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
							<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27" disabled>
						</div>
				</div>
				<div class="col-12 col-md-6">   
			<div class="form-group">
				<label for="item_estado" class="bmd-label-floating">Evaluacion</label>
				<select class="form-control" name="item_estado_reg" id="item_estado" disabled>
					<option value="" selected="" disabled="">Seleccione el Tipo de Evaluacion</option>
					<option value="Habilitado">Estado de Salud</option>
					<option value="Deshabilitado">Delito Sexual</option>
					<option value="Deshabilitado">Lesiones</option>
					<option value="Deshabilitado">Expediente Clinico</option>
				</select>
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
				<div class="col-12 col-md-4">
					<div class="form-group">
						<label for="cliente_apellido" class="bmd-label-floating">Nº de Telefono</label>
						<input type="text" pattern="[0-9]{1,13}" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="40">
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group">
						<label for="item_estado" class="bmd-label-floating">Nacionalidad</label>
						<select class="form-control" name="item_estado_reg" id="item_estado">
							<option value="" selected="" disabled="">Seleccione la Nacionalidad</option>
							<option value="Habilitado">Hondureña</option>
							<option value="Deshabilitado">Desconocida</option>
							<option value="Deshabilitado">Otra</option>
						</select>
					</div>
				</div>
			
				<div class="col-12 col-md-3">
					<div class="form-group">
						<label for="item_estado" class="bmd-label-floating">Sexo</label>
						<select class="form-control" name="item_estado_reg" id="item_estado">
							<option value="" selected="" disabled="">Seleccione el Sexo</option>
							<option value="Habilitado">Masculino</option>
							<option value="Deshabilitado">Femenino</option>
							<option value="Deshabilitado">A Determinar</option>
							<option value="Deshabilitado">Testigo Protegido</option>
						</select>
					</div>	
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group">
						<label for="cliente_telefono" class="bmd-label-floating">diversidad</label>
						<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="20">
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group">
						<label for="item_estado" class="bmd-label-floating">Estado Civil</label>
						<select class="form-control" name="item_estado_reg" id="item_estado">
							<option value="" selected="" disabled="">Seleccione el Estado Civil</option>
							<option value="Habilitado">Soltero</option>
							<option value="Deshabilitado">Casado</option>
							<option value="Deshabilitado">Union Libre</option>
							<option value="Deshabilitado">No Aplica</option>
						</select>
					</div>	
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group">
						<label for="item_estado" class="bmd-label-floating">Ocupacion</label>
						<select class="form-control" name="item_estado_reg" id="item_estado">
							<option value="" selected="" disabled="">Seleccione la Ocupacion</option>
							<option value="Habilitado">Ama de casa</option>
							<option value="Deshabilitado">Abogado</option>s
							<option value="Deshabilitado">Artesano</option>
							<option value="Deshabilitado">Estudiante</option>
						</select>
					</div>
				</div>
			
				<div class="col-12 col-md-3">
					<div class="form-group">
						<label for="item_estado" class="bmd-label-floating">Escolaridad</label>
						<select class="form-control" name="item_estado_reg" id="item_estado">
							<option value="" selected="" disabled="">Seleccione la Escolaridad</option>
							<option value="Habilitado">Analfabeta</option>
							<option value="Deshabilitado">Primaria Incompleta</option>s
							<option value="Deshabilitado">Primaria Completa</option>
							<option value="Deshabilitado">Secundaria Incompleta</option>
							<option value="Deshabilitado">Secundaria completa</option>
							<option value="Deshabilitado">Universitaria Incompleta</option>
							<option value="Deshabilitado">Universitaria completa</option>
							<option value="Deshabilitado">No Aplica</option>
							<option value="Deshabilitado">Testigo Protegido (VERIFICAR)</option>
						</select>
					</div>
				</div>
				
				<div class="col-12 col-md-2">
					<div class="form-group">
						<label for="cliente_telefono" class="bmd-label-floating">Edad</label>
						<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="3">
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group">
						<label for="item_estado" class="bmd-label-floating">Tiempo</label>
						<select class="form-control" name="item_estado_reg" id="item_estado">
							<option value="" selected="" disabled="">Seleccione el Tiempo</option>
							<option value="Habilitado">Horas</option>
							<option value="Deshabilitado">Dias</option>s
							<option value="Deshabilitado">Semanas</option>
							<option value="Deshabilitado">Meses</option>
							<option value="Deshabilitado">Años</option>
						</select>
					</div>
				</div>
		</div>
	</div>
	<br><br><br>
	<fieldset>
		<legend><i class="fas fa-user"></i> &nbsp;Datos del Acompañante</legend>
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
				<div class="col-12 col-md-4">
					<div class="form-group">
						<label for="item_estado" class="bmd-label-floating">Relacion</label>
						<select class="form-control" name="item_estado_reg" id="item_estado">
							<option value="" selected="" disabled="">Seleccione el Tipo de Relacion</option>
							<option value="Habilitado">Familiar</option>
							<option value="Deshabilitado">Desconocida</option>
							<option value="Deshabilitado">Policia Militar</option>
							<option value="Deshabilitado">fiscal</option>
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
						<label for="item_estado" class="bmd-label-floating">PERIMITE LA EVALUACION</label>
						<select class="form-control" name="item_estado_reg" id="item_estado">
							<option value="" selected="" disabled="">Seleccione el Estado</option>
							<option value="Habilitado">Si</option>
							<option value="Deshabilitado">No</option>
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
						<label for="cliente_apellido" class="bmd-label-floating">Caserio, Aldea o Barrio, del Hecho</label>
						<input type="text"  class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="40">
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="form-group">
						<label for="cliente_apellido" class="bmd-label-floating">Lugar Donde Ocurrio el Hecho</label>
						<input type="text" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="40">
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="form-group">
						<label for="prestamo_fecha_inicio">Fecha que Ocurrio el Hecho</label>
						<input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
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
		<label for="item_estado" class="bmd-label-floating">Instrumemto Utilizado</label>
		<select class="form-control" name="item_estado_reg" id="item_estado">
			<option value="" selected="" disabled="">Seleccione el Instrumemto</option>
			<option value="Habilitado">Arma Blanca</option>
			<option value="Deshabilitado">Objeto romo/Cuerpo Romo</option>s
			<option value="Deshabilitado">Proyectil de Arma de Fuego</option>
			<option value="Deshabilitado">Vehiculo Auto Motor</option>
			<option value="Deshabilitado">Sustancia Toxica</option>
			<option value="Deshabilitado">Estigmas Ungiales</option>
			<option value="Deshabilitado">Mordeduras</option>
			<option value="Deshabilitado">Flam, Fuego, Calor,Liquidos Calientes</option>
			<option value="Deshabilitado">Indeterminado</option>
			<option value="Deshabilitado">No Aplica</option>
		</select>
	</div>
</div><div class="col-12 col-md-3">
	<div class="form-group">
		<label for="item_estado" class="bmd-label-floating">Relacion Con el Agresor</label>
		<select class="form-control" name="item_estado_reg" id="item_estado">
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
		<label for="cliente_telefono" class="bmd-label-floating">En Caso de ser Conocido Especifique</label>
		<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="3">
	</div>
</div>
<div class="col-12 col-md-4">
	<div class="form-group">
		<label for="cliente_telefono" class="bmd-label-floating">Descripcion de la Evaluacion</label>
		<textarea name="precise" id="precise" cols="80" rows="4"></textarea><!--  /*/*/*/  ESTA ES LA CAJA DE TEXTO   /*/*/*/ -->
	</div>
</div>
	</fieldset>
	<form method="post" action="tratamiento.php">
                            <p>
                            Por favor, indique el Estado de la Evaluacion:<br>
                            <input type="radio" name="estado" value="menos15" id="menos15"/>
                            <label for="pendiente">Pendiente</label><br />
                            <input type="radio" name="estado" value="medio15-25"id="medio15-25" />
							<label for="finalizado">Finalizado</label><br />
                            </p>
                        </form>
				<div class="col-12 col-md-4"> 
					<div class="form-group">
						<label for="prestamo_fecha_inicio">Fecha de Finalizacion de la Evaluacion</label>
						<input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
					</div>
				</div>

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
	<?php include "./inc/java.php"; ?>
</body>
</html>