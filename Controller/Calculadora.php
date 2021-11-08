<?php
class Calculadora extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Calculadora()
    {
        $data['titulo_pagina'] = "Calculadora | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Calculadora", $data);
    }
}
