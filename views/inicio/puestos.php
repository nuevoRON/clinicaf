<?php include "views/templates/sesion.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Puestos</title>
	<?php include "views/templates/archivosCss.php"; ?>
</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<div class="full-box">
				<h4 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; NUEVOS PUESTOS
				</h4>
			</div>
			<div class="container-fluid">
				<p class="text-center">
					<button type="button" class="btn btn-primary" id="btnModalPuestos"><i class="fas fa-user-plus"></i> &nbsp; Agregar Puestos</button>
				</p>
			</div>

			<div class="modal fade" id="ModalPuestos" tabindex="-1" role="dialog" aria-labelledby="ModalPuestos" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-title">Agregar Nuevo Puesto</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="container-fluid">
							<form action="" class="form-neon" autocomplete="off" id="formulario">
								<fieldset>
									<legend><i class="fas fa-user"></i> &nbsp; DATOS DEL PUESTO</legend>
									<div class="container-fluid">
										<input type="hidden" name="id" id="id">
										<div class="row">
											<div class="col-12 col-md-8">
												<div class="form-group">
													<label for="puesto" class="bmd-label-floating">Nombre de Puesto</label>
													<input type="text" class="form-control" name="puesto" id="puesto" maxlength="50">
													<span id="spanNombre" style="color: red; font-size:1rem;"></span>
												</div>
											</div>
											<div class="col-12 col-md-8">
												<div class="form-group">
													<label for="estado" class="bmd-label-floating">ESTADO</label>
													<select class="form-control" name="estado" id="estado">
														<option value="" disabled selected>Seleccione una opción</option>
														<option value="Activo">Activo</option>
														<option value="Inactivo">Inactivo</option>
													</select>
												</div>
											</div>
										</div>
								</fieldset>

								<p class="text-center" style="margin-top: 40px;">
									<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
									&nbsp; &nbsp;
									<button type="submit" class="btn btn-raised btn-info btn-sm" id="btn-enviar"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm" id="tabla_puestos">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>NOMBRE DEL PUESTO</th>
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
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/puestos.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/validaciones/validacionPuestos.js"></script>
</body>

</html>