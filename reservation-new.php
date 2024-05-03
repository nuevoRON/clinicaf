<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Nuevo Medico</title>
    <?php include "./inc/link.php"; ?>
 
</head>


<body>
    <!-- Main container -->
    <main class="full-box main-container">
<!-- INICIO Nav lateral -->
<?php include "./in/NavBar.php"; ?>
<!-- FIN Nav lateral -->

        <section class="full-box page-content">
        <?php include "./inc/NavSup.php"; ?>

            <!-- Page header -->
            <div class="full-box page-header">
                <h3 class="text-left">
                    <i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO MEDICO
                </h3>
                <p class="text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium quod harum vitae, fugit quo soluta. Molestias officiis voluptatum delectus doloribus at tempore, iste optio quam recusandae numquam non inventore dolor.
                </p>
            </div>

            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a class="active" href="reservation-new.html"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO MEDICO</a>
                    </li>
                    <li>
                        <a href="reservation-reservation.html"><i class="far fa-calendar-alt"></i> &nbsp; RESERVACIONES</a>
                    </li>
                    <li>
                        <a href="reservation-pending.html"><i class="fas fa-hand-holding-usd fa-fw"></i> &nbsp; MEDICOS</a>
                    </li>
                    <li>
                        <a href="reservation-list.html"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; FINALIZADOS</a>
                    </li>
                    <li>
                        <a href="reservation-search.html"><i class="fas fa-search-dollar fa-fw"></i> &nbsp; BUSCAR POR FECHA</a>
                    </li>
                </ul>
            </div>

            <div class="container-fluid">
                <div class="container-fluid form-neon">
                    <div class="container-fluid">
                        <p class="text-center roboto-medium">AGREGAR CLIENTE O ITEMS</p>
                        <p class="text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCliente"><i class="fas fa-user-plus"></i> &nbsp; Agregar cliente</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalItem"><i class="fas fa-box-open"></i> &nbsp; Agregar item</button>
                        </p>
                        <div>
                            <span class="roboto-medium">CLIENTE:</span> 
                            <span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione un cliente</span>
                            <form action="" style="display: inline-block !important;">
                                Carlos Alfaro
                                <button type="button" class="btn btn-danger"><i class="fas fa-user-times"></i></button>
                            </form>
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


                        <div class="table-responsive">
                            <table class="table table-dark table-sm">
                                <thead>
                                    <tr class="text-center roboto-medium">
                                        <th>ITEM</th>
                                        <th>CANTIDAD</th>
                                        <th>TIEMPO</th>
                                        <th>COSTO</th>
                                        <th>SUBTOTAL</th>
                                        <th>DETALLE</th>
                                        <th>ELIMINAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center" >
                                        <td>Silla plastica</td>
                                        <td>7</td>
                                        <td>Hora</td>
                                        <td>$5.00</td>
                                        <td>$35.00</td>
                                        <td>
                                            <button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover" title="Nombre del item" data-content="Detalle completo del item">
                                                <i class="fas fa-info-circle"></i>
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
                                        <td>Silla metalica</td>
                                        <td>9</td>
                                        <td>Día</td>
                                        <td>$5.00</td>
                                        <td>$45.00</td>
                                        <td>
                                            <button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover" title="Nombre del item" data-content="Detalle completo del item">
                                                <i class="fas fa-info-circle"></i>
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
                                        <td>Mesa plastica</td>
                                        <td>5</td>
                                        <td>Evento</td>
                                        <td>$10.00</td>
                                        <td>$50.00</td>
                                        <td>
                                            <button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover" title="Nombre del item" data-content="Detalle completo del item">
                                                <i class="fas fa-info-circle"></i>
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
                                    <tr class="text-center bg-light">
                                        <td><strong>TOTAL</strong></td>
                                        <td><strong>21 items</strong></td>
                                        <td colspan="2"></td>
                                        <td><strong>$130.00</strong></td>
                                        <td colspan="2"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <form action="" autocomplete="off">
                        <fieldset>
                            <legend><i class="far fa-clock"></i> &nbsp; Fecha y hora </legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="prestamo_fecha_inicio">Fecha</label>
                                            <input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="prestamo_hora_inicio">Hora</label>
                                            <input type="time" class="form-control" name="prestamo_hora_inicio_reg" id="prestamo_hora_inicio">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend><i class="fas fa-history"></i> &nbsp; Fecha y hora de entrega</legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="prestamo_fecha_final">Fecha de entrega</label>
                                            <input type="date" class="form-control" name="prestamo_fecha_final_reg" id="prestamo_fecha_final">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="prestamo_hora_final">Hora de entrega</label>
                                            <input type="time" class="form-control" name="prestamo_hora_final_reg" id="prestamo_hora_final">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend><i class="fas fa-cubes"></i> &nbsp; Otros datos</legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="prestamo_estado" class="bmd-label-floating">Estado</label>
                                            <select class="form-control" name="prestamo_estado_reg" id="prestamo_estado">
                                                <option value="" selected="" disabled="">Seleccione una opción</option>
                                                <option value="Reservacion">Iniciado</option>
                                                <option value="Prestamo">En transito</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="prestamo_total" class="bmd-label-floating">Total a pagar en $</label>
                                            <input type="text" pattern="[0-9.]{1,10}" class="form-control" readonly="" value="100.00" id="prestamo_total" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="prestamo_pagado" class="bmd-label-floating">Total depositado en $</label>
                                            <input type="text" pattern="[0-9.]{1,10}" class="form-control" name="prestamo_pagado_reg" id="prestamo_pagado" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="prestamo_observacion" class="bmd-label-floating">Observación</label>
                                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ#() ]{1,400}" class="form-control" name="prestamo_observacion_reg" id="prestamo_observacion" maxlength="400">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <br><br><br>
                        <p class="text-center" style="margin-top: 40px;">
                            <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                            &nbsp; &nbsp;
                            <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                        </p>
                    </form>
                </div>
            </div>


            <!-- MODAL CLIENTE -->
            <div class="modal fade" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="ModalCliente" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCliente">Agregar cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="input_cliente" class="bmd-label-floating">DNI, Nombre, Apellido, Telefono</label>
                                    <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_cliente" id="input_cliente" maxlength="30">
                                </div>
                            </div>
                            <br>
                            <div class="container-fluid" id="tabla_clientes">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-sm">
                                        <tbody>
                                            <tr class="text-center">
                                                <td>0000000000 - Nombre del cliente</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"><i class="fas fa-user-plus"></i></button>
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>0000000000 - Nombre del cliente</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"><i class="fas fa-user-plus"></i></button>
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>0000000000 - Nombre del cliente</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"><i class="fas fa-user-plus"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="alert alert-warning" role="alert">
                                <p class="text-center mb-0">
                                    <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                    No hemos encontrado ningún cliente en el sistema que coincida con <strong>“Busqueda”</strong>
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

        </section>
    </main>
    
    	
	<!--=============================================
	=            Include JavaScript files           =
	==============================================-->
    <?php include "./in/java.php"; ?>

</body>
</html>