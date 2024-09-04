<?php include "views/templates/sesion.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Sexos</title>
	<?php include "views/templates/archivosCss.php"; ?>

</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<h3 class="text-left">
				<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE SEXOS
			</h3>
			<div class="container-fluid">
				<div class="container-fluid">
					<p class="text-center">
						<button type="button" class="btn btn-primary" id="btnModalSexo"><i class="fas fa-user-plus"></i> &nbsp; Agregar Sexo</button>
					</p>
				</div>
			</div>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-dark" id="tblSexos">
						<thead>
							<tr class="text-center roboto-medium">
								<th>ID</th>
								<th>NOMBRE</th>
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

	<div class="modal fade" id="ModalSexo" tabindex="-1" role="dialog" aria-labelledby="ModalSexo" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Agregar Sexo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form action="" class="form-neon" id="formulario">
							<input type="hidden" name="id" id="id">
							<div class="container-fluid">
								<div class="row">
									<div class="col-12 col-md-8">
										<div class="form-group">
											<label for="nombre_sexo" class="bmd-label-floating">Nombre</label>
											<input type="text" class="form-control" name="nombre_sexo" id="nombre_sexo" required>
										</div>
									</div>
								</div>
							</div>

							<p class="text-center">
								&nbsp; &nbsp;
								<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save" id="btnAccion"></i> &nbsp; GUARDAR</button>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include "views/templates/archivosJS.php"; ?>
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/sexos.js"></script>
</body>

</html>