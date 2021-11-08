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
                    <h1>Parqueadero</h1>
                    <?php if ($_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>') { ?>
                        <div class="card-body">
                            <span class="btn btn-primary" style="background: blue;" onclick="openModal();">Agregar nuevo Parqueadero
                                <span class="fa fa-plus-circle" style="color: #fff; font-size: 20px;"></span>
                            </span>
                        </div>
                    <?php } ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr class="titulos_encabezados">
                                <th>ID</th>
                                <th>Uso P.</th>
                                <th>Estado P.</th>
                                <th>Tipo P.</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr class="titulos_encabezados">
                                <th>ID</th>
                                <th>Uso P.</th>
                                <th>Estado P.</th>
                                <th>Tipo P.</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="agregarParqueadero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Agregar nuevo Parqueadero</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formParq" name="formParq" class="needs-validation" novalidate enctype="multipart/form-data">
                            <!--Inicio formulario-->
                            <h1><span id="textTittle">Registro</span> Parqueadero</h1>
                            <!--Título principal-->

                            <div class="text-center">
                                <!--creamos una clase para la imagen-->
                                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/parqueadero_4.png" />
                                <!--colocar una imagen-->
                            </div>
                            <br />

                            <input type="hidden" id="idParqueadero" name="idParqueadero" value="">

                            <div class="row">
                                <div class="col">
                                    <!--para agrupar los elementos-->
                                    <label for="usuParqueadero"><i class="fas fa-car"> Uso parqueadero</i></label>
                                    <select class=" form-control" id="usuParqueadero" name="usuParqueadero" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Uso parqueadero" required="required">
                                        <!--lista desplegable-->
                                        <option value="Moto">Moto</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="Carro">Carro</option>
                                        <!-- elementos de la lista desplegable-->
                                    </select>
                                </div>
                                <!--Final etiqueta div (funciona para agrupar contenido)-->

                                <div class="col">
                                    <!--para agrupar los elementos-->
                                    <label for="estadoParquadero"><i class="fas fa-warehouse"> Estado parqueadero</i></label>
                                    <select class=" form-control" id="estadoParquadero" name="estadoParquadero" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Estado del parqueadero" required="required">
                                        <!--lista desplegable-->
                                        <option value="Disponible">Disponible</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="Ocupado">Ocupado</option>
                                        <!-- elementos de la lista desplegable-->
                                        <option value="Mantenimiento">Mantenimiento</option>
                                        <!-- elementos de la lista desplegable-->
                                    </select>
                                </div>
                                <!--Final etiqueta div (funciona para agrupar contenido)-->
                            </div>

                            <div class="form-group">
                                <!--para agrupar los elementos-->
                                <label for="tipoParquadero"><i class="fas fa-car-bus"> Tipo parqueadero</i></label>
                                <select class=" form-control" id="tipoParquadero" name="tipoParquadero" data-toggle="tooltip" data-placement="bottom" title="Ingrese el tipo de parqueadero" required="required">
                                    <!--lista desplegable-->
                                    <option value="Comunitario">Comunitario</option>
                                    <!-- elementos de la lista desplegable-->
                                    <option value="Privado">Privado</option>
                                    <!-- elementos de la lista desplegable-->
                                </select>
                            </div>
                            <!--Final etiqueta div (funciona para agrupar contenido)-->

                            <div class="botones">
                                <br />
                                <!--obligar un salto de linea-->
                                <button type="submit" id="btnInsertParq" name="insertar" value="Registrarme" class="Registar" data-toggle="tooltip" data-placement="bottom" title="Registrar Parquadero"><span id="btnText">
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
    <script src="<?php echo SERVERURL; ?>View/Assets/js/functionParqueadero.js"></script>

</body>

</html>