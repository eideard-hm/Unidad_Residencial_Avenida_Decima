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
                    <h1>Visitante</h1>
                    <?php if (
                        $_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>' ||
                        $_SESSION['tipoUser'] == '<span class="badge badge-info">Guarda seguridad</span>'
                    ) { ?>
                        <div class="card-body">
                            <span class="btn btn-primary" style="background: blue;" onclick="openModal();">Agregar nuevo Visitante
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
                                <th>Torre</th>
                                <th>Interior</th>
                                <th>Apto</th>
                                <th>Fecha Ingreso</th>
                                <th>Hora Ingreso</th>
                                <th>Fecha Salida</th>
                                <th>Hora Salida</th>
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
                                <th>Torre</th>
                                <th>Interior</th>
                                <th>Apto</th>
                                <th>Fecha Ingreso</th>
                                <th>Hora Ingreso</th>
                                <th>Fecha Salida</th>
                                <th>Hora Salida</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="agregarVisitante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Agregar nuevo Visitante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formVisitante" name="formVisitante" class="needs-validation" novalidate enctype="multipart/form-data">
                            <!--Inicio formulario-->

                            <h1><span id="textTittle">Registro</span> Visitante</h1>
                            <!--Título principal-->

                            <div class="text-center">
                                <!--creamos una clase para la imagen-->
                                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/Visitante.png" />
                                <!--colocar una imagen-->
                            </div>
                            <br />

                            <input type="hidden" name="idVisitante" id="idVisitante" value="">

                            <div class="row">
                                <div class="col">
                                    <label for="nombreVisitante"><i class="fas fa-file-signature"> Nombres</i></label>
                                    <input type="text" class="form-control" id="nombreVisitante" name="nombreVisitante" data-toggle="tooltip" data-placement="bottom" title="Ingrese los nombres del visitant" placeholder="Ingrese los nombres del visitante" required="required" maxlength="30" />

                                </div>
                                <div class="col">
                                    <label for="apellidosVisitante"><i class="fas fa-edit"> Apellidos</i></label>
                                    <input type="text" id="apellidosVisitante" name="apellidosVisitante" class="form-control" placeholder="Ingrese los apellidos del visitante" data-toggle="tooltip" data-placement="bottom" title="Ingrese los apellidos del visitante" required="required" maxlength="30" />
                                </div>
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->

                            <div class="row">
                                <div class="col">
                                    <label for="tipoDocVisitante"><i class="fas fa-id-card"> Tipo de Documento</i></label>
                                    <select class=" form-control" id="tipoDocVisitante" name="tipoDocVisitante" required="required" data-toggle="tooltip" data-placement="bottom" title="Elige el tipo de documento">
                                        <!--lista desplegable-->
                                        <option selected disabled value="">Elige el tipo de documento</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                        <option value="Registro civil">Registro civil</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="Cédula de extranjería">Cédula de extranjería</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="Pasaporte extranjero">Pasaporte extranjero</option>
                                        <!-- elementos de la lista desplegable-->
                                    </select>
                                </div>
                                <!--Final etiqueta div (funciona para agrupar contenido)-->

                                <div class="col">
                                    <label for="numeroDocVisitante"><i class="fas fa-id-card-alt"> Número de documento</i></label>
                                    <input type="text" id="numeroDocVisitante" name="numeroDocVisitante" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese el número de documento del visitante" placeholder="Ingrese el número de documento del visitante" required="required" maxlength="10" />
                                </div>
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->

                            <div class="row">
                                <div class="col">
                                    <!--Agrega una estructura organizada al formulario-->
                                    <label for="numTorreVisitante"><i class="fas fa-building"> Torre</i></label>
                                    <!--Caja de texto en el formulario y su contenido-->
                                    <select class=" form-control" id="numTorreVisitante" name="numTorreVisitante" required="required" data-toggle="tooltip" data-placement="bottom" title="Ingrese el número de torre hacia donde se dirige el visitante">
                                        <!--lista desplegable-->
                                        <option value="1">1</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="2">2</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="3">3</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="4">4</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="5">5</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="6">6</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="7">7</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="8">8</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="9">9</option>
                                        <!-- elementos de la lista desplegable-->
                                    </select>
                                </div>
                                <!--Final etiqueta div (funciona para agrupar contenido)-->

                                <div class="col">
                                    <label for="numInteriorVisitante"><i class="fas fa-building"> Interior</i></label>
                                    <!--Nombre del elemento-->
                                    <select class="form-control" id="numInteriorVisitante" name="numInteriorVisitante" required="required" data-toggle="tooltip" data-placement="bottom" title="Ingrese el número de bloque hacia donde se dirige el visitante">
                                        <!--lista desplegable-->
                                        <option value="1">1</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="2">2</option>
                                        <!-- elementos de la lista desplegable-->
                                    </select>
                                </div>
                                <!--Final etiqueta div (funciona para agrupar contenido)-->

                                <div class="col">
                                    <!--Agrega una estructura organizada al formulario-->
                                    <label for="numAptoVisitante"><i class="fas fa-building"> Apartamento</i></label>
                                    <!--Caja de texto en el formulario y su contenido-->
                                    <select class=" form-control" id="numAptoVisitante" name="numAptoVisitante" required="required" data-toggle="tooltip" data-placement="bottom" title="Ingrese el número del apartamento hacia donde se dirige el visitante">
                                        <!--lista desplegable-->
                                        <option value="101">101</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="102">102</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="201">201</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="202">202</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="301">301</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="302">302</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="401">401</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="402">402</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="501">501</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="502">502</option>
                                        <!-- elementos de la lista desplegable-->
                                    </select>
                                </div>
                                <!--Final etiqueta div (funciona para agrupar contenido)-->
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="fechaIngresoVisitante"><i class="fas fa-calendar-alt"> Fecha de ingreso visitante</i></label>
                                    <input type="date" class="form-control" id="fechaIngresoVisitante" name="fechaIngresoVisitante" required="required" data-toggle="tooltip" data-placement="bottom" title="Ingrese la Fecha de ingreso visitante" />
                                </div>

                                <div class="col">
                                    <label for="horaIngresoVisitante"><i class="fas fa-clock"> Hora de ingreso visitante</i></label>
                                    <input type="time" class="form-control" id="horaIngresoVisitante" name="horaIngresoVisitante" required="required" data-toggle="tooltip" data-placement="bottom" title="Ingrese la Hora de ingreso visitante" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="fechaSalidaVisitante"><i class="fas fa-calendar-alt"> Fecha de salida visitante</i></label>
                                    <input type="date" class="form-control" id="fechaSalidaVisitante" name="fechaSalidaVisitante" required="required" data-toggle="tooltip" data-placement="bottom" title="Ingrese la Fecha de salida visitante" />
                                </div>

                                <div class="col">
                                    <label for="horaSalidaVisitante"><i class="fas fa-clock"> Hora de salida visitante</i></label>
                                    <input type="time" class="form-control" id="horaSalidaVisitante" name="horaSalidaVisitante" required="required" data-toggle="tooltip" data-placement="bottom" title="Ingrese la Hora de salida visitante" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="estadoVisitante"><i class="fas fa-toggle-off"> Estado</i></label>
                                <!--Espacio que indica el tipo de documento-->
                                <select class="custom-select form-control" id="estadoVisitante" name="estadoVisitante" required>
                                    <!--Opción de la lista-->
                                    <option value="Activo">Activo</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Inactivo">Inactivo</option>
                                    <!-- elementos de la lista desplegable-->
                                </select>
                                <!--Fin lista desplegable-->
                            </div>

                            <div class="botones">
                                <!--obligar un salto de linea-->
                                <button type="submit" id="btnInsertVisi" name="insertar" value="Registrarme" class="Registar" data-toggle="tooltip" data-placement="bottom" title="Registrar Visitante"><span id="btnText">
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
    <script src="<?php echo SERVERURL; ?>View/Assets/js/functionVisitante.js"></script>

</body>

</html>