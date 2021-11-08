<?php
class Galeria extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Galeria()
    {
        $data['titulo_pagina'] = "Galeria de Imágenes | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Galeria", $data);
    }
}
