<?php

class Cerrar_sesion
{
    public function __construct()
    {
        session_start(); //inicializamos las sesiones
        session_unset(); //limpiamos todas las variables de sesión
        session_destroy(); //destruimos todas sesiones

        header('Location: ' . base_url());
    }
}
