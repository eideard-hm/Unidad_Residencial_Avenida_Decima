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
                    <h1>Residente</h1>
                    <?php if ($_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>') { ?>
                        <div class="card-body">
                            <span class="btn btn-primary" style="color: #fff; background: blue;" onclick="openModal();">
                                Agregar nuevo Residente <span class="fas fa-user-plus" style="font-size: 20px; color: #fff;"></span>
                            </span>
                        </div>
                    <?php } ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr class="titulos_encabezados">
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo Doc</th>
                                <th>N° Doc</th>
                                <th>Teléfono</th>
                                <th>Tel fijo</th>
                                <th>Torre</th>
                                <th>Interior</th>
                                <th>Apto</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr class="titulos_encabezados">
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo Doc</th>
                                <th>N° Doc</th>
                                <th>Teléfono</th>
                                <th>Tel fijo</th>
                                <th>Torre</th>
                                <th>Interior</th>
                                <th>Apto</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="agregarResidente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Agrega nuevo Residente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" id="formResid" name="formResid" class="needs-validation" novalidate>
                                    <!--Inicio formulario-->
                                    <h1><span id="textTittle">Registrar</span> Residente</h1>
                                    <!--Título principal-->

                                    <div class="text-center">
                                        <!--creamos una clase para la imagen-->
                                        <img src="<?php echo SERVERURL; ?>View/Assets/Avatars/residente.png" />
                                        <!--colocar una imagen-->
                                    </div>
                                    <br />

                                    <input type="hidden" id="idResidente" name="idResidente">

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="contraseña"><i class="fas fa-envelope"> Email</i></label>
                                            <!--Caja de texto en el formulario y su contenido-->
                                            <input type="email" class="form-control" id="correoResid" name="correoResid" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Usuario Residente" placeholder="name@example.com" maxlength="50" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese un email.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="contraseña"><i class="fas fa-key"> Contraseña</i></label>
                                            <div class="input-group mb-3">
                                                <!--para agrupar los elementos-->
                                                <input type="password" class="form-control" id="pass" name="passResidente" data-toggle="tooltip" data-placement="bottom" title="Ingrese su contraseña Guarda" placeholder="Ingrese la contraseña" MaxLength="8" required>
                                                <div class="input-group-append">
                                                    <!--espacio para añadir elementos como texto-->
                                                    <span class="eye input-group-text" id="basic-addon2" onclick="myFunction()">
                                                        <i id="hide1" class="fa fa-eye"></i>
                                                        <i id="hide2" class="fa fa-eye-slash" id="icono"></i>
                                                    </span>
                                                    <!--ícono para que el usuario pueda ver o no lo que ha escrito en el campo de contraseña-->
                                                </div>
                                                <small id="passwordHelpBlock" class="form-text text-muted">Su contraseña debe tener máximo 8 caracteres, contener letras y números, y no debe contener espacios, caracteres especiales o emoji.
                                                </small>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese una contraseña válida.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nombreusuario"><i class="fas fa-file-signature"> Nombres</i></label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" data-toggle="tooltip" data-placement="bottom" title="Ingrese los nombres Residente" placeholder="Ingrese sus nombres" maxlength="30" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese sus nombres.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tipousuario"><i class="fas fa-edit"> Apellidos</i></label>
                                            <input type="text" class="form-control" id="apellidos" name="apellidos" data-toggle="tooltip" data-placement="bottom" title="Ingrese los Apellidos Residente" placeholder="Ingrese sus apellidos" maxlength="30" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese sus apellidos.
                                            </div>
                                        </div>
                                    </div>
                                    <!--Final etiqueta div (funciona para agrupar contenido)-->

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tipodocumento"><i class="fas fa-id-card"> Tipo de Documento</i></label>
                                            <select class="custom-select form-control" name="TipoDocumento" id="TipoDocumento" required>
                                                <option selected disabled value="">Elige el tipo de documento</option>
                                                <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                                <option value="Registro civil">Registro civil</option>
                                                <option value="Cédula de extranjería">Cédula de extranjería</option>
                                                <option value="Pasaporte extranjero">Pasaporte extranjero</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor seleccione un tipo de documento válido.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="numeroDocumento"><i class="fas fa-id-card-alt"> Número de documento</i></label>
                                            <input type="tel" class="form-control" id="numDoc" name="numDoc" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Número de documento Residente" placeholder="Ingrese el número de documento" MaxLength="10" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su número de documento.
                                            </div>
                                        </div>
                                    </div>
                                    <!--Final etiqueta div (funciona para agrupar contenido)-->

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="telefono"><i class="fas fa-mobile"> Teléfono</i></label>
                                            <!--Caja de texto en el formulario y su contenido-->
                                            <input type="tel" class="form-control" id="NumTel" name="NumTel" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Número de teléfono Residente" placeholder="Ingrese el número de teléfono" MaxLength="10" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su número de teléfono.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="telefono"><i class="fas fa-phone-volume"> Teléfono fijo</i></label>
                                            <!--Nombre del elemento-->
                                            <input type="tel" class="form-control" id="NumTelFijo" name="NumTelFijo" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Número de teléfono fijo Residente" placeholder="Ingrese el número de teléfono fijo" MaxLength="7" required>
                                            <!--crar un caja de texto-->
                                            <div class="invalid-feedback">
                                                Por favor ingrese su número de teléfono fijo.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <!--Agrega una estructura organizada al formulario-->
                                            <label for="numTorreResid"><i class="fas fa-building"> Número Torre</i></label>
                                            <!--Caja de texto en el formulario y su contenido-->
                                            <select name="numTorre" id="numTorre" class="custom-select form-control" data-toggle="tooltip" data-placement="bottom" title="Elija el número de la torre donde habita" required>
                                                <option selected disabled value="">Elija el número de la torre donde habita</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor seleccione el número de la torre donde habita.
                                            </div>
                                        </div>
                                        <!--Final etiqueta div (funciona para agrupar contenido)-->

                                        <div class="col">
                                            <label for="numInteriorResid"><i class="fas fa-building"> Número Interior</i></label>
                                            <!--Nombre del elemento-->
                                            <select name="numInterior" id="numInterior" class="custom-select form-control" data-toggle="tooltip" data-placement="bottom" title="Elija el número del interior donde habita" required>
                                                <option selected disabled value="">Elija el número del interior donde habita</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor seleccione el número del interior de la torre donde habita.
                                            </div>
                                        </div>
                                        <!--Final etiqueta div (funciona para agrupar contenido)-->

                                        <div class="col">
                                            <!--Agrega una estructura organizada al formulario-->
                                            <label for="numApartamentoResid"><i class="fas fa-building"> Número Apartamento</i></label>
                                            <!--Caja de texto en el formulario y su contenido-->
                                            <select name="numApartamento" id="numApartamento" class="custom-select form-control" data-toggle="tooltip" data-placement="bottom" title="Elija el número del apartamento donde habita" required>
                                                <option selected disabled value="">Elija el número del apartamento donde habita</option>
                                                <option value="101">101</option>
                                                <option value="102">102</option>
                                                <option value="201">201</option>
                                                <option value="202">202</option>
                                                <option value="301">301</option>
                                                <option value="302">302</option>
                                                <option value="401">401</option>
                                                <option value="402">402</option>
                                                <option value="501">501</option>
                                                <option value="502">502</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor seleccione el número de apartamento donde habita.
                                            </div>
                                        </div>
                                    </div>

                                    <!--para agrupar los elementos-->
                                    <label for="estadoResidente"><i class="fas fa-toggle-off"> Estado</i></label>
                                    <select class="custom-select form-control" id="estadoResidente" name="estadoResidente" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Estado del residente" required="required">
                                        <!--Lista para elegir el tipo de documento-->
                                        <option selected disabled value="">Elige su estado residente</option>
                                        <!--lista desplegable-->
                                        <option>Activo</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option>Inactivo</option>
                                        <!-- elementos de la lista desplegable-->
                                    </select>
                                    <!--Fin lista desplegable-->
                                    <div class="invalid-feedback">
                                        Por favor seleccione un estado de documento válido.
                                    </div>

                                    <select name="tipousuario" id="tipousuario" class="custom-select form-control" hidden>
                                        <option value="2">2</option>
                                    </select>

                                    <div class="botones">
                                        <br />
                                        <!--obligar un salto de linea-->
                                        <button type="submit" id="btnInsertResid" name="insertar" value="Registrarme" class="Registar" data-toggle="tooltip" data-placement="bottom" title="Registrar Residente"><span id="btnText">
                                                Registrar</span>&nbsp<i class="far fa-save" style="font-size: 20px;"></i> </button>
                                    </div>
                                </form>
                                <!--Fin de formulario-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar &nbsp<i class="fas fa-window-close" style="font-size: 20px; background: red;"></i></button>
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
    <script src="<?php echo SERVERURL; ?>View/Assets/js/functionResidente.js"></script>
</body>

</html>