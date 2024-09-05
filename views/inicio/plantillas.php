<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Plantillas</title>
	<?php include "views/templates/archivosCss.php"; ?>

</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<h3 class="text-left">
				<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PLANTILLAS
			</h3>

			<div class="container">
				<div class="table-responsive">
					<table class="table table-dark" id="tblPlantilla">
						<thead>
							<tr class="text-center roboto-medium">
								<th>ID</th>
								<th>ARCHIVO</th>
								<th>DESCARGAR</th>
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
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/plantillas.js"></script>
</body>

</html>