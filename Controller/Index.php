<?php
class Index extends Controller
{
    public function __construct()
    {
        session_start();
        //isset : verifica que la varible de sesion si exista
        if (isset($_SESSION['login'])) {
            header('Location: ' . base_url() . 'Principal');
        }
        parent::__construct();
    }

    public function index()
    {
        $data['titulo_pagina'] = "Inicio | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "index", $data);
    }

    public function loginUser()
    {
        if ($_POST) {
            if (empty($_POST['Usuario']) || empty($_POST['Password']) || empty($_POST['tipoUsuario'])) {
                $arrResponse = array('estadoAdministrador' => false, 'msg' => 'Error de datos.');
            } else {
                $strUsuario = strtolower(limpiarCadena($_POST['Usuario'])); //convertir todas las letras en minusculas
                $strPassword =  $_POST['Password'];
                $strPassword = hash("SHA256", $_POST['Password']);
                $intTipoUsu = limpiarCadena($_POST['tipoUsuario']);
                $requestUser = $this->model->loginUser($strUsuario, $strPassword, $intTipoUsu);

                if (empty($requestUser)) {
                    $arrResponse = array('estadoAdministrador' => false, 'msg' => 'El email o la contraseña son incorrectos. Intente nuevamente !!');
                } else {
                    $arrData = $requestUser;
                    if ($arrData['estado'] == 'Activo') {
                        $_SESSION['id'] = $arrData['id'];
                        $_SESSION['nombres'] = $arrData['nombres'];
                        $_SESSION['tipoUser'] = $arrData['tipoUsuario'];
                        if ($_SESSION['tipoUser'] == 1) {
                            $_SESSION['tipoUser'] =
                                '<span class="badge badge-success">Administrador</span>';
                        } elseif ($_SESSION['tipoUser'] == 2) {
                            $_SESSION['tipoUser'] = '<span class="badge badge-warning">Residente</span>';
                        } else {
                            $_SESSION['tipoUser'] = '<span class="badge badge-info">Guarda seguridad</span>';
                        }

                        $_SESSION['login'] = true;


                        $arrResponse = array('estadoAdministrador' => true, 'msg' => 'ok');
                    } else {
                        $arrResponse = array('estadoAdministrador' => false, 'msg' => 'El usuario se encuentra inhabilitado!.');
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
