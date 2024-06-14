<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Control de Dictamenes</title>
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
			<div class="full-box">
				<h4 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; CONTROL DE DICTAMENES
				</h4>
			</div>


	<!--=====================================================================================================================================================================================
	=                      ==                      ==                      ==                      ==                      ==                      ==                      ==               =
	======================================================================================================================================================================================-->			
			
<!-- MODAL DITAMENES -->         
	
		<div class="container-fluid">                  
			<p class="text-center">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalDictamen"><i class="fas fa-user-plus"></i> &nbsp; Nuevo Control</button>
			</p>

		</div>
               
           
            
<div class="modal fade" id="ModalDictamen" tabindex="-1" role="dialog" aria-labelledby="ModalDictamen" data-backdrop="static" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalDictamen">Agregar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
<!-- Contenedor-->
<div class="container-fluid">
            <form action="" class="form-neon" autocomplete="off">
                <fieldset>
                    <legend><i class="fas fa-user"></i> &nbsp; AGREGAR CONTROL DE DICTAMEN</legend>
                    <div class="container-fluid">
                        <div class="row">
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label for="casonum" class="bmd-label-floating">Numero del Caso</label>
                                        <input type="text" pattern="[0-9-]{1,27}" class="form-control" name="caso_num" id="idcaso_num" maxlength="27">
                                    </div>
                                </div>
								<div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label for="medico" class="bmd-label-floating">Nombre del medico</label>
                                        <input type="text" pattern="[0-9-]{1,27}" class="form-control" name="med_reg" id="id_med" maxlength="27">
                                    </div>
                                </div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="prestamo_fecha_inicio">Fecha de Evaluacion</label>
										<input type="date" class="form-control" name="fecha_citacion" id="fecha_citacion_id">
									</div>
								</div>
								<div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label for="autosoli" class="bmd-label-floating">Autoridad Solicitante	</label>
                                        <input type="text" pattern="[0-9-]{1,27}" class="form-control" name="nom_auto" id="id_auto_soli" maxlength="27">
                                    </div>
                                </div>
								<div class="col-12 col-md-6">   
                                    <div class="form-group">
                                        <label for="item_estado" class="bmd-label-floating">Tipo de Docuemnto</label>
                                        <select class="form-control" name="item_estado_reg" id="item_estado">
                                            <option value="" selected="" disabled="">Selecciones su Opcion</option>
                                            <option value="Habilitado">Dictamen</option>
                                            <option value="Habilitado">Transcripcion</option>
											<option value="Habilitado">Ampliacion</option>
                                        </select>
                                    </div>							
                                </div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="fecha_entrega">Fecha de Entrega</label>
										<input type="date" class="form-control" name="fecha_entrega" id="id_fecha_entrega">
									</div>
								</div>
								<div class="col-12 col-md-10">
                                    <div class="form-group">
                                        <label for="autosoli" class="bmd-label-floating">Datos extra</label>
                                        <input type="text" pattern="[0-9-]{1,27}" class="form-control" name="nom_auto" id="id_auto_soli" maxlength="27">
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
<!--=====================================================================================================================================================================================
	=                      ==                      ==                      ==                      ==                      ==                      ==                      ==               =
======================================================================================================================================================================================-->

			<!-- Content here-->
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm">
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
						<tr class="text-center" >
								<td>1</td>
								<td>4250-2017</td>
								<td>Dictamen</td>
								<td>juan fernando</td>
								<td>25/03/2024</td>
								<td>Fiscalia de la Mujer</td>								
								<td>25/03/2024</td>
								<td>Entregado a secretaria</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalDictamen">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>									
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
								<td>8420-2017</td>
								<td>Dictamen</td>
								<td>Pedro Alvares</td>
								<td>25/03/2024</td>
								<td>Fiscalia de la Mujer</td>								
								<td>25/03/2024</td>
								<td>Entregado a secretaria</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalDictamen">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>	
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
								<td>4250-2017</td>
								<td>Ampliacion</td>
								<td>juan fernando</td>
								<td>25/03/2024</td>
								<td>Fiscalia de la Mujer</td>								
								<td>25/03/2024</td>
								<td>solicitud de ampliacion por el tribunal</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalDictamen">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>	
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
								<td>4250-2017</td>
								<td>Transcripcion</td>
								<td>juan fernando</td>
								<td>25/03/2024</td>
								<td>Fiscalia de la Mujer</td>								
								<td>25/03/2024</td>
								<td>primera copia</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalDictamen">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>	
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