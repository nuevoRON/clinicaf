<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Personal de Vacaciones</title>
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
				<h3 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VACACIONES
				</h3>

		<!--=====================================================================================================================================================================================
	=                      ==                      ==                      ==                      ==                      ==                      ==                      ==               =
	======================================================================================================================================================================================-->			
			
<!-- MODAL VACAIONES -->         
                
<div class="container-fluid">                  
                        <p class="text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalVacacion"><i class="fas fa-user-plus"></i> &nbsp; Agregar Vacacion</button>
                        </p>

                    </div>
               
           
            
            <div class="modal fade" id="ModalVacacion" tabindex="-1" role="dialog" aria-labelledby="ModalVacacion" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalVacacion">Agregar Vacaciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
<!-- Contenedor-->
<div class="container-fluid">
            <form action="" class="form-neon" autocomplete="off">
                <fieldset>
                    <legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES</legend>
                    <div class="container-fluid">
                        <div class="row">
						<div class="col-12 col-md-4">									
										<div class="form-group">
											<label for="cliente_dni" class="bmd-label-floating">Nº de Empleado</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
										</div>
								</div>
								<div class="col-12 col-md-4">									
										<div class="form-group">
											<label for="cliente_dni" class="bmd-label-floating">Nombre</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
										</div>
								</div>
								<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="item_estado" class="bmd-label-floating">Estado</label>
											<select class="form-control" name="item_estado_reg" id="item_estado">
												<option value="" selected="" disabled="">Seleccione el Estado</option>>
												<option value="Deshabilitado">incapacitado</option>
												<option value="Deshabilitado">Vacaciones</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div class="form-group">
											<label for="vacaciones_fecha_inicio">Fecha de Inicio</label>
											<input type="date" class="form-control" name="Fecha_inicio" id="fecha_inicio">
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div class="form-group">
											<label for="vacaciones_fecha_final">Fecha de Inicio</label>
											<input type="date" class="form-control" name="Fecha_final" id="fecha_final">
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

                    </div>
                </div>
            </div>


			<!-- Content here-->
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>								
								<th>Nº EMPLEADO</th>
								<th>NOMBRE</th>
								<th>ESTADO</th>
								<th>FECHA DE INICIO</th>
								<th>FECHA FINAL</th>	
								<th>TOTAL VACACIONES</th>		
								<th>MODIFICAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>
						<tr class="text-center" >
								<td>1</td>
								<td>4530</td>
								<td>Alvarez</td>
								<th>Vacaciones</th>
								<td>14/5/2024</td>
								<td>14/6/2024</td>
								<td>31</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalVacacion">
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
								<td>4530</td>
								<td>Alvarez</td>
								<th>Vacaciones</th>
								<td>14/5/2024</td>
								<td>14/6/2024</td>
								<td>31</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalVacacion">
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
								<td>4530</td>
								<td>Alvarez</td>
								<th>Incapacidad</th>
								<td>14/5/2024</td>
								<td>14/6/2024</td>
								<td>31</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalVacacion">
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
								<td>4530</td>
								<td>Alvarez</td>
								<th>Vacaciones</th>
								<td>14/5/2024</td>
								<td>14/6/2024</td>
								<td>31</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalVacacion">
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