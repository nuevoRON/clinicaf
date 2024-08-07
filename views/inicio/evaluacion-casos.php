<?php include "views/templates/sesion.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>EVALUACIÓN</title>
    <?php include "views/templates/archivosCss.php"; ?>
</head>

<body>
    <!-- Main container -->
    <main class="full-box main-container">
        <!-- INICIO Nav lateral -->
        <?php include "views/templates/NavBar.php"; ?>
        <!-- FIN Nav lateral -->

        <section class="full-box page-content">
            <?php include "views/templates/NavSup.php"; ?>

            <!-- Page header -->
            <h3 class="text-left">
                <i class="fas fa-plus fa-fw"></i> &nbsp; CONTROL DE REVISIÓN DE CASOS
            </h3>

            <div class="container-fluid">
                <div class="container-fluid form-neon">
                    <div class="container-fluid">
                        <p class="text-center roboto-medium">EVALUACION DE CASOS</p>
                        <p class="text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCaso"><i class="fas fa-user-plus"></i> &nbsp; Agregar Caso</button>
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalItem"><i class="fas fa-box-open"></i> &nbsp; Agregar item</button> -->
                        </p>

                    </div>
                </div>
            </div>


            <!-- MODAL EVALUACION -->
            <div class="modal fade" id="ModalCaso" tabindex="-1" role="dialog" aria-labelledby="ModalCaso" data-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCaso">Agregar Caso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="item_estado" class="bmd-label-floating">Medico que Realizo la Revision</label>
                                    <select class="form-control" name="item_estado_reg" id="item_estado">
                                        <option value="" selected="" disabled="">Seleccione el Medico</option>
                                        <option value="Habilitado">Carlos Alberto</option>
                                        <option value="Deshabilitado">Teresa de Jesus Barahona</option>
                                    </select>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="item_estado" class="bmd-label-floating">Enviado para</label>
                                    <select class="form-control" name="item_estado_reg" id="item_estado">
                                        <option value="" selected="" disabled="">Seleccione para que fue enviado</option>
                                        <option value="Habilitado">Revision</option>
                                        <option value="Deshabilitado">Descargo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="container-fluid" id="tabla_clientes">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-sm">
                                        <div class="form-group">
                                            <label for="prestamo_fecha_inicio">Fecha de Revision</label>
                                            <input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
                                        </div>
                                    </table>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="item_estado" class="bmd-label-floating">Tipo de Dictamen a Revisar</label>
                                    <select class="form-control" name="item_estado_reg" id="item_estado">
                                        <option value="" selected="" disabled="">Seleccione el Tipo de Dictamen</option>
                                        <option value="Habilitado">Clinica Forense</option>
                                        <option value="Deshabilitado">Levantamiento</option>
                                    </select>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="cliente_dni" class="bmd-label-floating">Numero de Dictamen</label>
                                    <input type="text" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="cliente_dni" class="bmd-label-floating">Nombre del Evaluado</label>
                                    <input type="text" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-sm">
                                    <div class="form-group">
                                        <label for="prestamo_fecha_inicio">Fecha que se Realizo la Evaluacion</label>
                                        <input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
                                    </div>
                                </table>
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="item_estado" class="bmd-label-floating">Tipo de Reconocimiento</label>
                                    <select class="form-control" name="item_estado_reg" id="item_estado">
                                        <option value="" selected="" disabled="">Seleccione el Tipo de Reconocimiento</option>
                                        <option value="Habilitado">Levantamiento</option>
                                        <option value="Deshabilitado">Delito Sexual</option>
                                        <option value="Deshabilitado">Estado de Salud</option>
                                        <option value="Deshabilitado">Mala Praxis</option>
                                        <option value="Deshabilitado">Maltrato Familiar</option>
                                        <option value="Deshabilitado">Violencia Domenstica</option>
                                        <option value="Deshabilitado">Revision de Expediente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="cliente_dni" class="bmd-label-floating">Observaciones</label>
                                    <input type="text" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="item_estado" class="bmd-label-floating">Estado del Dictamen</label>
                                    <select class="form-control" name="item_estado_reg" id="item_estado">
                                        <option value="" selected="" disabled="">Seleccione el Estado</option>
                                        <option value="Habilitado">Completo</option>
                                        <option value="Deshabilitado">Incompleto, Sin Resultado de Laboratorio</option>
                                        <option value="Deshabilitado">Incompleto, Pendiente de Revision de Expediente</option>
                                        <option value="Deshabilitado">Levantamiento Enviado a Autopsia</option>
                                        <option value="Deshabilitado">Levantamiento Entregado a Familiar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="cliente_dni" class="bmd-label-floating">Observaciones</label>
                                    <input type="text" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="item_estado" class="bmd-label-floating">Sede del Medico Evaluador</label>
                                    <select class="form-control" name="item_estado_reg" id="item_estado">
                                        <option value="" selected="" disabled="">Seleccione la Sede</option>
                                        <option value="Habilitado">Centro Sur Oriente</option>
                                        <option value="Deshabilitado">Noroccidental</option>
                                    </select>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="item_estado" class="bmd-label-floating">Clinica Regional/local Que Realiza la Evaluacion</label>
                                    <select class="form-control" name="item_estado_reg" id="item_estado">
                                        <option value="" selected="" disabled="">Elija la oficina a la que pertenece</option>
                                        <option value="Habilitado">Comayagua</option>
                                        <option value="Deshabilitado">Choluteca</option>
                                        <option value="Deshabilitado">Siguatepeque</option>
                                        <option value="Deshabilitado">Juticalpa</option>
                                        <option value="Deshabilitado">Catacamas</option>
                                        <option value="Deshabilitado">La Esperanza</option>
                                        <option value="Deshabilitado">Marcala</option>
                                        <option value="Deshabilitado">La Paz</option>
                                        <option value="Deshabilitado">Nacaome</option>
                                        <option value="Deshabilitado">Danli</option>
                                        <option value="Deshabilitado">Yuscaran</option>
                                        <option value="Deshabilitado">Talanga</option>
                                    </select>
                                </div>
                            </div>
                            <p class="text-center" style="margin-top: 40px;">
                                <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                                &nbsp; &nbsp;
                                <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            </div>






        </section>
    </main>


    <!--=============================================
	=            Include JavaScript files           =
	==============================================-->
    <?php include "views/templates/archivosJS.php"; ?>

</body>

</html>