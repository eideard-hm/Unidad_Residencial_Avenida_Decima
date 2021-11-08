<?php
class Principal extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if(empty($_SESSION['login'])){
            header('Location: ' . base_url());
        }
    }

    public function Principal()
    {
        $data['titulo_pagina'] = "Menú | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Principal", $data);
    }
}
