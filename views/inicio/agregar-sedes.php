<?php include "views/templates/sesion.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Agregar Sedes</title>
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
			<div class="full-box">
				<h4 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; NUEVAS SEDES
				</h4>
			</div>


	<!--=====================================================================================================================================================================================
	=                      ==                      ==                      ==                      ==                      ==                      ==                      ==               =
	======================================================================================================================================================================================-->			
			
<!-- MODAL SEDES -->         
                
                    <div class="container-fluid">                  
                        <p class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-backdrop="static" data-toggle="modal" data-target="#ModalSedes"><i class="fas fa-user-plus"></i> &nbsp; Agregar Sedes</button>
                        </p>

                    </div>
               
           
            
            <div class="modal fade" id="ModalSedes" tabindex="-1"  role="dialog" aria-labelledby="ModalSedes" data-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalSedes">Agregar Nueva  Sede</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
<!-- Contenedor-->
<div class="container-fluid">
            <form action="" class="form-neon" autocomplete="off" id="formulario">
                <fieldset>
                    <legend><i class="fas fa-user"></i> &nbsp; DATOS DE LA SEDE</legend>
                    <div class="container-fluid">
						<input type="hidden" name="id" id="id">
                        <div class="row">
                        <div class="col-12 col-md-6">   
                                    <div class="form-group">
                                        <label for="departamento" class="bmd-label-floating">Departamnto</label>
                                        <select class="form-control" name="departamento" id="departamento">
                                            <option value="" selected="" disabled="">Seleccione el Departamento</option>
                                            
                                        </select>
                                    </div>							
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="form-group">
                                        <label for="municipio" class="bmd-label-floating">Municipio</label>
                                        <select class="form-control" name="municipio" id="municipio">
                                            
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-12 col-md-8">
                                    <div class="form-group">
                                        <label for="ubicacion" class="bmd-label-floating">Lugar de Ubicacion</label>
                                        <input type="text"  class="form-control" name="ubicacion" id="ubicacion" maxlength="50">
                                    </div>
                                </div>
								<div class="col-12 col-md-8">
                                    <div class="form-group">
                                        <label for="ubicacion" class="bmd-label-floating">Codigo Alfábetico</label>
                                        <input type="text"  class="form-control" name="cod_alfabetico" id="cod_alfabetico" maxlength="5">
                                    </div>
                                </div>
								<div class="col-12 col-md-8">
                                    <div class="form-group">
                                        <label for="ubicacion" class="bmd-label-floating">Código Numérico</label>
                                        <input type="number"  class="form-control" name="cod_numerico" id="cod_numerico" maxlength="5">
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
					<table class="table table-dark table-sm text-center" id="tabla_sedes">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>DEPARTAMENTO</th>
								<th>MUNICIPIO</th>
								<th>UBICACION</th>
								<th>CODIGO ALFABETICO</th>
								<th>CODIGO NUMERICO</th>
                                <th>MODIFICAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
				</div>
<!-- 				<nav aria-label="Page navigation example">
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
				
-->
			</div>

		</section>
	</main>
	
	
	<!--=============================================
	=            Include JavaScript files           =
	==============================================-->
	<?php include "views/templates/archivosJS.php"; ?>
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/sedes.js"></script>

</body>
</html>