										<!-- MODAL AGREGAR ESCOLARIDAD -->
 <!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-    BOTON PARA AGREGAR    -*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* -->
<div class="">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalEscolar">
						<i class="fas fa-plus"></i>
					</button>
</div>
<!-- *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- -->             
   
            <div class="modal fade" id="ModalEscolar" tabindex="-1" role="dialog" aria-labelledby="ModalEscolar" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalEscolar">Agregar Nueva Escolaridad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
<!-- Contenedor-->
<div class="container-fluid">
            <form action="" class="form-neon" autocomplete="off">
                <fieldset>
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-12 col-md-8">									
								<div class="form-group" >
									<label for="instrumento" class="bmd-label-floating">Escolaridad</label>
									<input type="text" pattern="[0-9-]{1,27}" class="form-control" name="instrumento_reg" id="id_instrumento	" maxlength="27">
								</div>
							</div>
						</div>	
                    </div>
                </fieldset>
					
					<p class="text-center" style="margin-top: 40px;">
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
