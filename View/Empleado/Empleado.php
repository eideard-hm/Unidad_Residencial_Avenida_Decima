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
            <div class="row">
                <div class="col-lg-12">
                    <h1>Empleado</h1>
                    <?php if ($_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>') { ?>
                        <div class="card-body">
                            <span class="btn btn-primary" style="background: blue;" onclick="openModal();">Agregar nuevo Empleado
                                <span class="fa fa-plus-circle" style="color: #fff; font-size: 20px;"></span>
                            </span>
                        </div>
                    <?php } ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr class="titulos_encabezados">
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo Doc</th>
                                <th>N° Doc</th>
                                <th>Teléfono</th>
                                <th>Cargo</th>
                                <th>ARL</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr class="titulos_encabezados">
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo Doc</th>
                                <th>N° Doc</th>
                                <th>Teléfono</th>
                                <th>Cargo</th>
                                <th>ARL</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="agregarEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Agregar nuevo Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEmp" name="formEmp" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        <!--para empezar a construir el formulario-->
                        <h1><span id="textTittle">Registrar</span> Empleado</h1>
                        <!--Título principal-->

                        <div class="text-center">
                            <!--creamos una clase para la imagen-->
                            <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/empleado.png" class="img-circle" />
                            <!--colocar una imagen-->
                        </div>
                        <br />

                        <input type="hidden" id="idEmpleado" name="idEmpleado" value="">

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="nombreEmpleado"><i class="fas fa-file-signature"> Nombres</i></label>
                                <input type="text" id="nombreEmpleado" name="nombreEmpleado" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese los nombres del Empleado" placeholder="Ingrese los nombres del Empleado" required="required" maxlength="30" />

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidosEmpleado"><i class="fas fa-edit"> Apellidos</i></label>
                                <input type="text" id="apellidosEmpleado" name="apellidosEmpleado" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese los apellidos del Empleado" placeholder="Ingrese los apellidos del Empleado" required="required" maxlength="30" />
                            </div>
                        </div>
                        <!--Final etiqueta div (funciona para agrupar contenido)-->

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="tipoDocEmpleado"><i class="fas fa-id-card"> Tipo de Documento</i></label>
                                <select id="tipoDocEmpleado" name="tipoDocEmpleado" class=" form-control" data-toggle="tooltip" data-placement="bottom" title="Elija el tipo de documento" required="required">
                                    <!--Lista para elegir el tipo de documento-->
                                    <option selected disabled value="">Elige el tipo de documento</option>>
                                    <!--Opción de la lista-->
                                    <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                    <!--Opción de la lista-->
                                    <option value="Registro civil">Registro civil</option>
                                    <!--Opción de la lista-->
                                    <option value="Cédula de extranjería">Cédula de extranjería</option>
                                    <!--Opción de la lista-->
                                    <option value="Pasaporte extranjero">Pasaporte extranjero</option>
                                    <!--Opción de la lista-->
                                </select>
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->

                            <div class="col-md-6 mb-3">
                                <label for="numDocEmpleado"><i class="fas fa-id-card-alt"> Número de documento</i></label>
                                <input type="text" id="numDocEmpleado" name="numDocEmpleado" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese el número de documento del Empleado" placeholder="Ingrese el número de documento del Empleado" required="required" maxlength="10" />
                            </div>
                        </div>
                        <!--Final etiqueta div (funciona para agrupar contenido)-->

                        <div class="form-group">
                            <!--Agrega una estructura organizada al formulario-->
                            <label for="numTelEmpleado"><i class="fas fa-mobile"> Número de telefono</i></label>
                            <!--Caja de texto en el formulario y su contenido-->
                            <input type="tel" id="numTelEmpleado" name="numTelEmpleado" class="form-control" placeholder="Ingrese el número de telefono" data-toggle="tooltip" data-placement="bottom" title="Ingrese el número de telefono del Empleado" maxlength="10" required="required" />
                            <!--Control interactivo para el formulario-->
                        </div>
                        <!--Final etiqueta div (funciona para agrupar contenido)-->

                        <div class="form-group">
                            <!--para agrupar los elementos-->
                            <label for="cargoEmpleado"><i class="fas fa-user-md"> Cargo Empleado</i></label>
                            <!--Nombre del elemento-->
                            <input type="text" id="cargoEmpleado" name="cargoEmpleado" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese el cargo del Empleado" placeholder="Cargo Empleado" required="required" />
                            <!--crar un caja de texto-->
                        </div>

                        <div class="form-group">
                            <!--para agrupar los elementos-->
                            <label for="ARLEmpleado"><i class="fas fa-address-book"> ARL Empleado</i></label>
                            <!--Nombre del elemento-->
                            <input type="text" id="ARLEmpleado" name="ARLEmpleado" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese la ARL del Empleado" placeholder="ARL Empleado" required="required" />
                            <!--crar un caja de texto-->
                        </div>

                        <div class="form-group">
                            <label for="estadoEmpleado"><i class="fas fa-toggle-off"> Estado</i></label>
                            <!--Espacio que indica el tipo de documento-->
                            <select class="custom-select form-control" id="estadoEmpleado" name="estadoEmpleado" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Estado del administrador" required>
                                <!--Lista para elegir el tipo de documento-->
                                <option selected disabled value="">Elige el estado del empleado</option>
                                <!--Opción de la lista-->
                                <option>Activo</option>
                                <!-- elementos de la lista desplegable-->
                                <option>Inactivo</option>
                                <!-- elementos de la lista desplegable-->
                            </select>
                        </div>

                        <div class="botones">
                            <!--Inicio de etiqueta div para agrupar contenido-->
                            <br />
                            <!--Salto de línea en el texto-->
                            <button type="submit" id="btnInsertEm" value="Registrar" class="Registar" data-toggle="tooltip" data-placement="bottom" title="Registrar Empleado"><span id="btnText">Registrar</span> &nbsp<i class="fas fa-user-edit" style="font-size: 20px;"></i> </button>
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

    <!--FOOTER DE LA PÁGINA-->
    <?php
    footerSitio();
    ?>

    <!--SCRIPTS-->
    <?php
    scriptSitio();
    ?>

    <script src="<?php echo SERVERURL; ?>View/Assets/js/functionEmpleado.js"></script>
</body>

</html>