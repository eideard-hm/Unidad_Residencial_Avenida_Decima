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
            <h1>Guarda de seguridad</h1>
            <div class="card-body">
                <span class="btn btn-primary" style="background: blue;" onclick="openModal();">Agregar nuevo Guarda de seguridad
                    <span class="fas fa-user-plus" style="color: #fff; font-size: 20px;"></span>
                </span>
            </div>
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
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="agregarGuarda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Agrega nuevo Guarda de seguridad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formGuarda" name="formGuarda" class="needs-validation" novalidate>
                            <!--Inicio formulario-->
                            <h1><span id="textTittle">Registrar</span> Guarda de seguridad</h1>
                            <!--Título principal-->

                            <div class="text-center">
                                <!--creamos una clase para la imagen-->
                                <img src="<?php echo SERVERURL; ?>View/Assets/Avatars/guarda_seguridad.png" />
                                <!--colocar una imagen-->
                            </div>
                            <br />

                            <input type="hidden" id="idGuarda" name="idGuarda">

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="email"><i class="fas fa-envelope"> Email</i></label>
                                    <input type="email" class="form-control" id="correoGuarda" name="correoGuarda" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Usuario Guarda de seguridad" placeholder="name@example.com" maxlength="50" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese un dirección de email válido.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contraseña"><i class="fas fa-key"> Contraseña</i></label>
                                    <div class="input-group mb-3">
                                        <!--para agrupar los elementos-->
                                        <input type="password" class="form-control" id="pass" name="passGuarda" data-toggle="tooltip" data-placement="bottom" title="Ingrese su contraseña Guarda" placeholder="Ingrese la contraseña" MaxLength="8" required>
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
                                    <label for="nombreguarda"><i class="fas fa-file-signature"> Nombres</i></label>
                                    <input type="text" class="form-control" id="nombreGuarda" name="nombreGuarda" data-toggle="tooltip" data-placement="bottom" title="Ingrese los nombres" placeholder="Ingrese sus nombres Guarda" maxlength="30" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese sus nombres.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="apellidoguarda"><i class="fas fa-edit"> Apellidos</i></label>
                                    <input type="text" class="form-control" id="apellidosGuarda" name="apellidosGuarda" data-toggle="tooltip" data-placement="bottom" title="Ingrese los Apellidos Guarda" placeholder="Ingrese sus apellidos" maxlength="30" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese sus apellidos.
                                    </div>
                                </div>
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="tipodocumento"><i class="fas fa-id-card"> Tipo de Documento</i></label>
                                    <select class="custom-select" name="TipoDocumentoGuarda" id="TipoDocumentoGuarda" required>
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
                                    <label for="numeroDocumento"><i class="fas fa-edit"> Número de documento</i></label>
                                    <input type="tel" class="form-control" id="numDocGuarda" name="numDocGuarda" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Número de documento Guarda" placeholder="Ingrese el número de documento" MaxLength="10" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese su número de documento.
                                    </div>
                                </div>
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->

                            <div class="form-group">
                                <!--Agrega una estructura organizada al formulario-->
                                <label for="telefono"><i class="fas fa-mobile"> Teléfono</i></label>
                                <!--Caja de texto en el formulario y su contenido-->
                                <input type="tel" class="form-control" id="NumTelGuarda" name="NumTelGuarda" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Número de teléfono" placeholder="Ingrese el número de teléfono" MaxLength="10" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese su número de teléfono.
                                </div>
                            </div>

                            <!--para agrupar los elementos-->
                            <label for="estadoParquadero"><i class="fas fa-toggle-off"> Estado</i></label>
                            <select class="custom-select form-control" id="estadoGuarda" name="estadoGuarda" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Estado del guarda" required="required">
                                <!--Lista para elegir el tipo de documento-->
                                <option selected disabled value="">Elige su estado guarda</option>
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
                                <option value="3">3</option>
                            </select>

                            <div class="botones">
                                <br />
                                <!--obligar un salto de linea-->
                                <button type="submit" id="btnInsertGuarda" name="insertar" value="Registrarme" class="Registar" data-toggle="tooltip" data-placement="bottom" title="Registrar Guarda de seguridad"><span id="btnText">
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
    <script src="<?php echo SERVERURL; ?>View/Assets/js/functionGuarda.js"></script>
</body>

</html>