<?php

class IndexModel extends gestionCRUD
{
    private $intIdUser;
    private $strcorreoUser;
    private $strpassUser;
    private $intTipoUsu;

    public function __construct()
    {
        parent::__construct();
    }

    public function loginUser(string $usuario, string $password, int $tipoUsu)
    {
        $this->strcorreoUser = $usuario;
        $this->strpassUser = $password;
        $this->intTipoUsu = $tipoUsu;

        if ($tipoUsu == 1) {
            $sql = "SELECT id,nombres, estado, tipoUsuario FROM administrador WHERE correo = '$this->strcorreoUser' and
            passwordU = '$this->strpassUser' and estado != 'Inactivo'";
            $request = $this->select($sql);
        } elseif ($tipoUsu == 2) {
            $sql = "SELECT id, nombres, estado, tipoUsuario FROM residente WHERE correo = '$this->strcorreoUser' and
            passwordU = '$this->strpassUser' and estado != 'Inactivo'";
            $request = $this->select($sql);
        } else {
            $sql = "SELECT id, nombres, estado, tipoUsuario FROM guarda_seguridad WHERE correo = '$this->strcorreoUser' and
            passwordU = '$this->strpassUser' and estado != 'Inactivo'";
            $request = $this->select($sql);
        }

        return $request;
    }
}
