
   
   <!--         /*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/       -->	
   
   <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="prestamo_fecha_inicio">Fecha de Evaluación</label>
            <input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="prestamo_hora_inicio">Hora de Evaluación</label>
            <input type="time" class="form-control" name="prestamo_hora_inicio_reg" id="prestamo_hora_inicio">
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="cliente_dni" class="bmd-label-floating">DNI</label>
            <input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="cliente_nombre" class="bmd-label-floating">Nombre</label>
            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="cliente_nombre_reg" id="cliente_nombre" maxlength="40">
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="cliente_apellido" class="bmd-label-floating">Apellido</label>
            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="40">
        </div>
    </div>



    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="item_estado" class="bmd-label-floating">Nacionalidad</label>
            <select class="form-control" name="item_estado_reg" id="item_estado">
                <option value="" selected="" disabled="">Seleccione la Nacionalidad</option>
                <option value="Habilitado">Hondureña</option>
                <option value="Deshabilitado">Desconocida</option>
                <option value="Deshabilitado">Otra</option>
            </select>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="item_estado" class="bmd-label-floating">Sexo</label>
            <select class="form-control" name="item_estado_reg" id="item_estado">
                <option value="" selected="" disabled="">Seleccione el Sexo</option>
                <option value="Habilitado">Masculino</option>
                <option value="Deshabilitado">Femenino</option>
                <option value="Deshabilitado">A Determinar</option>
                <option value="Deshabilitado">Testigo Protegido</option>
            </select>
        </div>	
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="cliente_telefono" class="bmd-label-floating">diversidad</label>
            <input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="20">
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="item_estado" class="bmd-label-floating">Ocupación</label>
            <select class="form-control" name="item_estado_reg" id="item_estado">
                <option value="" selected="" disabled="">Seleccione la Ocupación</option>
                <option value="Habilitado">Ama de casa</option>
                <option value="Deshabilitado">Abogado</option>s
                <option value="Deshabilitado">Artesano</option>
                <option value="Deshabilitado">Estudiante</option>
            </select>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="item_estado" class="bmd-label-floating">Escolaridad</label>
            <select class="form-control" name="item_estado_reg" id="item_estado">
                <option value="" selected="" disabled="">Seleccione la Escolaridad</option>
                <option value="Habilitado">Analfabeta</option>
                <option value="Deshabilitado">Primaria Incompleta</option>s
                <option value="Deshabilitado">Primaria Completa</option>
                <option value="Deshabilitado">Secundaria Incompleta</option>
                <option value="Deshabilitado">Secundaria completa</option>
                <option value="Deshabilitado">Universitaria Incompleta</option>
                <option value="Deshabilitado">Universitaria completa</option>
                <option value="Deshabilitado">No Aplica</option>
                <option value="Deshabilitado">Testigo Protegido (VERIFICAR)</option>
            </select>
        </div>
    </div>
    
    <div class="col-12 col-md-2">
        <div class="form-group">
            <label for="cliente_telefono" class="bmd-label-floating">Edad</label>
            <input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="3">
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="item_estado" class="bmd-label-floating">Tiempo</label>
            <select class="form-control" name="item_estado_reg" id="item_estado">
                <option value="" selected="" disabled="">Seleccione el Tiempo</option>
                <option value="Habilitado">Horas</option>
                <option value="Deshabilitado">Dias</option>s
                <option value="Deshabilitado">Semanas</option>
                <option value="Deshabilitado">Meses</option>
                <option value="Deshabilitado">Años</option>
            </select>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="cliente_direccion" class="bmd-label-floating">Dirección</label>
            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="cliente_direccion_reg" id="cliente_direccion" maxlength="150">
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="cliente_direccion" class="bmd-label-floating">dependencia</label>
            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="cliente_direccion_reg" id="cliente_direccion" maxlength="150">
        </div>
    </div>

 
<div class="col-12 col-md-4">
<div class="form-group">
    <label for="cliente_direccion" class="bmd-label-floating">Delito</label>
    <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="cliente_direccion_reg" id="cliente_direccion" maxlength="150">
</div>
</div>


        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="prestamo_fecha_inicio">Fecha de Evaluación</label>
                <input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="prestamo_hora_inicio">Hora de Evaluación</label>
                <input type="time" class="form-control" name="prestamo_hora_inicio_reg" id="prestamo_hora_inicio">
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="cliente_dni" class="bmd-label-floating">DNI</label>
                <input type="text" pattern="[0-9-]{1,27}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="27">
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="cliente_nombre" class="bmd-label-floating">Nombre</label>
                <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="cliente_nombre_reg" id="cliente_nombre" maxlength="40">
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="cliente_apellido" class="bmd-label-floating">Apellido</label>
                <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="40">
            </div>
        </div>


        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="item_estado" class="bmd-label-floating">Nacionalidad</label>
                <select class="form-control" name="item_estado_reg" id="item_estado">
                    <option value="" selected="" disabled="">Seleccione la Nacionalidad</option>
                    <option value="Habilitado">Hondureña</option>
                    <option value="Deshabilitado">Desconocida</option>
                    <option value="Deshabilitado">Otra</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="item_estado" class="bmd-label-floating">Sexo</label>
                <select class="form-control" name="item_estado_reg" id="item_estado">
                    <option value="" selected="" disabled="">Seleccione el Sexo</option>
                    <option value="Habilitado">Masculino</option>
                    <option value="Deshabilitado">Femenino</option>
                    <option value="Deshabilitado">A Determinar</option>
                    <option value="Deshabilitado">Testigo Protegido</option>
                </select>
            </div>	
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="cliente_telefono" class="bmd-label-floating">diversidad</label>
                <input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="20">
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="item_estado" class="bmd-label-floating">Ocupación</label>
                <select class="form-control" name="item_estado_reg" id="item_estado">
                    <option value="" selected="" disabled="">Seleccione la Ocupación</option>
                    <option value="Habilitado">Ama de casa</option>
                    <option value="Deshabilitado">Abogado</option>s
                    <option value="Deshabilitado">Artesano</option>
                    <option value="Deshabilitado">Estudiante</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="item_estado" class="bmd-label-floating">Escolaridad</label>
                <select class="form-control" name="item_estado_reg" id="item_estado">
                    <option value="" selected="" disabled="">Seleccione la Escolaridad</option>
                    <option value="Habilitado">Analfabeta</option>
                    <option value="Deshabilitado">Primaria Incompleta</option>s
                    <option value="Deshabilitado">Primaria Completa</option>
                    <option value="Deshabilitado">Secundaria Incompleta</option>
                    <option value="Deshabilitado">Secundaria completa</option>
                    <option value="Deshabilitado">Universitaria Incompleta</option>
                    <option value="Deshabilitado">Universitaria completa</option>
                    <option value="Deshabilitado">No Aplica</option>
                    <option value="Deshabilitado">Testigo Protegido (VERIFICAR)</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="form-group">
                <label for="cliente_telefono" class="bmd-label-floating">Edad</label>
                <input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="3">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="item_estado" class="bmd-label-floating">Tiempo</label>
                <select class="form-control" name="item_estado_reg" id="item_estado">
                    <option value="" selected="" disabled="">Seleccione el Tiempo</option>
                    <option value="Habilitado">Horas</option>
                    <option value="Deshabilitado">Dias</option>s
                    <option value="Deshabilitado">Semanas</option>
                    <option value="Deshabilitado">Meses</option>
                    <option value="Deshabilitado">Años</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="cliente_direccion" class="bmd-label-floating">Dirección</label>
                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="cliente_direccion_reg" id="cliente_direccion" maxlength="150">
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="cliente_direccion" class="bmd-label-floating">dependencia</label>
                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="cliente_direccion_reg" id="cliente_direccion" maxlength="150">
            </div>
        </div>



<div class="col-12 col-md-4">
    <div class="form-group">
        <label for="cliente_direccion" class="bmd-label-floating">Delito</label>
        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="cliente_direccion_reg" id="cliente_direccion" maxlength="150">
    </div>
</div>


 <!--=============================================
	=            selector          =
	==============================================-->
    <form method="post" action="tratamiento.php">
                            <p>
                            Por favor, indica tu rango de edad:<br>
                            <input type="radio" name="edad" value="menos15" id="menos15"/>
                            <label for="menos15">Menos de 15 años</label><br />
                            <input type="radio" name="edad" value="medio15-25"
                            id="medio15-25" /> <label for="medio15-25">15-25 años</label><br />
                            <input type="radio" name="edad" value="medio25-40"
                            id="medio25-40" /> <label for="medio25-40">25-40 años</label><br />
                            <input type="radio" name="edad" value="mas40" id="mas40" />
                            <label for="plus40">¿Más viejo?</label>
                            </p>
                        </form>
                            
<!--=============================================
=            selector           =
==============================================-->

<form method="post" action="tratamiento.php">
    <fieldset>
    <legend>Vuestras coordenadas</legend> <!-- Título campo -->
    <label for="nom">¿Cuál es su nombre?</label>
    <input type="text" name="nombre" id="nombre" />
    <label for="apellido">¿Cuál es su apellido?</label>
    <input type="text" name="apellido" id="apellido" />
    <label for="email">¿Cuál es su email?</label>
    <input type="email" name="email" id="email" />
    </fieldset>
    <fieldset>
    <legend>Tus deseos</legend> <!-- Título de campo -->
    <p>
    Di un deseo que deseas que se cumpla:
    <input type="radio" name="deseo" value="rico" id="rico" /> <label
    for="rico">Ser rico</label>
    <input type="radio" name="deseo" value="celebre" id="celebre" />
    <label for="celebre">Ser célebre</label>
    <input type="radio" name="deseo" value="inteligente"
    id="inteligente" /> <label for="inteligente">Ser
    <strong>todavía</strong> más inteligente</label>
    <input type="radio" name="deseo" value="otro" id="otro" /> <label
    for="otro">Otros...</label>
    </p>
    <p>
    :</label>
    <label for="precise">Si "Otros", precisar
    <textarea name="precise" id="precise" cols="40" rows="4">
    </textarea>
    </p>
    </fieldset>
    </form>


    
            <!-- MODAL AGREGAR ITEM -->
            <div class="modal fade" id="ModalAgregarItem" tabindex="-1" role="dialog" aria-labelledby="ModalAgregarItem" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="modal-content FormularioAjax">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalAgregarItem">Selecciona el formato, cantidad de items, tiempo y costo del préstamo del item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_agregar_item" id="id_agregar_item">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="detalle_formato" class="bmd-label-floating">Formato de préstamo</label>
                                            <select class="form-control" name="detalle_formato" id="detalle_formato">
                                                <option value="Horas" selected="" >Horas</option>
                                                <option value="Dias">Días</option>
                                                <option value="Evento">Evento</option>
                                                <option value="Mes">Mes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="detalle_cantidad" class="bmd-label-floating">Cantidad de items</label>
                                            <input type="num" pattern="[0-9]{1,7}" class="form-control" name="detalle_cantidad" id="detalle_cantidad" maxlength="7" required="" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="detalle_tiempo" class="bmd-label-floating">Tiempo (según formato)</label>
                                            <input type="num" pattern="[0-9]{1,7}" class="form-control" name="detalle_tiempo" id="detalle_tiempo" maxlength="7" required="" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="detalle_costo_tiempo" class="bmd-label-floating">Costo por unidad de tiempo</label>
                                            <input type="text" pattern="[0-9.]{1,15}" class="form-control" name="detalle_costo_tiempo" id="detalle_costo_tiempo" maxlength="15" required="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >Agregar</button>
                            &nbsp; &nbsp;
                            <button type="button" class="btn btn-secondary" >Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>



                        <!-- MODAL ITEM -->
                        <div class="modal fade" id="ModalItem" tabindex="-1" role="dialog" aria-labelledby="ModalItem" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalItem">Agregar item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="input_item" class="bmd-label-floating">Código, Nombre</label>
                                    <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_item" id="input_item" maxlength="30">
                                </div>
                            </div>
                            <br>
                            <div class="container-fluid" id="tabla_items">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-sm">
                                        <tbody>
                                            <tr class="text-center">
                                                <td>000000000000 - Nombre del item</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"><i class="fas fa-box-open"></i></button>
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>000000000000 - Nombre del item</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"><i class="fas fa-box-open"></i></button>
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>000000000000 - Nombre del item</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"><i class="fas fa-box-open"></i></button>
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>000000000000 - Nombre del item</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"><i class="fas fa-box-open"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="alert alert-warning" role="alert">
                                <p class="text-center mb-0">
                                    <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                    No hemos encontrado ningún item en el sistema que coincida con <strong>“Busqueda”</strong>
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                            &nbsp; &nbsp;
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>