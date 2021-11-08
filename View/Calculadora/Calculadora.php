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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
    <!--  extension responsive  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <!--FONT AWESOME-->
    <script src="https://kit.fontawesome.com/c141b4e3ca.js"></script>
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

        <main class="main">
            <div class="calculadora">
                <div class="top-bar"></div>
                <div class="screen">
                    <div class="screen__top" id="screen-operation">0</div>
                    <div class="screen__content" id="screen-result">0</div>
                </div>
                <div class="buttons" id="buttons">
                    <div class="button">C</div>
                    <div class="button">+/-</div>
                    <div class="button">%</div>
                    <div class="button">/</div>
                    <div class="button">7</div>
                    <div class="button">8</div>
                    <div class="button">9</div>
                    <div class="button">*</div>
                    <div class="button">4</div>
                    <div class="button">5</div>
                    <div class="button">6</div>
                    <div class="button">-</div>
                    <div class="button">1</div>
                    <div class="button">2</div>
                    <div class="button">3</div>
                    <div class="button">+</div>
                    <div class="button">0</div>
                    <div class="button">00</div>
                    <div class="button">,</div>
                    <div class="button">=</div>
                </div>
            </div>
        </main>


    </section>

    <!--FOOTER DE LA PÁGINA-->
    <?php
    footerSitio();
    ?>
</body>
<!--SCRIPTS-->

<!--FOOTER DE LA PÁGINA-->
<?php
scriptSitio();
?>

<script src="<?php echo SERVERURL; ?>View/Assets/js/Calculadora.js"></script>

</html>