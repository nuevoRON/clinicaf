<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Home</title>
	<?php include "views/templates/archivosCss.php"; ?>
</head>
<body>
	<!-- Main container -->
	<main class="full-box main-container">
			<?php include "views/templates/NavSup.php"; ?>
			<!-- INICIO Nav lateral -->
			<?php include "views/templates/NavBar.php"; ?>
			<!-- FIN Nav lateral -->
		<!-- Page content -->
		<section class="full-box page-content">
			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fab fa-dashcube fa-fw"></i> &nbsp; PANTALLA DE INICIO
				</h3>
			</div>
			
			<!-- Content -->
			<div class="full-box tile-container">
				<a href="item-list.html" class="tile">
					<div class="tile-tittle">Empleados</div>
					<div class="tile-icon">
						<i class="fas fa-pallet fa-fw"></i>
						<p id="span-empleados"></p>
					</div>
				</a>

				<a href="reservation-reservation.html" class="tile">
					<div class="tile-tittle">Evaluaciones</div>
					<div class="tile-icon">
						<i class="far fa-calendar-alt fa-fw"></i>
						<p id="span-evaluaciones"></p>
					</div>
				</a>

				<a href="reservation-pending.html" class="tile">
					<div class="tile-tittle">Citaciones</div>
					<div class="tile-icon">
						<i class="fas fa-hand-holding-usd fa-fw"></i>
						<p id="span-citaciones"></p>
					</div>
				</a>

				<a href="reservation-list.html" class="tile">
					<div class="tile-tittle">Dictamenes</div>
					<div class="tile-icon">
						<i class="fas fa-clipboard-list fa-fw"></i>
						<p id="span-dictamenes"></p>
					</div>
				</a>

				<a href="user-list.html" class="tile">
					<div class="tile-tittle">Plantillas Disponibles</div>
					<div class="tile-icon">
						<i class="fas fa-user-secret fa-fw"></i>
						<p id="span-plantillas"></p>
					</div>
				</a>
			</div>
		</section>
	</main>
	
	<?php include "views/templates/archivosJS.php"; ?>
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/inicio.js"></script>
</body>
</html>