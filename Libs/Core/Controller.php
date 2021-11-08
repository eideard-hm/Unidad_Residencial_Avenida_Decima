<?php

class Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->cargarModel();
    }

    public function cargarModel()
    {
        $model = get_class($this) . "Model";
        $rutaClase = "Model/" . $model . ".php";

        if (file_exists($rutaClase)) {
            require_once($rutaClase);
            $this->model = new $model;
        }
    }
}
