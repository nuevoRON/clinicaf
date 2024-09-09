<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Control de Dictamenes</title>
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
					<i class="fas fa-copy"></i> &nbsp; CONTROL DE DICTAMENES
				</h4>
			</div>

			<div class="tab-container">
				<div class="tabs">
					<button class="tab-button active" onclick="openTab(event, 'tab1')">Dictamenes</button>
					<button class="tab-button" onclick="openTab(event, 'tab2')">Ampliaciones y Transcripciones</button>
				</div>

				<div id="tab1" class="tab-content">
					<div class="container-fluid">
						<p class="text-center">
							<button type="button" class="btn btn-primary" id="btnModalDictamen"><i class="fas fa-user-plus"></i> &nbsp; Nuevo Control</button>
						</p>
					</div>
					<div class="container-fluid">
						<div class="table-responsive">
							<table class="table table-dark table-sm" id="tabla-dictamenes">
								<thead>
									<tr class="text-center roboto-medium">
										<th>#</th>
										<th>NUMERO DEL CASO</th>
										<th>NOMBRE DEL MEDICO</th>
										<th>FECHA DE EVALUACION</th>
										<th>AUTORIDAD SOLICITANTE</th>
										<th>FECHA DE ENTREGA</th>
										<th>DATOS EXTRA</th>
										<th>MODIFICAR</th>
										<th>ELIMINAR</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div id="tab2" class="tab-content" style="display:none;">
					<div class="container-fluid">
						<p class="text-center">
							<button type="button" class="btn btn-primary" id="btnModalTranscripcion"><i class="fas fa-user-plus"></i> &nbsp; Nueva Transcripcion / Ampliacion</button>
						</p>
					</div>

					<div class="container-fluid">
						<div class="table-responsive">
							<table class="table table-dark table-sm" id="tabla-dictamenesTranscripcion">
								<thead>
									<tr class="text-center roboto-medium">
										<th>#</th>
										<th>NUMERO DEL CASO</th>
										<th>TIPO DE DOCUMENTO</th>
										<th>NOMBRE DEL MEDICO</th>
										<th>FECHA DE EVALUACION</th>
										<th>AUTORIDAD SOLICITANTE</th>
										<th>FECHA DE ENTREGA</th>
										<th>DATOS EXTRA</th>
										<th>MODIFICAR</th>
										<th>ELIMINAR</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="ModalDictamen" tabindex="-1" role="dialog" aria-labelledby="ModalDictamen" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-title">Agregar</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="container-fluid">
							<form id="formulario" class="form-neon" autocomplete="off">
								<input type="hidden" name="id" id="id">
								<fieldset>
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="num_caso" class="bmd-label">Numero del Caso</label>
													<select class="form-control" name="num_caso" id="num_caso" required>
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="medico" class="bmd-label">Nombre del medico</label>
													<select class="form-control" name="medico" id="medico" required>
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_evaluacion">Fecha de Evaluacion</label>
													<input type="date" class="form-control" name="fecha_evaluacion" id="fecha_evaluacion" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="autoridad_soli" class="bmd-label">Autoridad Solicitante </label>
													<input type="text" class="form-control" name="autoridad_soli" id="autoridad_soli" maxlength="100" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_entrega">Fecha de Entrega</label>
													<input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="datos_extra" class="bmd-label">Datos extra</label>
													<input type="text" class="form-control" name="datos_extra" id="datos_extra" maxlength="255" required>
												</div>
											</div>
										</div>
								</fieldset>

								<p class="text-center" style="margin-top: 40px;">
									<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
									&nbsp; &nbsp;
									<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="ModalTranscripcion" tabindex="-1" role="dialog" aria-labelledby="ModalTranscripcion" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-titleTranscripcion">Agregar</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="container-fluid">
							<form id="formularioTranscripcion" class="form-neon" autocomplete="off">
								<input type="hidden" name="idTranscripcion" id="idTranscripcion">
								<fieldset>
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="num_casoTranscripcion" class="bmd-label">Numero del Caso</label>
													<select class="form-control" name="num_casoTranscripcion" id="num_casoTranscripcion" required>
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="medicoTranscripcion" class="bmd-label">Nombre del medico</label>
													<select class="form-control" name="medicoTranscripcion" id="medicoTranscripcion" required>
														<option value="">Seleccione una opción</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_evaluacionTranscripcion">Fecha de Evaluacion</label>
													<input type="date" class="form-control" name="fecha_evaluacionTranscripcion" id="fecha_evaluacionTranscripcion" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="autoridad_soliTranscripcion" class="bmd-label">Autoridad Solicitante </label>
													<input type="text" class="form-control" name="autoridad_soliTranscripcion" id="autoridad_soliTranscripcion" 
													maxlength="100" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="tipo_documentoTranscripcion" class="bmd-label">Tipo de Docuemnto</label>
													<select class="form-control" name="tipo_documentoTranscripcion" id="tipo_documentoTranscripcion" required>
														<option value="" selected="" disabled="">Seleccione su Opcion</option>
														<option value="Transcripcion">Transcripcion</option>
														<option value="Ampliacion">Ampliacion</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="fecha_entregaTranscripcion">Fecha de Entrega</label>
													<input type="date" class="form-control" name="fecha_entregaTranscripcion" id="fecha_entregaTranscripcion" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label for="datos_extraTranscripcion" class="bmd-label">Datos extra</label>
													<input type="text" class="form-control" name="datos_extraTranscripcion" id="datos_extraTranscripcion" 
													maxlength="255" required>
												</div>
											</div>
										</div>
								</fieldset>

								<p class="text-center" style="margin-top: 40px;">
									<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
									&nbsp; &nbsp;
									<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
			
		</section>
	</main>

	<?php include "views/templates/archivosJS.php"; ?>
	<script type="module" src="<?php echo BASE_URL; ?>assets/js/modulos/dictamenes.js"></script>
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