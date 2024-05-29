<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Lista de Secretrias</title>
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
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE SECRETARIAS
				</h3>
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs"> 
					<li>
						<a class="active" href="lista-secretarias.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE SECRETARIAS</a>
					</li>
				</ul>	
			</div>
	<!--=====================================================================================================================================================================================
	=                      ==                      ==                      ==                      ==                      ==                      ==                      ==               =
	======================================================================================================================================================================================-->			
			
<!-- MODAL SECRETARIAS -->
            <div class="container-fluid">
                <div class="container-fluid form-neon">
                    <div class="container-fluid">                  
                        <p class="text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modalsecre"><i class="fas fa-user-plus"></i> &nbsp; Agregar Secretaria</button>
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalItem"><i class="fas fa-box-open"></i> &nbsp; Agregar item</button> -->
                        </p>

                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="Modalsecre" tabindex="-1" role="dialog" aria-labelledby="Modalsecre" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="Modalsecre">Agregar Secretaria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


<!-- Contenedor-->
<div class="container-fluid">
				<form action="" class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="fas fa-user"></i> &nbsp; DATOS GENERALES DE LA SECRETARIA</legend>
						<div class="container-fluid">
						<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Nombre de  la secretaria</label>
										<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
									</div>
									<div class="col-12 col-md-4">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Apellido de la secretaria</label>
										<input type="text"  class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
									</div>
									<div class="col-12 col-md-4">
									</div>
								</div>
								<div class="col-12 col-md-4">									
										<div class="form-group">
											<label for="cliente_dni" class="bmd-label-floating">Nº de Empleado</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
										</div>
								</div>
								<div class="col-12 col-md-5">
										<div class="form-group">
											<label for="cliente_dni" class="bmd-label-floating">Correo Electronico</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
										</div>
								</div>
								<div class="col-12 col-md-4">
										<div class="form-group">
											<label for="cliente_dni" class="bmd-label-floating">Nº de Telefono</label>
											<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
										</div>
								</div>
					</div>
					</div>
				</fieldset>

					<fieldset>
						<legend><i class="fas fa-user"></i> &nbsp; Estados</legend>						
						<div class="container-fluid">						
							<div class="row">
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="item_estado" class="bmd-label-floating">Jornada</label>
											<select class="form-control" name="item_estado_reg" id="item_estado">
												<option value="" selected="" disabled="">Seleccione la Jornanda</option>
												<option value="Habilitado">Matunina</option>
												<option value="Deshabilitado">Vespertina</option>
												<option value="Deshabilitado">Nocturna</option>
											</select>
										</div>								
									</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="item_estado" class="bmd-label-floating">Estado</label>
											<select class="form-control" name="item_estado_reg" id="item_estado">
												<option value="" selected="" disabled="">Seleccione el Estado</option>
												<option value="Habilitado">Activo</option>
												<option value="Deshabilitado">Inactivo</option>
												<option value="Deshabilitado">incapacitado</option>
												<option value="Deshabilitado">Vacaciones</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-md-7">   
										<div class="form-group">
											<label for="item_estado" class="bmd-label-floating">Departamnto Cede</label>
											<select class="form-control" name="item_estado_reg" id="item_estado">
												<option value="" selected="" disabled="">Seleccione el Departamento Cede</option>
												<option value="Habilitado">Atlántida</option>
												<option value="Deshabilitado">Choluteca</option>
												<option value="Deshabilitado">Colón</option>
												<option value="Deshabilitado">Comayagua</option>
												<option value="Deshabilitado">Copán</option>
												<option value="Deshabilitado">Cortés</option>
												<option value="Deshabilitado">El Paraíso</option>
												<option value="Deshabilitado">Francisco Morazán</option>
												<option value="Deshabilitado">Gracias a Dios</option>
												<option value="Deshabilitado">Intibucá</option>
												<option value="Deshabilitado">Islas de la Bahía</option>
												<option value="Deshabilitado">La Paz</option>
												<option value="Deshabilitado">Lempira</option>
												<option value="Deshabilitado">Ocotepeque</option>
												<option value="Deshabilitado">Olancho</option>
												<option value="Deshabilitado">Santa Bárbara</option>
												<option value="Deshabilitado">Valle</option>
												<option value="Deshabilitado">Yoro</option>	
											</select>
										</div>							
                                	</div>
							</div>
						</div>
					</fieldset>
		

							<br></br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
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
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<!-- <th>DNI</th> -->
								<th>Nº EMPLEADO</th>
								<th>Nº CORREO ELECTRONICO</th>
								<th>Nº DE TELEFONO</th>	
								<th>JORNADA</th>	
								<th>ESTADO</th>	
								<th>CEDE</th>		
								<th>MODIFICAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>
						<tr class="text-center" >
								<td>1</td>
								<td>Pedro</td>
								<td>Alvarez</td>
								<!-- <td>080119854420</td> -->
								<td>4530</td>
								<td>palvares@gmail.com</td>
								<td>85446328</td>
								<td>matutina</td>
								<td>activo</td>
								<td>Intibucá</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalsecre">
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
								<td>Pedro</td>
								<td>Alvarez</td>
								<!-- <td>080119854420</td> -->
								<td>4530</td>
								<td>palvares@gmail.com</td>
								<td>85446328</td>
								<td>matutina</td>
								<td>vacaciones</td>
								<td>Valle</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalsecre">
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
								<td>Pedro</td>
								<td>Alvarez</td>
								<!-- <td>080119854420</td> -->
								<td>4530</td>
								<td>palvares@gmail.com</td>
								<td>85446328</td>
								<td>matutina</td>
								<td>vacaciones</td>
								<td>Francisco Morazán</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalsecre">
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
								<td>Pedro</td>
								<td>Alvarez</td>
								<!-- <td>080119854420</td> -->
								<td>4530</td>
								<td>palvares@gmail.com</td>
								<td>85446328</td>
								<td>matutina</td>
								<td>activo</td>
								<td>Comayagua</td>
								<td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalsecre">
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