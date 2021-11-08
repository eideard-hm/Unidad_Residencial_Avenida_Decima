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
                    <h1>Anuncio</h1>
                    <?php if ($_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>') { ?>
                        <div class="card-body">
                            <span class="btn btn-primary" style="background: blue;" onclick="openModal();">Agregar nuevo Anuncio
                                <span class=" fa fa-plus-circle" style="color: #fff; font-size: 20px;"></span>
                            </span>
                        </div>
                    <?php } ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr class="titulos_encabezados">
                                <th>ID</th>
                                <th>Título</th>
                                <th>Cuerpo</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                            
                        </tbody>
                        <tfoot>
                            <tr class="titulos_encabezados">
                                <th>ID</th>
                                <th>Título</th>
                                <th>Cuerpo</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Imagen</th>
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
    <div class="modal fade" id="agregarAnuncio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Agregar nuevo Anuncio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAnuncio" name="formAnuncio" method="POST" class="needs-validation" novalidate enctype="multipart/form-data" enctype="multipart/form-data">
                        <!--Inicio Formulario-->
                        <h1><span id="btnText">Registrar</span> Anuncio</h1>
                        <!--Título principal-->

                        <div class="text-center">
                            <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/Anuncio.png" />
                        </div>
                        <br />

                        <input type="hidden" id="idAnuncio" name="idAnuncio" value="">

                        <div class="form-group">
                            <!--Agrega una estructura organizada al formulario-->
                            <label for="tituloAnuncio"><i class="fas fa-ad"> Título del anuncio</i></label>
                            <!--Caja de texto en el formulario y su contenido-->
                            <input type="text" id="tituloAnuncio" name="tituloAnuncio" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Título del anuncio" placeholder="Título del Anuncio" maxlength="30" required="required" />
                            <!--Caja de texto en el formulario y su contenido-->

                        </div>
                        <!--Final etiqueta div (funciona para agrupar contenido)-->

                        <div class="form-group">
                            <!--Agrega una estructura organizada al formulario-->
                            <label for="cuerpoAnuncio"><i class="fas fa-ad"> Cuerpo del anuncio</i></label>
                            <!--Caja de texto en el formulario y su contenido-->
                            <textarea name="cuerpoAnuncio" id="cuerpoAnuncio" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Cuerpo del anuncio" placeholder="Ingrese el cuerpo del anuncio" maxlength="200" required="required"></textarea>
                            <!--Usamos textarea para ingresar textos largos, y placeholder como mensaje de inicio-->
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="fechaInicioAnuncio"><i class="fas fa-calendar-alt"> Fecha inicio anuncio</i></label>
                                <!--Caja de texto en el formulario y su contenido-->
                                <input type="date" name="fechaInicioAnuncio" id="fechaInicioAnuncio" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese la Fecha inicio anuncio" required="required" /><!-- El input, como capo de datos, permitirá ingresar la fecha y la hora-->
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fechaFinAnuncio"><i class="fas fa-calendar-times"> Fecha fin anuncio</i></label>
                                <!--Caja de texto en el formulario y su contenido-->
                                <input type="date" name="fechaFinAnuncio" id="fechaFinAnuncio" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese la Fecha fin anuncio" required="required" />
                                <!-- El input, como capo de datos, permitirá ingresar la fecha y la hora-->
                                <!--Final etiqueta div (funciona para agrupar contenido)-->
                            </div>
                        </div>

                        <div class="form-group label">
                            <div class="photo">
                                <label for="imagenAnuncio" class="label">¿Su anuncio contendrá alguna imagen?</label>
                                <!--Caja de texto en el formulario y su contenido-->
                                <div class="prevPhoto">
                                    <span class="delPhoto notBlock">X</span>
                                    <label for="foto"></label>
                                    <div>
                                        <img id="img" src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/upload.png" />
                                    </div>
                                </div>
                                <div class="upimg">
                                    <input type="file" name="imagenAnuncio" id="foto" data-toggle="tooltip" data-placement="bottom" title="Ingresar imagen" multiple="multiple">
                                </div>
                                <div id="form_alert"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="estadoAnuncio"><i class="fas fa-toggle-off"> Estado</i></label>
                            <!--Espacio que indica el tipo de documento-->
                            <select class="custom-select form-control" id="estadoAnuncio" name="estadoAnuncio" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Estado del anuncio" required>
                                <!--Lista para elegir el tipo de documento-->
                                <option selected disabled value="">Estado del anuncio</option>
                                <!--Opción de la lista-->
                                <option value="Activo">Activo</option>
                                <!-- elementos de la lista desplegable-->
                                <option value="Inactivo">Inactivo</option>
                                <!-- elementos de la lista desplegable-->
                            </select>
                        </div>

                        <div class="botones">
                            <br />
                            <!--obligar un salto de linea-->
                            <button type="submit" id="btnInsertAnun" name="insertar" value="Registrarme" class="Registar" data-toggle="tooltip" data-placement="bottom" title="Registrar Anuncio"><span id="btnText">
                                    Registrar</span>&nbsp<i class="far fa-save" style="font-size: 20px;"></i> </button>
                        </div>
                    </form>
                    <!--Fin Formulario-->
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

    <script src="<?php echo SERVERURL; ?>View/Assets/js/functionAnuncio.js"></script>

</body>

</html>