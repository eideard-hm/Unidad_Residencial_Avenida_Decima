<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <title><?php echo $data['titulo_pagina']; ?></title>
    <!--titulo del sitio web-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" /><!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" /><!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/css/mdb.min.css" rel="stylesheet" />
    <!--CDN (Content Delivery Network)-->
    <script src="https://kit.fontawesome.com/4323dfb580.js"></script>
    <!--Para utlizar los iconos de fot awesome-->

    <link rel="stylesheet" href="<?php echo SERVERURL; ?>View/Assets/css/Pagina_Inicio.css">
    <link rel="icon" href="<?php echo SERVERURL; ?>View/Assets/icon/Sin título.ico">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark gris scrolling-navbar fixed-top top-nav-collapse">

        <a href="javascript:window.history.back();"><i style="font-size: 20px; color: #fff;" class="fa fa-chevron-circle-left">Atrás</i></a>

        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/Logo.png" width="50" height="50" class="d-inline-block align-top" alt="" />
                <div class="titulo">Unidad Residencial Avenida Décima</div>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <a class="nav-link" href="javascript:window.history.back();"><i style="font-size: 20px; color: #fff;" class="fas fa-home"> Página de inicio</i> <span class="sr-only">(current)</span></a>
                <!--
                <a class="navbar-brand" href="#" id="abrir"><i class="fas fa-user-circle"> Iniciar Sesión</i><span class="sr-only">(current)</span></a>
-->
                <a href="#" class="btn_liquido" id="abrir" style="margin: auto">
                    <span><i class="fas fa-user-circle"> Iniciar Sesión</i></span>
                    <span class="liquid"></span>
                </a>

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item active align-content-center">

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

    <div class="galeria">
        <h1 class="titulo-galeria">Galeria</h1>
        <div class="linea"></div>
        <div class="contenedor-imagenes">
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI1.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI10.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI11.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI12.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI13.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI14.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI15.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI16.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI17.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI18.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI19.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI2.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI20.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI21.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI22.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI23.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI24.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI25.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI26.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI27.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI28.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI29.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI3.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI30.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI31.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
            <div class="imagen">
                <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/WI32.jpeg" />
                <div class="overlay">
                    <h2>Conocenos</h2>
                </div>
            </div>
        </div>
    </div>

    <!--Boton de ir hacia arriba-->
    <div id="button-up">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--FOOTER DE LA PÁGINA-->
    <footer id="footer">
        <div id="empresa">
            <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/sohe.png">
            <p>Todos los derechos reservados la empresa Sohe Innovation Software S.A.S &copy; <?= date('Y') ?></p>
        </div>
    </footer>

    <script>
        const base_url = "http://localhost/Unidad_Residencial_Avenida_Decima/";
    </script>

    <script src="<?php echo SERVERURL; ?>View/Assets/js/modal.js"></script>
    <script src="<?php echo SERVERURL; ?>View/Assets/js/Login.js"></script>
    <script src="<?php echo SERVERURL; ?>View/Assets/js/verPassword.js"></script>

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/js/mdb.min.js"></script>

    <script src="<?php echo SERVERURL; ?>View/Assets/js/function_login.js"></script>

</body>

</html>