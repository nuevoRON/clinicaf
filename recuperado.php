   <!--         /*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/       -->	
   
   <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="prestamo_fecha_inicio">Fecha de Evaluaciòn</label>
            <input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="prestamo_hora_inicio">Hora de Evaluaciòn</label>
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
            <label for="item_estado" class="bmd-label-floating">Ocupacion</label>
            <select class="form-control" name="item_estado_reg" id="item_estado">
                <option value="" selected="" disabled="">Seleccione la Ocupacion</option>
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

