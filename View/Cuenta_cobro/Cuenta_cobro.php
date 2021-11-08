<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Sistema de información de la Unidad Residencial Avenida Décima">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="Unidad Residencial Avenida Décima | URAD">
    <title><?php echo $data['titulo_pagina']; ?></title>
    <!--HOJAS DE ESTILOS-->
    <?php
    estilos();
    ?>

</head>

<body>
    <?php
    asidePrincipal();
    ?>
    <!--CONTENIDO DE LA PÁGINA PRINCIPAL-->
    <section class="conten-page">
        <div class="container" id="datatables">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>') { ?>
                        <div class="col-lg-12">
                            <h1>Cuentas de cobro</h1>
                            <div class="card-body">
                                <span class="btn btn-primary" style="color: #fff; background: blue;" onclick="openModal();">
                                    Agregar nueva Cuenta <span class="fas fa-plus-circle" style="font-size: 20px; color: #fff;"></span>
                                </span>
                            </div>
                        <?php } ?>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr class="titulos_encabezados">
                                    <th>ID</th>
                                    <th>Fecha Expide</th>
                                    <th>Fecha vencimiento</th>
                                    <th>Estado</th>
                                    <th>Periodo</th>
                                    <th>F. Pago oportuno</th>
                                    <th>F. consignación</th>
                                    <th>Valor pago</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="titulos_encabezados">
                                    <th>ID</th>
                                    <th>Fecha Expide</th>
                                    <th>Fecha vencimiento</th>
                                    <th>Estado</th>
                                    <th>Periodo</th>
                                    <th>F. Pago oportuno</th>
                                    <th>F. consignación</th>
                                    <th>Valor pago</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                </div>
            </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="agregarCuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Agregar nueva Cuenta de Cobro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCuenta" name="formCuenta" method="POST" class="needs-validation" novalidate>
                        <!--para empezar a construir el formulario-->
                        <h1><span id="textTittle">Registro</span> Cuenta cobro</h1>
                        <!--Título principal-->

                        <div class="text-center">
                            <!--creamos una clase para la imagen-->
                            <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/cuenta_cobro.png" />
                            <!--colocar una imagen-->
                        </div>
                        <br />

                        <input type="hidden" id="idCuenta" name="idCuenta" value="">

                        <div class="row">
                            <div class="col">
                                <!--para agrupar los elementos-->
                                <label for="fechaExpideCuenta"><i class="fas fa-calendar-alt"> Fecha expide cuenta</i></label>
                                <!--Nombre del elemento-->
                                <input type="date" id="fechaExpideCuenta" name="fechaExpideCuenta" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese la  Fecha que se expide la cuenta" required="required" />
                                <!--crar un caja de fecha y hora local-->
                            </div>

                            <div class="col">
                                <!--para agrupar los elementos-->
                                <label for="fechaVencimientoPago"><i class="fas fa-calendar-times"> Fecha vencimiento pago</i></label>
                                <!--Nombre del elemento-->
                                <input type="date" id="fechaVencimientoPago" name="fechaVencimientoPago" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese la Fecha de vencimiento pago" required="required" />
                                <!--crar un caja de fecha y hora local-->
                            </div>
                        </div>

                        <div class="form-group">
                            <!--para agrupar los elementos-->
                            <label for="estadoCuenta"><i class="fas fa-hand-holding-usd"> Estado Cuenta</i></label>
                            <select class=" form-control" id="estadoCuenta" name="estadoCuenta" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Seleccione el Estado Cuenta" required="required">
                                <option value="Pendiente">Pendiente</option>
                                <option value="Cancelado">Cancelado</option>
                                <option value="Parcial">Parcial</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <!--para agrupar los elementos-->
                            <label for="periodoCuenta"><i class="fas fa-file-invoice-dollar"> Periodo Cuenta</i></label>
                            <!--Nombre del elemento-->
                            <input type="month" id="periodoCuenta" name="periodoCuenta" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Periodo de la Cuenta" required="required" />
                            <!--crar un caja de texto-->
                        </div>

                        <div class="row">
                            <div class="col">
                                <!--para agrupar los elementos-->
                                <label for="fechaPagoOportuno"><i class="fas fa-calendar-check"> Fecha Pago oportuno</i></label>
                                <!--Nombre del elemento-->
                                <input type="date" id="fechaPagoOportuno" name="fechaPagoOportuno" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese la Fecha de Pago oportuno" required="required" />
                                <!--crar un caja de texto-->
                            </div>

                            <div class="col">
                                <!--para agrupar los elementos-->
                                <label for="fechaConsignacion"><i class="fas fa-calendar-day"> Fecha de consignación</i></label>
                                <!--Nombre del elemento-->
                                <input type="date" id="fechaConsignacion" class="form-control" name="fechaConsignacion" data-toggle="tooltip" data-placement="bottom" title="Ingrese la Fecha de consignación" required="required" />
                                <!--crar un caja de texto-->
                            </div>
                        </div>

                        <div class="form-group">
                            <!--para agrupar los elementos-->
                            <label for="valorPagoCuenta"><i class="fas fa-file-invoice-dollar"> Valor pago cuenta</i></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="text" name="valorPagoCuenta" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Valor pago cuenta" id="inlineFormInputGroup" placeholder="Ejm: 12345.567" maxlength="20" required />
                            </div>
                        </div>

                        <div class="botones">
                            <br />
                            <!--obligar un salto de linea-->
                            <button type="submit" id="btnInsertCuenta" name="insertar" value="Registrarme" class="Registar" data-toggle="tooltip" data-placement="bottom" title="Registrar Cuenta"><span id="btnText">
                                    Registrar</span>&nbsp<i class="far fa-save" style="font-size: 20px;"></i> </button>
                        </div>
                    </form>
                    <!--Fin de formulario-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar &nbsp
                        <i class="fas fa-window-close" style="font-size: 20px; background: red;"></i></button>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!--FOOTER DE LA PÁGINA-->
    <?php
    footerSitio();
    ?>

    <!--SCRIPTS-->
    <?php
    scriptSitio();
    ?>
    <script src="<?php echo SERVERURL; ?>View/Assets/js/functionCuentaCobro.js"></script>
</body>

</html>