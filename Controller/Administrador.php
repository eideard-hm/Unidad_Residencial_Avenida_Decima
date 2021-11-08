<?php
class Administrador extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Administrador()
    {
        $data['titulo_pagina'] = "Administrador | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Administrador", $data);
    }

    //método para insertar los administradores
    public function setAdmin()
    {
        if ($_POST) {

            //verificar que ningun campo este vació
            if (
                empty($_POST['correoAdmin']) || empty($_POST['contraseñaAdmin']) || empty($_POST['nombreAdmin'])
                || empty($_POST['apellidosAdmin']) || empty($_POST['TipoDocumentoAdmin']) || empty($_POST['numDocAdmin'])
                || empty($_POST['NumTelAdmin']) || empty($_POST['estadoAdmin'])
            ) {
                $arrResponse = array("estadoAdministrador" => false, "msg" => "Los datos ingresado son incorrectos :(");
            } else {
                $intIdAdmin = intval($_POST['idAdmin']);
                $strEmail = strtolower(limpiarCadena($_POST['correoAdmin'])); //strtolower(convertir todos las letras en minusculas)
                $strPass = limpiarCadena($_POST['contraseñaAdmin']);
                $strNombres = ucwords(limpiarCadena($_POST['nombreAdmin']));
                $strApellidos = ucwords(limpiarCadena($_POST['apellidosAdmin'])); //ucwords (convierte las inciales de cada palabra en mayusculs)
                $strTipoDoc = limpiarCadena($_POST['TipoDocumentoAdmin']);
                $strNumDoc = intval($_POST['numDocAdmin']); //intval (convierte todos los valores en enteros)
                $strTel = intval($_POST['NumTelAdmin']); //intval (convierte todos los valores en enteros)
                $strEstado = limpiarCadena($_POST['estadoAdmin']);
                $strTipoUsu = limpiarCadena($_POST['tipousuario']);

                //método par actualizar e insertar
                if ($intIdAdmin == 0) {
                    /*-----------------INSERTAR ADMINISTRADOR ---------------*/
                    $option = 1;
                    //encriptar las contraseñas
                    // $strPass = hash("SHA256", $_POST['contraseñaAdmin']);
                    //INSERTAR LOS DATOS EN EL MODELO DEL ADMINISTRADOR
                    $request_admin = $this->model->insertAdmin(                        
                        $strEmail,
                        $strPass,
                        $strNombres,
                        $strApellidos,
                        $strTipoDoc,
                        $strNumDoc,
                        $strTel,
                        $strEstado,
                        $strTipoUsu
                    );
                } else {
                    /*-----------------------------ACTUALIZAR ADMINISTRADOR---------- */
                    $option = 2;
                    //encriptar las contraseñas
                    $strPass = hash("SHA256", $_POST['contraseñaAdmin']);
                    //INSERTAR LOS DATOS EN EL MODELO DEL ADMINISTRADOR
                    $request_admin = $this->model->updateAdmin(
                        $intIdAdmin,
                        $strEmail,
                        $strPass,
                        $strNombres,
                        $strApellidos,
                        $strTipoDoc,
                        $strNumDoc,
                        $strTel,
                        $strEstado,                       
                    );
                }

                //evaluar si la respuesta es mayor a cero, quiero decir que si se inserto
                if ($request_admin > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estadoAdministrador' => true, 'msg' => 'Datos almacenados correctamente :)');
                    } elseif ($option == 2) {
                        $arrResponse = array('estadoAdministrador' => true, 'msg' => 'Datos actualizados correctamente :)');
                    }
                } elseif ($request_admin == 'exits') {
                    $arrResponse = array('estadoAdministrador' => false, 'msg' => '!Atención! el email o la identificación ya existen. Intenta con otro');
                } else {
                    $arrResponse = array('estadoAdministrador' => false, 'msg' => 'No es posible almacenar los datos :(');
                }
            }
            //retornar el valor de array en formato json
            print_r(json_encode($arrResponse, JSON_UNESCAPED_UNICODE));
        }
        die(); //detener o cerrar el proceso
    }

    public function getAdmin()
    {
        $arrData = $this->model->selectAdmin();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estado'] == 'Activo') {
                $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
            } elseif ($arrData[$i]['estado'] == 'Inactivo') {
                $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            //configuración tipo usuarios
            if ($_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>') {
                $arrData[$i]['options'] = '<div class="text-center">
            <buttom class="btn btn-warning btn-sm btnEditAdmin" onClick="ftnEditAdmin(' . $arrData[$i]['id'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></buttom>
            <buttom class="btn btn-danger btn-sm btnDelAdmin" onClick="fntDeleteAdmin(' . $arrData[$i]['id'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></buttom>
            </div>';
            } elseif (
                $_SESSION['tipoUser'] == '<span class="badge badge-warning">Residente</span>' ||
                $_SESSION['tipoUser'] == '<span class="badge badge-info">Guarda seguridad</span>'
            ) {
                $arrData[$i]['options'] = "";
            }
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    //método para extraer un unico administrador
    public function getOneAdmin(int $idAdmin)
    {
        $intIdAdmin = intval(limpiarCadena($idAdmin));

        //empty (vacio) ó !empy(no esta vacio)
        if ($intIdAdmin > 0) {
            $arrData = $this->model->selectAdministrador($intIdAdmin);
            if (empty($arrData)) {
                $arrResponse = array('estadoAdministrador' => false, 'msg' => 'Datos no encontrado');
            } else {
                $arrResponse = array('estadoAdministrador' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //método para eliminar los administradores
    public function delAdmin()
    {
        if ($_POST) {
            $intIdAdmin = intval($_POST['idAdministrador']);
            $requestDelete = $this->model->deleteAdmin($intIdAdmin);
            if ($requestDelete) {
                $arrResponse = array('estadoAdministrador' => true, 'msg' => 'Se ha inhabilitado el Administrador');
            } else {
                $arrResponse =
                    array('estadoAdministrador' => false, 'msg' => 'Error al inhabilitar el Administrador');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
