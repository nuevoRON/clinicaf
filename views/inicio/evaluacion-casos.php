<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Control de Revisión de Casos</title>
    <?php include "views/templates/archivosCss.php"; ?>
</head>

<body>
    <main class="full-box main-container">
        <?php include "views/templates/NavBar.php"; ?>
        <section class="full-box page-content">
            <?php include "views/templates/NavSup.php"; ?>
            <h3 class="text-left">
                <i class="fas fa-exchange-alt"></i> &nbsp; CONTROL DE REVISIÓN DE CASOS
            </h3>
            <div class="container-fluid">
				<div class="text-center">
                    <p class="text-center">
                        <button type="button" class="btn btn-primary" id="btnModalCaso"><i class="fas fa-user-plus"></i> &nbsp; Agregar Caso</button>
                    </p>
					<button type="button" class="btn btn-danger" id="btnPDFCaso">
						<i class="fas fa-file-pdf"></i> &nbsp; Exportar PDF
					</button>
					<button type="button" class="btn btn-success" id="btnExcelCaso">
						<i class="fas fa-file-excel"></i> &nbsp; Exportar Excel
					</button>
				</div>
			</div>
            
            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table table-dark table-sm" id="tabla_revisiones">
                        <thead>
                            <tr class="text-center roboto-medium">
                                <th>#</th>
                                <th>MEDICO</th>
                                <th>ENVIADO PARA</th>
                                <th>FECHA DE REVISION</th>
                                <th>TIPO DE DICTAMEN</th>
                                <th>N° DICTAMEN</th>
                                <th>NOMBRE EVALUADO</th>
                                <th>FECHA DE EVALUACION</th>
                                <th>TIPO DE RECONOCIMIENTO</th>
                                <th>OBSERVACION RECONOCIMIENTO</th>
                                <th>ESTADO DE DICTAMEN</th>
                                <th>OBSERVACION DICTAMEN</th>
                                <th>SEDE MEDICO</th>
                                <th>CLINICA</th>
                                <th>MODIFICAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="ModalCaso" tabindex="-1" role="dialog" aria-labelledby="ModalCaso" data-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Agregar Caso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" class="form-neon" id="formulario">
                                <input type="hidden" name="id" id="id">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="medico" class="bmd-label">Medico que Realizo la Revision</label>
                                        <select class="form-control" name="medico" id="medico" required>
                                            <option value="" selected="" disabled="">Seleccione el Medico</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="enviado_para" class="bmd-label">Enviado para</label>
                                        <select class="form-control" name="enviado_para" id="enviado_para" required>
                                            <option value="" selected="" disabled="">Seleccione para que fue enviado</option>
                                            <option value="Revision">Revision</option>
                                            <option value="Descargo">Descargo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="fecha_revision">Fecha de Revision</label>
                                        <input type="date" class="form-control" name="fecha_revision" id="fecha_revision" required>
                                    </div>

                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="tipo_dictamen" class="bmd-label">Tipo de Dictamen a Revisar</label>
                                        <select class="form-control" name="tipo_dictamen" id="tipo_dictamen" required>
                                            <option value="" selected="" disabled="">Seleccione el Tipo de Dictamen</option>
                                            <option value="Clinica Forense">Clinica Forense</option>
                                            <option value="Levantamiento">Levantamiento</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="num_dictamen" class="bmd-label">Numero de Dictamen</label>
                                        <input type="text" class="form-control" name="num_dictamen" id="num_dictamen" required>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="nombre_evaluado" class="bmd-label">Nombre del Evaluado</label>
                                        <input type="text" class="form-control" name="nombre_evaluado" id="nombre_evaluado" required>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="fecha_realizacion">Fecha que se Realizo la Evaluacion</label>
                                        <input type="date" class="form-control" name="fecha_realizacion" id="fecha_realizacion" required>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="tipo_reconocimiento" class="bmd-label">Tipo de Reconocimiento</label>
                                        <select class="form-control" name="tipo_reconocimiento" id="tipo_reconocimiento" required>
                                            <option value="" selected="" disabled="">Seleccione el Tipo de Reconocimiento</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="observaciones_rec" class="bmd-label">Observaciones Reconocimiento</label>
                                        <input type="text" class="form-control" name="observaciones_rec" id="observaciones_rec" maxlength="255">
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="estado_dictamen" class="bmd-label">Estado del Dictamen</label>
                                        <select class="form-control" name="estado_dictamen" id="estado_dictamen" required>
                                            <option value="" selected="" disabled="">Seleccione el Estado</option>
                                            <option value="Completo">Completo</option>
                                            <option value="Incompleto, Sin Resultado de Laboratorio">Incompleto, Sin Resultado de Laboratorio</option>
                                            <option value="Incompleto, Pendiente de Revision de Expediente">Incompleto, Pendiente de Revision de Expediente</option>
                                            <option value="Levantamiento Enviado a Autopsia">Levantamiento Enviado a Autopsia</option>
                                            <option value="Levantamiento Entregado a Familiar">Levantamiento Entregado a Familiar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="obs_dictamen" class="bmd-label">Observaciones Dictamen</label>
                                        <input type="text" class="form-control" name="obs_dictamen" id="obs_dictamen" maxlength="255">
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="sede_medico" class="bmd-label">Sede del Medico Evaluador</label>
                                        <select class="form-control" name="sede_medico" id="sede_medico" required>
                                            <option value="" selected="" disabled="">Seleccione la Sede</option>
                                            <option value="Centro Sur Oriente">Centro Sur Oriente</option>
                                            <option value="Noroccidental">Noroccidental</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="sede_clinica" class="bmd-label">Clinica Regional/local Que Realiza la Evaluacion</label>
                                        <select class="form-control" name="sede_clinica" id="sede_clinica" required>
                                            <option value="" selected="" disabled="">Elija la oficina a la que pertenece</option>

                                        </select>
                                    </div>
                                </div>
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
        </div>
        </section>
    </main>

    <?php include "views/templates/archivosJS.php"; ?>
    <script type="module" src="<?php echo BASE_URL; ?>assets/js/modulos/revision-casos.js"></script>
</body>

</html>