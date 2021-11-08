<!DOCTYPE html>
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
            <h1>Vehículo</h1>
            <?php if (
                $_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>' ||
                $_SESSION['tipoUser'] == '<span class="badge badge-info">Guarda seguridad</span>'
            ) { ?>
                <div class="card-body">
                    <span class="btn btn-primary" style="background: blue;" onclick="openModal();">Agregar nuevo Vehículo
                        <span class="fa fa-plus-circle" style="color: #fff; font-size: 20px;"></span>
                    </span>
                </div>
            <?php } ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr class="titulos_encabezados">
                        <th>Placa V.</th>
                        <th>Modelo V.</th>
                        <th>Marca V.</th>
                        <th>Color V.</th>
                        <th>Tipo V.</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr class="titulos_encabezados">
                        <th>Placa V.</th>
                        <th>Modelo V.</th>
                        <th>Marca V.</th>
                        <th>Color V.</th>
                        <th>Tipo V.</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="agregarVehiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Agregar nuevo Vehículo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formVehiculo" name="formVehiculo">
                            <!--Inicio formulario-->

                            <h1><span id="textTittle">Registrar</span>Vehículo</h1>
                            <!--Título principal-->

                            <div class="text-center">
                                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/seguro_vehiculos_particulares.png" alt="Responsive image" />
                            </div>
                            <br />

                            <input type="hidden" id="idVehiculo" name="idVehiculo" value="">

                            <div class="form-group">
                                <!--Agrega una estructura organizada al formulario-->
                                <label for="placaVehiculo" class="label">Placa del vehículo</label>
                                <!--Caja de texto en el formulario y su contenido-->
                                <input type="text" id="placaVehiculo" name="placaVehiculo" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese la placa del vehículo" placeholder="Ingrese la placa del vehículo" required="required" maxlength="6" />
                                <!--Control interactivo para el formulario-->
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->


                            <div class="form-group">
                                <!--Agrega una estructura organizada al formulario-->
                                <label for="modeloVehiculo" class="label">Modelo del vehículo</label>
                                <!--Caja de texto en el formulario y su contenido-->
                                <input type="number" id="modeloVehiculo" name="modeloVehiculo" class="form-control" pattern="[1-9]+" ta-toggle="tooltip" data-placement="bottom" title="Ingrese el Modelo del vehículo" placeholder="Ingrese el Modelo del vehículo" required="required" maxlength="4" />
                                <!--Control interactivo para el formulario-->
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->


                            <div class="form-group">
                                <!--Agrega una estructura organizada al formulario-->
                                <label for="marcaVehiculo" class="label">Marca del vehículo</label>
                                <!--Caja de texto en el formulario y su contenido-->
                                <select class=" form-control" id="marcaVehiculo" name="marcaVehiculo" required="required" data-toggle="tooltip" data-placement="bottom" title="Ingrese la Marca del vehículo">
                                    <!--lista desplegable-->
                                    <option value="Toyota">Toyota</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Hyundai">Hyundai</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Mazda">Mazda</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Volkswagen">Volkswagen</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Ford">Ford</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Nissan">Nissan</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Chevrolet">Chevrolet</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Kia">Kia</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="BMW">BMW</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Peugeot">Peugeot</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Dodge">Dodge</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Honda">Honda</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Suzuki">Suzuki</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Renault">Renault</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Skoda">Skoda</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Seat">Seat</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Subaru">Subaru</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="sangYong">sangYong</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Range Rover">Range Rover</option>
                                    <!-- elementos de la lista desplegable-->
                                </select>
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->

                            <div class="form-group">
                                <!--Agrega una estructura organizada al formulario-->
                                <label for="colorVehiculo" class="label">Color del vehículo</label>
                                <!--Caja de texto en el formulario y su contenido-->
                                <input type="color" id="colorVehiculo" name="colorVehiculo" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Color del vehículo" class="form-control" required="required" />
                                <!--Opciones para el color del vehículo-->
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->

                            <div class="form-group">
                                <!--Agrega una estructura organizada al formulario-->
                                <label for="marcaVehiculo" class="label">Tipo vehículo</label>
                                <!--Caja de texto en el formulario y su contenido-->
                                <select class=" form-control" id="tipoVehiculo" name="tipoVehiculo" required="required" data-toggle="tooltip" data-placement="bottom" title="Tipo de vehículo">
                                    <!--lista desplegable-->
                                    <option>Carro</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option>Moto</option>
                                    <!-- elementos de la lista desplegable-->
                                </select>
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->

                            <div class="botones">
                                <br />
                                <!--obligar un salto de linea-->
                                <button type="submit" id="btnInsertVeh" name="insertar" value="Registrarme" class="Registar" data-toggle="tooltip" data-placement="bottom" title="Registrar Vehículo"><span id="btnText">
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
    <script src="<?php echo SERVERURL; ?>View/Assets/js/functionVehiculo.js"></script>

</body>

</html>