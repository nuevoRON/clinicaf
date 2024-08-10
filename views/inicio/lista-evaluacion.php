<?php include "views/templates/sesion.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Lista de proveído</title>
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

			<!-- Page header -->
			<h3 class="text-center">
				<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE EVALUACION
			</h3>
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
				</ul>
			</div>

			<!-- Content here-->
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm">
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
							<tr class="text-center">
								<td>1896-2024</td>
								<td>012342567</td>
								<td>NOMBRE DEL PACIENTE</td>
								<td>APELLIDO DEL PACIENTE</td>
								<td>FISCALIA DE TURNO</td>
								<td>VIOLACION</td>
								<td>NUEVO</td>
								<td>
									<a href="clinicaForense" class="btn btn-success">
										<i class="fas fa-sync-alt"></i>
									</a>
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
								<td>1897-2024</td>
								<td>012342567</td>
								<td>NOMBRE DEL PACIENTE</td>
								<td>APELLIDO DEL PACIENTE</td>
								<td>HEU</td>
								<td>MALTRATO INFANTIL</td>
								<td>NUEVO</td>
								<td>
									<a href="clinicaForense" class="btn btn-success">
										<i class="fas fa-sync-alt"></i>
									</a>
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
								<td>2025-2024</td>
								<td>012342567</td>
								<td>NOMBRE DEL PACIENTE</td>
								<td>APELLIDO DEL PACIENTE</td>
								<td>FISCALIA DE LA NIÑES</td>
								<td>ABUSO SEXUAL</td>
								<td>PENDIENTE</td>
								<td>
									<a href="clinicaForense" class="btn btn-success">
										<i class="fas fa-sync-alt"></i>
									</a>
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
								<td>3605-2024</td>
								<td>012342567</td>
								<td>NOMBRE DEL PACIENTE</td>
								<td>APELLIDO DEL PACIENTE</td>
								<td>FISCALIS DE LA MUJER</td>
								<td>ESTADO DE SALUD</td>
								<td>FINALIZADO</td>
								<td>
									<a href="clinicaForense" class="btn btn-success">
										<i class="fas fa-sync-alt"></i>
									</a>
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