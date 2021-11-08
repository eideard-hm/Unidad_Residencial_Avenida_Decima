<?php
class Vehiculo extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Vehiculo()
    {
        $data['titulo_pagina'] = "Vehiculo | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Vehiculo", $data);
    }

    //método para insertar los administradores
    public function setVehi()
    {
        if ($_POST) {

            //verificar que ningun campo este vació
            if (
                empty($_POST['placaVehiculo']) || empty($_POST['modeloVehiculo']) || empty($_POST['marcaVehiculo'])
                || empty($_POST['colorVehiculo']) || empty($_POST['tipoVehiculo'])
            ) {
                $arrResponse = array("estado" => false, "msg" => "Los datos ingresado son incorrectos :(");
            } else {
                $intIdVehiculo = intval(limpiarCadena($_POST['idVehiculo']));
                $strPlaca = strtoupper(limpiarCadena($_POST['placaVehiculo']));
                $intModelo = intval(limpiarCadena($_POST['modeloVehiculo'])); //strtolower(convertir todos las letras en minusculas)
                $strMarca = limpiarCadena($_POST['marcaVehiculo']);
                $strColor = ucwords(limpiarCadena($_POST['colorVehiculo']));
                $strTipo = ucwords(limpiarCadena($_POST['tipoVehiculo'])); //ucwords (convierte las inciales de cada palabra en mayusculs)


                //método par actualizar e insertar
                if ($intIdVehiculo == 0) {
                    /*-----------------INSERTAR ADMINISTRADOR ---------------*/
                    $option = 1;
                    $request_vehi = $this->model->insertVehi(
                        $strPlaca,
                        $intModelo,
                        $strMarca,
                        $strColor,
                        $strTipo
                    );
                } else {
                    /*-----------------------------ACTUALIZAR ADMINISTRADOR---------- */
                    $option = 2;
                    $request_vehi = $this->model->updateVehi(
                        $intIdVehiculo,
                        $strPlaca,
                        $intModelo,
                        $strMarca,
                        $strColor,
                        $strTipo
                    );
                }

                //evaluar si la respuesta es mayor a cero, quiero decir que si se inserto
                if ($request_vehi > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estado' => true, 'msg' => 'Datos almacenados correctamente :)');
                    } elseif ($option == 2) {
                        $arrResponse = array('estado' => true, 'msg' => 'Datos actualizados correctamente :)');
                    }
                } elseif ($request_vehi == 'exits') {
                    $arrResponse = array('estado' => false, 'msg' => '!Atención! La placa del vehículo ya existe.');
                } else {
                    $arrResponse = array('estado' => false, 'msg' => 'No es posible almacenar los datos :(');
                }
            }
            //retornar el valor de array en formato json
            print_r(json_encode($arrResponse, JSON_UNESCAPED_UNICODE));
        }
        die(); //detener o cerrar el proceso
    }

    public function getVehi()
    {
        $arrData = $this->model->selectVehi();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>') {
                $arrData[$i]['options'] = '<div class="text-center">
            <buttom class="btn btn-warning btn-sm btnEditVehi" onClick="ftnEditVehi(' . $arrData[$i]['idVehiculo'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></buttom>
            <buttom class="btn btn-danger btn-sm btnDelVehi" onClick="fntDeleteVehi(' . $arrData[$i]['idVehiculo'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></buttom>
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
    public function getOneVehi(int $idVehi)
    {
        $intIdVehiculo = intval(limpiarCadena($idVehi));

        //empty (vacio) ó !empy(no esta vacio)
        if ($intIdVehiculo > 0) {
            $arrData = $this->model->selectVehiculo($intIdVehiculo);
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
    public function delVehi()
    {
        if ($_POST) {
            $intIdVehiculo = intval($_POST['idVehiculo']);
            $requestDelete = $this->model->deleteVehi($intIdVehiculo);
            if ($requestDelete) {
                $arrResponse = array('estado' => true, 'msg' => 'Se ha elimiando el Vehículo');
            } else {
                $arrResponse =
                    array('estado' => false, 'msg' => 'Error al elimiando el Vehículo');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
