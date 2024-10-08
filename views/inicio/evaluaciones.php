<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Evaluaciones</title>
	<?php include "views/templates/archivosCss.php"; ?>
</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<h3 class="text-center">
				<i class="fas fa-pallet fa-fw"></i> &nbsp; LISTA DE EVALUACION
			</h3>
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
				</ul>
			</div>

			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm text-center" id="tabla_evaluados">
						<thead>
							<tr class="text-center roboto-medium">
								<th># DE CASO</th>
								<th>DNI</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>DEPENDIA SOLICITANTE</th>
								<th>EVALUACION</th>
								<th>ESTADO</th>
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
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/evaluados-tabla.js"></script>
</body>

</html>