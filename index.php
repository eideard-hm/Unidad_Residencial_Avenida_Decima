<?php

require_once 'Config/config.php';
require_once 'Helpers/Helpers.php';

$url = !empty($_GET['url']) ? $_GET['url'] : 'index';
$arrurl = explode('/', $url);

$controller = $arrurl[0];
$metodo = $arrurl[0];
$parametros = "";

if (!empty($arrurl[1])) {
    if ($arrurl[1] != '') {
        $metodo = $arrurl[1];
    }
}

if (!empty($arrurl[2])) {
    if ($arrurl != '') {
        for ($i = 2; $i < count($arrurl); $i++) {
            $parametros .= $arrurl[$i] . ',';
        }
        $parametros = trim($parametros, ',');
    }
}

//autoload que se encuentra en Libs/Core
require_once 'Libs/Core/Autoload.php';

//cargar

require_once 'Libs/Core/Load.php';