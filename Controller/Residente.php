<?php
class Residente extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Residente()
    {
        $data['titulo_pagina'] = "Residente | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Residente", $data);
    }

    //método para insertar los residentes
    public function setResid()
    {
        if ($_POST) {

            //verificar que ningun campo este vació
            if (
                empty($_POST['correoResid']) || empty($_POST['passResidente']) || empty($_POST['nombre'])
                || empty($_POST['apellidos']) || empty($_POST['TipoDocumento']) || empty($_POST['numDoc'])
                || empty($_POST['NumTel']) || empty($_POST['NumTelFijo']) || empty($_POST['numTorre'])
                || empty($_POST['numInterior']) || empty($_POST['numApartamento']) || empty($_POST['estadoResidente']) || empty($_POST['tipousuario'])
            ) {
                $arrResponse = array("estado" => false, "msg" => "Los datos ingresado son incorrectos :(");
            } else {
                $intIdResid = intval($_POST['idResidente']);
                $strEmail = strtolower(limpiarCadena($_POST['correoResid'])); //strtolower(convertir todos las letras en minusculas)
                $strPass = limpiarCadena($_POST['passResidente']);
                $strNombres = ucwords(limpiarCadena($_POST['nombre']));
                $strApellidos = ucwords(limpiarCadena($_POST['apellidos'])); //ucwords (convierte las inciales de cada palabra en mayusculs)
                $strTipoDoc = limpiarCadena($_POST['TipoDocumento']);
                $intNumDoc = intval($_POST['numDoc']); //intval (convierte todos los valores en enteros)
                $intTel = intval($_POST['NumTel']); //intval (convierte todos los valores en enteros)
                $intTelFij = intval($_POST['NumTelFijo']); //intval (convierte todos los valores en enteros)
                $intTorre = intval($_POST['numTorre']); //intval (convierte todos los valores en enteros)
                $intInterior = intval($_POST['numInterior']); //intval (convierte todos los valores en enteros)
                $intApto = limpiarCadena($_POST['numApartamento']);
                $strEstado = limpiarCadena($_POST['estadoResidente']);
                $strTipoUsu = limpiarCadena($_POST['tipousuario']);

                //método par actualizar e insertar
                if ($intIdResid == 0) {
                    /*-----------------INSERTAR ADMINISTRADOR ---------------*/
                    $option = 1;
                    //encriptar las contraseñas
                    $strPass = hash("SHA256", $_POST['passResidente']);
                    //INSERTAR LOS DATOS EN EL MODELO DEL ADMINISTRADOR
                    $request_resid = $this->model->insertResid(
                        $strEmail,
                        $strPass,
                        $strNombres,
                        $strApellidos,
                        $strTipoDoc,
                        $intNumDoc,
                        $intTel,
                        $intTelFij,
                        $intTorre,
                        $intInterior,
                        $intApto,
                        $strEstado,
                        $strTipoUsu
                    );
                } else {
                    /*-----------------------------ACTUALIZAR ADMINISTRADOR---------- */
                    $option = 2;
                    //encriptar las contraseñas
                    $strPass = hash("SHA256", $_POST['passResidente']);
                    //INSERTAR LOS DATOS EN EL MODELO DEL ADMINISTRADOR
                    $request_resid = $this->model->updateResid(
                        $intIdResid,
                        $strEmail,
                        $strPass,
                        $strNombres,
                        $strApellidos,
                        $strTipoDoc,
                        $intNumDoc,
                        $intTel,
                        $intTelFij,
                        $intTorre,
                        $intInterior,
                        $intApto,
                        $strEstado
                    );
                }

                //evaluar si la respuesta es mayor a cero, quiero decir que si se inserto
                if ($request_resid > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estado' => true, 'msg' => 'Datos almacenados correctamente :)');
                    } elseif ($option == 2) {
                        $arrResponse = array('estado' => true, 'msg' => 'Datos actualizados correctamente :)');
                    }
                } elseif ($request_resid == 'exits') {
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

    public function getResid()
    {
        $arrData = $this->model->selectResid();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estado'] == 'Activo') {
                $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
            } elseif($arrData[$i]['estado'] == 'Inactivo') {
                $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            if ($_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>') {
                $arrData[$i]['options'] = '<div class="text-center">
            <buttom class="btn btn-warning btn-sm btnEditResid" onClick="ftnEditResid(' . $arrData[$i]['id'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></buttom>
            <buttom class="btn btn-danger btn-sm btnDelResid" onClick="fntDeleteResid(' . $arrData[$i]['id'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></buttom>
            </div>';
            } else {
                $arrData[$i]['options'] = "";
            }
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    //método para extraer un unico residente
    public function getOneResid(int $Resid)
    {
        $intIdResid = intval(limpiarCadena($Resid));

        //empty (vacio) ó !empy(no esta vacio)
        if ($intIdResid > 0) {
            $arrData = $this->model->selectResidente($intIdResid);
            if (empty($arrData)) {
                $arrResponse = array('estado' => false, 'msg' => 'Datos no encontrado');
            } else {
                $arrResponse = array('estado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //método para eliminar los administradores
    public function delResid()
    {
        if ($_POST) {
            $intIResid = intval($_POST['idResidente']);
            $requestDelete = $this->model->deleteAdmin($intIResid);
            if ($requestDelete) {
                $arrResponse = array('estado' => true, 'msg' => 'Se ha inhabilitado el Residente');
            } else {
                $arrResponse =
                    array('estado' => false, 'msg' => 'Error al inhabilitar el Residente');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
