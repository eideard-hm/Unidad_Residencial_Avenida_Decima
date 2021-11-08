<?php

//retorna la url del proyecto
function base_url()
{
    return SERVERURL;
}

//funcion para integrar modulos del sitio web
function asidePrincipal($data = "")
{
    $viewAside = "View/Modules/Aside_Pagina_Principal.php";
    require_once($viewAside);
}

function scriptSitio($data = "")
{
    $viewScripts = "View/Modules/scripts.php";
    require_once($viewScripts);
}


function footerSitio($data = "")
{
    $viewFooter = "View/Modules/footer.php";
    require_once($viewFooter);
}

function estilos($data = "")
{
    $viewEstilos = "View/Modules/hojasEstilo.php";
    require_once($viewEstilos);
}

//limpar las cadenas de texto para evitar inyecciones sql
function limpiarCadena($strCadena)
{
    $cadena = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena); //limpiar el exceso de espacios
    $cadena = trim($cadena); //eliminar espacios al inicio y al final de la cande de texto
    $cadena = stripslashes($cadena); //eliminar eslasches hacia atras \
    $cadena = str_ireplace("<script>", "", $cadena); //reemplazar el el valor del script
    $cadena = str_ireplace("</script>", "", $cadena); //reemplazar el el valor del script
    $cadena = str_ireplace("<script src", "", $cadena); //reemplazar el el valor del script
    $cadena = str_ireplace("<script type=", "", $cadena); //reemplazar el el valor del script
    //limipar las consultas SQL
    $cadena = str_ireplace("SELECT * FROM", "", $cadena); //limpiar el tipo de consulta
    $cadena = str_ireplace("DELETE FROM", "", $cadena); //limpiar el tipo de consulta
    $cadena = str_ireplace("INSERT INTO", "", $cadena); //limpiar el tipo de consulta
    $cadena = str_ireplace("UPDATE SET", "", $cadena); //limpiar el tipo de consulta

    $cadena = str_ireplace("--", "", $cadena); //no queremos qie ingresen dobles guiones
    $cadena = str_ireplace("^", "", $cadena); //no queremos que ingresen el sibolo de exponente
    $cadena = str_ireplace("[", "", $cadena); //no queremos que ingresen corchetes
    $cadena = str_ireplace("]", "", $cadena); //no queremos que ingresen corchetes
    $cadena = str_ireplace("==", "", $cadena); //no queremos que ingresen dobles iguales
    $cadena = str_ireplace(";", "", $cadena); //no queremos que ingresen punto y coma
    return $cadena;
}

//funcion para generar contraseñas de 8 caracteres
function generarPass($longitud = 8)
{
    $pass = "";
    $longitudPass = $longitud;
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena = strlen($cadena);

    for ($i = 1; $i <= $longitudPass; $i++) {
        $pos = rand(0, $longitudCadena - 1);
        $pass = substr($cadena, $pos, 1);
    }
    return $pass;
}

//funcion para generar token
function token()
{
    $r1 = bin2hex(random_bytes(10));
    $r2 = bin2hex(random_bytes(10));
    $r3 = bin2hex(random_bytes(10));
    $r4 = bin2hex(random_bytes(10));
    $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
    return $token;
}

//funcion para darle formato a los valores monetarios

function formatearMoney($cantidad)
{
    $cantidad = number_format($cantidad, 2, SPD, SPM);
    return $cantidad;
}
