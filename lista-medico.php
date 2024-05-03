<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Lista de Medico</title>
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
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE MEDICO
				</h3>
				<p class="text-justify">
					aqui podremos ver la lista de medicos
				</p>
			</div>

			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
 					<li>
						<a href="agregar-medico.php"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR MEDICO</a>
					</li> 
					<li>
						<a class="active" href="lista-medico.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE MEDICOS</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content here-->
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>DNI</th>
								<th>Nº EMPLEADO</th>
								<th>Nº CORREO ELECTRONICO</th>
								<th>Nº DE TELEFONO</th>	
								<th>JORNADA</th>	
								<th>ESTADO</th>							
								<th>MODIFICAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>
						<tr class="text-center" >
								<td>1</td>
								<td>Pedro</td>
								<td>Alvarez</td>
								<td>080119854420</td>
								<td>4530</td>
								<td>palvares@gmail.com</td>
								<td>85446328</td>
								<td>matutina</td>
								<td>activo</td>
								<td>
									<a href="proveido.php" class="btn btn-success">
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
							<tr class="text-center" >
								<td>2</td>
								<td>Pedro</td>
								<td>Alvarez</td>
								<td>080119854420</td>
								<td>4530</td>
								<td>palvares@gmail.com</td>
								<td>85446328</td>
								<td>matutina</td>
								<td>vacaciones</td>
								<td>
									<a href="proveido.php" class="btn btn-success">
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
							<tr class="text-center" >
								<td>3</td>
								<td>Pedro</td>
								<td>Alvarez</td>
								<td>080119854420</td>
								<td>4530</td>
								<td>palvares@gmail.com</td>
								<td>85446328</td>
								<td>matutina</td>
								<td>vacaciones</td>>
								<td>
									<a href="proveido.php" class="btn btn-success">
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
							<tr class="text-center" >
								<td>4</td>
								<td>Pedro</td>
								<td>Alvarez</td>
								<td>080119854420</td>
								<td>4530</td>
								<td>palvares@gmail.com</td>
								<td>85446328</td>
								<td>matutina</td>
								<td>activo</td>
								<td>
									<a href="proveido.php" class="btn btn-success">
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
	<?php include "./inc/java.php"; ?>

</body>
</html>