<header id="header_nav" style="z-index: 100">
  <div id="nav_header">
    <div class="logo_titulo">
      <span id="button-menu" class="fa fa-bars"></span>
      <img src="<?php echo SERVERURL; ?>View/Assets/Img/Imagenes/Logo.png" alt="Logotipo del conjunto residencial" />
      <a href="#" class="nombre_conjunto">Unidad Residencial Avenida Décima</a>
    </div>

    <nav id="nav">
      <a href="<?= base_url(); ?>Cerrar_sesion" class="btn-exit-system"><i class="fas fa-sign-out-alt icon-menu"></i> Salir</a>
    </nav>
  </div>

  <!--ASIDE DE LA PAGINA PRINCIPAL CON LAS OPCIONES-->

  <nav class="navegacion">
    <ul class="menu">
      <!-- TITULAR -->
      <li class="user">
        <i class="far fa-user-circle icon-menu icon_usu"></i>
        <span>
          <small>Bienvenid@
            <spam class="bienvenida-usuario"><b><?php echo $_SESSION['nombres'] . " | " . $_SESSION['tipoUser'] ?></b></spam></small>
        </span>
      </li>
      <!-- TITULAR -->
      <li class="item-submenu" menu="1">
        <a href="#"><i class="fas fa-users icon-menu"></i>Usuarios</a>
        <ul class="submenu">
          <li class="title-menu">
            <span class="fa fa-suitcase icon-menu"> Procesos</span>
          </li>
          <li class="go-back">Atras</li>

          <li>
            <a href="<?php echo SERVERURL; ?>Administrador"><i class="fas fa-user-shield icon-menu"></i> Administrador</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL; ?>Residente"><i class="fas fa-restroom icon-menu"></i> Residente</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL; ?>Guarda_seguridad"><i class="fas fa-user-nurse icon-menu"></i> Guarda de
              seguridad</a>
          </li>
        </ul>
      </li>

      <?php if (
        $_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>' ||
        $_SESSION['tipoUser'] == '<span class="badge badge-warning">Residente</span>'
      ) { ?>
        <li class="item-submenu" menu="3">
          <a href="#"><i class="fas fa-file-invoice-dollar icon-menu"></i> Cuenta de
            cobro</a>
          <ul class="submenu">
            <li class="title-menu">
              <span class="fa fa-suitcase icon-menu"> Procesos</span>
            </li>
            <li class="go-back">Atras</li>
            <li>
              <a href="<?php echo SERVERURL; ?>Cuenta_cobro"><i class="fas fa-search"></i> Consultar Cuenta de Cobro</a>
            </li>
          </ul>
        </li>

        <li class="item-submenu" menu="9">
          <a href="#"><i class="fas fa-money-bill-alt icon-menu"></i>Rubro</a>
          <ul class="submenu">
            <li class="title-menu">
              <span class="fa fa-suitcase icon-menu"> Procesos</span>
            </li>
            <li class="go-back">Atras</li>
            <li>
              <a href="<?php echo SERVERURL; ?>Rubro"><i class="fas fa-search icon-menu"></i> Consultar Rubro</a>
            </li>
          </ul>
        </li>
      <?php } ?>

      <li class="item-submenu" menu="5">
        <a href="#"><i class="fas fa-people-carry icon-menu"></i>Empleado</a>
        <ul class="submenu">
          <li class="title-menu">
            <span class="fa fa-suitcase icon-menu"> Procesos</span>
          </li>
          <li class="go-back">Atras</li>
          <li>
            <a href="<?php echo SERVERURL; ?>Empleado"><i class="fas fa-search icon-menu"></i> Consultar Empleado</a>
          </li>
        </ul>
      </li>

      <li class="item-submenu" menu="7">
        <a href="#"><i class="fas fa-car icon-menu"></i>Vehículo</a>
        <ul class="submenu">
          <li class="title-menu">
            <span class="fa fa-suitcase icon-menu"> Procesos</span>
          </li>
          <li class="go-back">Atras</li>
          <li>
            <a href="<?php echo SERVERURL; ?>Vehiculo"><i class="fas fa-search icon-menu"></i> Consultar Vehículo</a>
          </li>
        </ul>
      </li>

      <li class="item-submenu" menu="6">
        <a href="#"><i class="fas fa-parking icon-menu"></i> Parqueadero</a>
        <ul class="submenu">
          <li class="title-menu">
            <span class="fa fa-suitcase icon-menu"> Procesos</span>
          </li>
          <li class="go-back">Atras</li>
          <li>
            <a href="<?php echo SERVERURL; ?>Parqueadero"><i class="fas fa-search icon-menu"></i> Consultar Parqueadero</a>
          </li>
        </ul>
      </li>

      <li class="item-submenu" menu="4">
        <a href="#"><i class="fas fa-ad icon-menu"></i>Anuncio</a>
        <ul class="submenu">
          <li class="title-menu">
            <span class="fa fa-suitcase icon-menu"> Procesos</span>
          </li>
          <li class="go-back">Atras</li>
          <li>
            <a href="<?php echo SERVERURL; ?>Anuncio"><i class="fas fa-search"></i> Consultar Anuncio</a>
          </li>
        </ul>
      </li>

      <li class="item-submenu" menu="8">
        <a href="#"><i class="fas fa-running icon-menu"></i>Visitante</a>
        <ul class="submenu">
          <li class="title-menu">
            <span class="fa fa-suitcase icon-menu"> Procesos</span>
          </li>
          <li class="go-back">Atras</li>
          <li>
            <a href="<?php echo SERVERURL; ?>Visitante"><i class="fas fa-search icon-menu"></i> Consultar Visitante</a>
          </li>
        </ul>
      </li>

    </ul>
  </nav>
</header>

<!--BARRA DEBAJO DEL NAV-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar_segundario">
  <a class="navbar-brand nombre_conjunto" href="#">Unidad Residencial Avenida Décima</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="navbar-brand" href="Calculadora" style="font-family: 'Roboto'; font-weight: 400;"><i style="font-size: 20px;" data-toggle="tooltip" data-placement="bottom" title="Calculadora" class="fas fa-calculator icon-menu"></i> Calculadora<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <!--Mostar el nombre del usuario-->

    <div class="bienvenida_usuario">
      <a href="#" class="nombre_usuario">
        <i class="far fa-user-circle icon-menu"></i>
        <small>Bienvenid@
          <spam class="bienvenida-usuario"><b><?php echo $_SESSION['nombres'] . " | " .  $_SESSION['tipoUser'] ?></b></spam></small>
      </a>
    </div>


    <button class="switch" id="switch">
      <!--Tipo de botón para arrastrar de un lado a otro-->
      <span><i class="fas fa-sun"></i></span>
      <!--ícono del sol (representa modo normal)-->
      <span><i class="fas fa-moon"></i></span>
      <!--ícono de la luna(representa modo noche)-->
    </button>
    <!--Fin de botón-->
  </div>
</nav>