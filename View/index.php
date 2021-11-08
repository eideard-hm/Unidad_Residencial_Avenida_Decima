<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $data['titulo_pagina']; ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" /><!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" /><!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/css/mdb.min.css" rel="stylesheet" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="https://kit.fontawesome.com/c141b4e3ca.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo SERVERURL; ?>View/Assets/css/Pagina_Inicio.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>View/Assets/css/Modo_oscuro.css">
    <!--SWeet ALERT CSS-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="icon" href="<?php echo SERVERURL; ?>View/Assets/icon/Sin título.ico">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark gris scrolling-navbar fixed-top top-nav-collapse">

        <div class=" container-fluid">

            <a class="navbar-brand" href="#">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/Logo.png" width="50" height="50" class="d-inline-block align-top" alt="" />
                <div class="titulo">Unidad Residencial Avenida Décima</div>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!--
                <a class="navbar-brand" href="#" id="abrir"><i class="fas fa-user-circle"> Iniciar Sesión</i><span class="sr-only">(current)</span></a>
-->
                <a href="#" class="btn_liquido" id="abrir" style="margin: auto">
                    <span><i class="fas fa-user-circle"> Iniciar Sesión</i></span>
                    <span class="liquid"></span>
                </a>

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo SERVERURL; ?>Galeria"><i class="fas fa-images"> Galeria</i><span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a href="https://www.facebook.com/pages/Conjunto-Residencial-Avenida-D%C3%A9cima/729600077407404" class="nav-link"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="https://twitter.com/?lang=es" class="nav-link"><i style="font-size: 20px;" class="fab fa-twitter"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.instagram.com/?hl=es-la" class="nav-link"><i style="font-size: 20px;" class="fab fa-instagram"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.google.com/intl/es/gmail/about/#" class="nav-link"><i style="font-size: 20px;" class="fas fa-envelope"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="miModal" class="modal">
        <div class="flex" id="flex">
            <div class="contenido-modal">
                <div class="modal-header flex">
                    <h1 class="titulo-modal">Iniciar Sesión</h1>
                    <span class="close" id="close">&times;</span>
                </div>
                <div class="contenedor-formulario">
                    <form action="" method="POST" class="formulario form" name="formulario_registro" id="formLogin">
                        <div>
                            <div class="input-group">
                                <input type="email" id="Usuario" name="Usuario" maxlength="50" required />
                                <label class="label" for="correo"><i class="fa fa-envelope-o icon"></i>Correo:</label>
                            </div>

                            <div class="input-group">
                                <input type="password" id="pass" name="Password" required />
                                <label class="label" for="pass"><i class="fa fa-key icon"></i>Contraseña:</label>
                                <span class="eye" onclick="myFunction()">
                                    <i id="hide1" class="fa fa-eye"></i>
                                    <i id="hide2" class="fa fa-eye-slash" id="icono"></i>
                                </span>
                            </div>

                            <div class="group-material">
                                <select class="material-control-login" name="tipoUsuario" id="tipoUsuario" required>
                                    <option value="" disabled="" selected="">Tipo de usuario</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Residente</option>
                                    <option value="3">Guarda de seguridad</option>
                                </select>
                            </div>

                            <button type="submit" name="submit"> Iniciar Sesión<i class="fa fa-chevron-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="particles-js"></div>
    <section>
        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/bg.jpg" id="bg" />
        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/moon5.png" id="luna" />
        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/prueba2.png" id="mountain" />
        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/road2.png" id="carro" />

        <h1 id="titulo">Bienvenidos a</h1>
        <div id="titulo2">
            <h3>Unidad Residencial
                <br> Avenida Décima
            </h3>
        </div>
    </section>

    <div class="slider-1">
        <div class="col-xs-12" style="margin: auto;">
            <div class="content-all" style="z-index:100000;">
                <div class="content-carrousel">
                    <figure>
                        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/3.jpg" />
                    </figure>
                    <figure>
                        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/IMG_20191006_074110.jpg" />
                    </figure>
                    <figure>
                        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI21.jpeg" />
                    </figure>
                    <figure>
                        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/2.jpg" />
                    </figure>
                    <figure>
                        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/IMG_20191006_074135.jpg" />
                    </figure>
                    <figure>
                        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI26.jpeg" />
                    </figure>
                    <figure>
                        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/IMG_20191006_074214.jpg" />
                    </figure>
                    <figure>
                        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/1.jpg" />
                    </figure>
                    <figure>
                        <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/IMG_20191006_074252.jpg" />
                    </figure>
                    <figure>
                </div>
            </div>
            <div class="informacion">
                <p>
                    Somos una unidad de conjuntos residenciales, nuestras instalaciones cómodas, seguras y rodeadas por la
                    naturaleza
                    hacen sentir a los residentes y visitantes “como en casa”. ¿Qué esperas para conocerlo?.
                </p>
            </div>
        </div>
    </div>

    <div class="slider-2">
        <main>
            <h1 class="title">Información Unidad Residencial
                <br>
                Avenida Décima
            </h1>
            <div class="container-box">
                <div class="box box1" id="box1">
                    <img src="<?php echo SERVERURL; ?>View/Assets/icon/admin.png" alt="">
                    <h2>Administrador</h2>
                    <div class="container-p">
                        <p style="font-size: 17px; font-weight: 400">
                            <i class="fas fa-user-shield" style="margin-right: 5px;"></i>Roger Alexander Martínez
                        </p>
                    </div>
                </div>

                <div class="box box2" id="box2">
                    <img src="<?php echo SERVERURL; ?>View/Assets/icon/info.png" alt="">
                    <h2>Información</h2>
                    <div class="container-p">
                        <p style="font-size: 17px; font-weight: 400">
                            <i class="far fa-envelope" style="margin-right: 5px;"></i>administracion@urad.com.co
                            <br>
                            <i class="fas fa-phone-volume" style="margin-right: 5px;"></i>Teléfono (051) 2892471
                        </p>
                    </div>
                </div>

                <div class="box box3" id="box3">
                    <img src="<?php echo SERVERURL; ?>View/Assets/icon/ubicacion.png" alt="">
                    <h2>Ubicación</h2>
                    <div class="container-p">
                        <p style="text-align: center; font-size: 17px; font-weight: 400">
                            <i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i> Nos encontramos ubicados en el barrio Calvo Sur, localidad San Cristóbal (zona suroccidente de Bogotá D.C); en la calle 1c Sur # 8c-27.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="slider-3">
        <iframe src="https://www.google.com/maps/embed?pb=!4v1570648139431!6m8!1m7!1sS495AQrWYwWVCfw7Vt_BMw!2m2!1d4.586817859516219!2d-74.08559026843196!3f218.5532221337926!4f-2.7173332078939154!5f0.7820865974627469 " style="border: 0;" class="mapa"></iframe>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d994.260168385006!2d-74.08542825896373!3d4.586701697455036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f98fd7f799f85%3A0xd8ee8ed24e94a464!2sCl.%201c%20Sur%20%238c-1%2C%20Bogot%C3%A1!5e0!3m2!1ses!2sco!4v1570648930147!5m2!1ses!2sco" style="border: 0;" class="mapa1"></iframe>
    </div>

    <!--Boton de ir hacia arriba-->
    <div id="button-up">
        <i class="fas fa-chevron-up"></i>
    </div>

    <script>
        const base_url = "http://localhost/Unidad_Residencial_Avenida_Decima/";
    </script>

    <!--script para diferentes usos -->
    <!--swicht alert js-->
    <script src="<?php echo SERVERURL; ?>View/Assets/js/particles.js"></script>
    <script src="<?php echo SERVERURL; ?>View/Assets/js/app.js"></script>
    <script src="<?php echo SERVERURL; ?>View/Assets/js/verPassword.js"></script>
    <script src="<?php echo SERVERURL; ?>View/Assets/js/modal.js"></script>

    <!--SCRIPT-->
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="<?php echo SERVERURL; ?>View/Assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo SERVERURL; ?>View/Assets/popper/popper.min.js"></script>
    <script src="<?php echo SERVERURL; ?>View/Assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo SERVERURL; ?>View/Assets/js/function_login.js"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
        let bg = document.getElementById('bg')
        let luna = document.getElementById('luna')
        let mountain = document.getElementById('mountain')
        let carro = document.getElementById('carro')
        let titulo = document.getElementById('titulo')

        window.addEventListener('scroll', function() {
            var value = window.scrollY

            bg.style.top = value * 0.5 + 'px'
            luna.style.left = -value * 0.5 + 'px'
            mountain.style.top = -value * 0.15 + 'px'
            carro.style.top = value * 0.15 + 'px'
            titulo.style.top = value * 1 + 'px'
        })
    </script>

</body>

</html>