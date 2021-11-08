<?php

$controllerFile = "Controller/" . $controller . ".php";
if (file_exists($controllerFile)) {
    require_once($controllerFile);
    $controller = new $controller();
    if (method_exists($controller, $metodo)) {
        $controller->{$metodo}($parametros);
    } else {
        require_once 'Controller/Errors.php';
    }
} else {
    require_once 'Controller/Errors.php';
}
