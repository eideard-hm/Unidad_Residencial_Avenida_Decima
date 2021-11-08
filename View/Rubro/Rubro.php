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
            <h1>Rubro</h1>
            <div class="card-body">
                <span class="btn btn-primary" style="background: blue;" onclick="openModal()">Agregar nuevo Rubro
                    <span class="fa fa-plus-circle" style="color: #fff; font-size: 20px;"></span>
                </span>
            </div>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr class="titulos_encabezados">
                        <th>ID R.</th>
                        <th>Nombre R.</th>
                        <th>Descripción R.</th>
                        <th>Valor R.</th>
                        <th>Estado R.</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr class="titulos_encabezados">
                        <th>ID R.</th>
                        <th>Nombre R.</th>
                        <th>Descripción R.</th>
                        <th>Valor R.</th>
                        <th>Estado R.</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="agregarRubro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Agregar nuevo Rubro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formRubro" name="formRubro" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        <!--Inicio formulario-->
                        <h1><span id="textTittle">Registro</span> Rubro</h1>
                        <!--Título principal-->
                        <!--Título principal-->

                        <div class="text-center">
                            <!--creamos una clase para la imagen-->
                            <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/rubro.png" />
                            <!--colocar una imagen-->
                        </div>
                        <br />

                        <input type="hidden" id="idRubro" name="idRubro" value="">

                        <div class="form-group">
                            <!--Agrega una estructura organizada al formulario-->
                            <label for="nombreRubro"><i class="fas fa-file-signature"> Nombre Rubro</i></label>
                            <!--Caja de texto en el formulario y su contenido-->
                            <input type="text" id="nombreRubro" name="nombreRubro" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese el nombre del Rubro" placeholder="Ingrese el nombre del Rubro" required="required" maxlength="30" />
                            <!--Damos la opción de ingresar los datos-->
                        </div>

                        <div class="form-group">
                            <!--Agrega una estructura organizada al formulario-->
                            <label for="descripcionRubro"><i class="fas fa-edit"> Descripción del Rubro</i></label>
                            <!--Caja de texto en el formulario y su contenido-->
                            <textarea name="descripcionRubro" id="descripcionRubro" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ingrese la descripción del rubro" placeholder="Ingrese la descripción del rubro" required="required" maxlength="200"></textarea>
                            <!--Usamos textarea para ingresar textos largos, y placeholder como mensaje de inicio-->
                        </div>

                        <div class="form-group">
                            <!--para agrupar los elementos-->
                            <label for="valorRubro"><i class="fas fa-dollar-sign"> Valor del Rubro</i></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="text" name="valorRubro" class="form-control valor-rubro" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Valor pago cuenta" id="inlineFormInputGroup" placeholder="Ejm: 12345.567" maxlength="20" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="estadoRubro"><i class="fas fa-toggle-off"> Estado</i></label>
                            <!--Espacio que indica el tipo de documento-->
                            <select class="custom-select form-control" id="estadoRubro" name="estadoRubro" data-toggle="tooltip" data-placement="bottom" title="Ingrese el Estado del administrador" required>
                                <!--Lista para elegir el tipo de documento-->
                                <option selected disabled value="">Elige el estado del rubro</option>
                                <!--Opción de la lista-->
                                <option>Activo</option>
                                <!-- elementos de la lista desplegable-->
                                <option>Inactivo</option>
                                <!-- elementos de la lista desplegable-->
                            </select>
                            <!--Fin lista desplegable-->
                        </div>

                        <div class="botones">
                            <br />
                            <!--obligar un salto de linea-->
                            <button type="submit" id="btnInsertRubro" name="insertar" value="Registrarme" class="Registar" data-toggle="tooltip" data-placement="bottom" title="Registrar Administrador"><span id="btnText">
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

    <!--FOOTER DE LA PÁGINA-->
    <?php
    footerSitio();
    ?>

    <!--SCRIPTS-->
    <?php
    scriptSitio();
    ?>

    <script src="<?php echo SERVERURL; ?>View/Assets/js/functionRubro.js"></script>
</body>


</html>