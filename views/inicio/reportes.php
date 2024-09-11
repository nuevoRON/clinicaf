<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Reportes</title>
	<?php include "views/templates/archivosCss.php"; ?>
	<style>
.tab-container {
    display: flex;
    flex-direction: column;
    height: 70%;
	margin-top:2rem;
}

.tabs {
    display: flex;
    justify-content: space-around;
    background-color: #f1f1f1;
    border-bottom: 1px solid #ccc;
}

.tab-button {
    flex-grow: 1;
    padding: 10px;
    cursor: pointer;
    background-color: inherit;
    border: none;
    outline: none;
    text-align: center;
    transition: background-color 0.3s ease;
    font-size: 18px;
}

.tab-button.active {
    background-color: #ccc;
}

.tab-button:hover {
    background-color: #ddd;
}

.tab-content {
    flex-grow: 1;
    padding: 20px;
    background-color: #fff;
    overflow-y: auto;
}

	</style>
</head>

<body>
	<main class="full-box main-container">
		<?php include "views/templates/NavBar.php"; ?>
		<section class="full-box page-content">
			<?php include "views/templates/NavSup.php"; ?>
			<div class="full-box">
				<h4 class="text-left">
					<i class="fas fa-poll-h"></i> &nbsp; Reportes
				</h4>
			</div>

			<div class="tab-container">
				<div class="tabs">
					<button class="tab-button active" onclick="openTab(event, 'tab1')">Proveidos</button>
					<button class="tab-button" onclick="openTab(event, 'tab2')">Vacaciones</button>
				</div>

				<div id="tab1" class="tab-content">
					<div class="container-fluid">
						<h4>Seleccione sus filtros de búsqueda:</h4>
						<form id="formulario" class="form-neon" autocomplete="off">
								<input type="hidden" name="id" id="id">
								<fieldset>
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_inicio">Fecha de Inicio</label>
													<input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_final">Fecha Final</label>
													<input type="date" class="form-control" name="fecha_final" id="fecha_final" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="medico" class="bmd-label">Medico</label>
													<select class="form-control" name="medico" id="medico" required>
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="reconocimiento" class="bmd-label">Tipo de Reconocimiento</label>
													<select class="form-control" name="reconocimiento" id="reconocimiento" required>
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="sexo" class="bmd-label">Sexo de Evaluado</label>
													<select class="form-control" name="sexo" id="sexo" required>
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
										</div>
								</fieldset>

								<p class="text-center" style="margin-top: 40px;">
								<button type="button" class="btn btn-raised btn-success btn-sm" id="botonExcel">
										<i class="far fa-file-excel"></i> &nbsp; EXPORTAR EXCEL
									</button>
									&nbsp; &nbsp;
									<button type="button" class="btn btn-raised btn-danger btn-sm" id="botonPDF">
										<i class="far fa-file-pdf"></i> &nbsp; EXPORTAR PDF
									</button>
								</p>
						</form>
					</div>
				</div>

				<div id="tab2" class="tab-content" style="display:none;">
					<div class="container-fluid">
						<h4>Seleccione sus filtros de búsqueda:</h4>
						<form id="formulario" class="form-neon" autocomplete="off">
								<input type="hidden" name="id" id="id">
								<fieldset>
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fechaInicioVacacion">Fecha de Inicio</label>
													<input type="date" class="form-control" name="fechaInicioVacacion" id="fechaInicioVacacion" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fechaFinVacacion">Fecha Final</label>
													<input type="date" class="form-control" name="fechaFinVacacion" id="fechaFinVacacion" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="medicoVacaciones" class="bmd-label">Medico</label>
													<select class="form-control" name="medicoVacaciones" id="medicoVacaciones" required>
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
										</div>
								</fieldset>

								<p class="text-center" style="margin-top: 40px;">
								<button type="button" class="btn btn-raised btn-success btn-sm" id="botonExcelVacacion">
										<i class="far fa-file-excel"></i> &nbsp; EXPORTAR EXCEL
									</button>
									&nbsp; &nbsp;
									<button type="button" class="btn btn-raised btn-danger btn-sm" id="botonPDFVacacion">
										<i class="far fa-file-pdf"></i> &nbsp; EXPORTAR PDF
									</button>
								</p>
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php include "views/templates/archivosJS.php"; ?>
	<script type="module" src="<?php echo BASE_URL; ?>assets/js/modulos/reportes.js"></script>
	<script>
		function openTab(event, tabName) {
			var i, tabcontent, tabbuttons;

			// Ocultar todas las pestañas
			tabcontent = document.getElementsByClassName("tab-content");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}

			// Remover la clase "active" de todos los botones
			tabbuttons = document.getElementsByClassName("tab-button");
			for (i = 0; i < tabbuttons.length; i++) {
				tabbuttons[i].className = tabbuttons[i].className.replace(" active", "");
			}

			// Mostrar la pestaña actual y añadir la clase "active" al botón
			document.getElementById(tabName).style.display = "block";
			event.currentTarget.className += " active";
		}

	</script>
</body>

</html>