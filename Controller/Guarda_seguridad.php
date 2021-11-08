<?php
class Guarda_seguridad extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Guarda_seguridad()
    {
        $data['titulo_pagina'] = "Guarda seguridad | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Guarda_seguridad", $data);
    }

    public function getGuarda()
    {
        $arrData = $this->model->selectGuarda();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estado'] == 'Activo') {
                $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
            } elseif ($arrData[$i]['estado'] == 'Inactivo') {
                $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $arrData[$i]['options'] = '<div class="text-center">
            <buttom class="btn btn-warning btn-sm btnEditAdmin"  onClick="ftnEditGuarda(' . $arrData[$i]['id'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></buttom>
            <buttom class="btn btn-danger btn-sm btnDelAdmin" onClick="fntDeleteGuarda(' . $arrData[$i]['id'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></buttom>
            </div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    //método para extraer un unico administrador
    public function getOneGuarda(int $idGuarda)
    {
        $intIdGuarda = intval(limpiarCadena($idGuarda));

        //empty (vacio) ó !empy(no esta vacio)
        if ($intIdGuarda > 0) {
            $arrData = $this->model->selectGuardaSeguridad($intIdGuarda);
            if (empty($arrData)) {
                $arrResponse = array('estado' => false, 'msg' => 'Datos no encontrado');
            } else {
                $arrResponse = array('estado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //método para insertar los administradores
    public function setGuarda()
    {
        if ($_POST) {

            //verificar que ningun campo este vació
            if (
                empty($_POST['correoGuarda']) || empty($_POST['passGuarda']) || empty($_POST['passGuarda'])
                || empty($_POST['apellidosGuarda']) || empty($_POST['TipoDocumentoGuarda']) || empty($_POST['numDocGuarda'])
                || empty($_POST['NumTelGuarda']) || empty($_POST['estadoGuarda']) || empty($_POST['tipousuario'])
            ) {
                $arrResponse = array("estado" => false, "msg" => "Los datos ingresado son incorrectos :(");
            } else {
                $intIdGuarda = limpiarCadena($_POST['idGuarda']);
                $strEmail = strtolower(limpiarCadena($_POST['correoGuarda'])); //strtolower(convertir todos las letras en minusculas)
                $strPass = limpiarCadena($_POST['passGuarda']);
                $strNombres = ucwords(limpiarCadena($_POST['nombreGuarda']));
                $strApellidos = ucwords(limpiarCadena($_POST['apellidosGuarda'])); //ucwords (convierte las inciales de cada palabra en mayusculs)
                $strTipoDoc = limpiarCadena($_POST['TipoDocumentoGuarda']);
                $strNumDoc = intval($_POST['numDocGuarda']); //intval (convierte todos los valores en enteros)
                $strTel = intval($_POST['NumTelGuarda']); //intval (convierte todos los valores en enteros)
                $strEstado = limpiarCadena($_POST['estadoGuarda']);
                $strTipoUsu = limpiarCadena($_POST['tipousuario']);

                //método par actualizar e insertar
                if ($intIdGuarda == 0) {
                    /*-----------------INSERTAR ADMINISTRADOR ---------------*/
                    $option = 1;
                    //encriptar las contraseñas
                    $strPass = hash("SHA256", $_POST['passGuarda']);
                    //INSERTAR LOS DATOS EN EL MODELO DEL ADMINISTRADOR
                    $request_admin = $this->model->insertGuarda(
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
                    $strPass = hash("SHA256", $_POST['passGuarda']);
                    //INSERTAR LOS DATOS EN EL MODELO DEL ADMINISTRADOR
                    $request_admin = $this->model->updateGuarda(
                        $intIdGuarda,
                        $strEmail,
                        $strPass,
                        $strNombres,
                        $strApellidos,
                        $strTipoDoc,
                        $strNumDoc,
                        $strTel,
                        $strEstado
                    );
                }

                //evaluar si la respuesta es mayor a cero, quiero decir que si se inserto
                if ($request_admin > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estado' => true, 'msg' => 'Datos almacenados correctamente :)');
                    } elseif ($option == 2) {
                        $arrResponse = array('estado' => true, 'msg' => 'Datos actualizados correctamente :)');
                    }
                } elseif ($request_admin == 'exits') {
                    $arrResponse = array('estado' => false, 'msg' => '!Atención! el email o la identificación ya existen. Intenta con otro');
                } else {
                    $arrResponse = array('estado' => false, 'msg' => 'No es posible almacenar los datos :(');
                }
            }

            //retornar el valor de array en formato json
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die(); //detener o cerrar el proceso
    }

    //método para eliminar guardas de seguridad
    public function delGuarda()
    {
        if ($_POST) {
            $intIdGuarda = intval($_POST['idGuarda']);
            $requestDelete = $this->model->deleteGuarda($intIdGuarda);
            if ($requestDelete) {
                $arrResponse = array('estado' => true, 'msg' => 'Se ha inhabilitado el Guarda de seguridad');
            } else {
                $arrResponse =
                    array('estado' => false, 'msg' => 'Error al inhabilitar el Guarda de seguridad');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
