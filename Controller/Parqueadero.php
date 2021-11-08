<?php
class Parqueadero extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Parqueadero()
    {
        $data['titulo_pagina'] = "Parqueadero | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Parqueadero", $data);
    }

    //método para insertar los administradores
    public function setParq()
    {
        if ($_POST) {

            //verificar que ningun campo este vació
            if (
                empty($_POST['usuParqueadero']) || empty($_POST['estadoParquadero']) || 
                empty($_POST['tipoParquadero'])
            ) {
                $arrResponse = array("estado" => false, "msg" => "Los datos ingresado son incorrectos :(");
            } else {
                $intIdParq = intval($_POST['idParqueadero']);
                $strUsoParq = limpiarCadena($_POST['usuParqueadero']);
                $strEstadoParq = limpiarCadena($_POST['estadoParquadero']);
                $strTipoParq = limpiarCadena($_POST['tipoParquadero']);

                //método par actualizar e insertar
                if ($intIdParq == 0) {
                    /*-----------------INSERTAR ADMINISTRADOR ---------------*/
                    $option = 1;
                    //INSERTAR LOS DATOS EN EL MODELO DEL PARQUEADERO
                    $request_parq = $this->model->insertParq(
                        $strUsoParq,
                        $strEstadoParq,
                        $strTipoParq
                    );
                } else {
                    /*-----------------------------ACTUALIZAR ADMINISTRADOR---------- */
                    $option = 2;
                    //INSERTAR LOS DATOS EN EL MODELO DEL PARQUEADERO
                    $request_parq = $this->model->updateParq(
                        $intIdParq,
                        $strUsoParq,
                        $strEstadoParq,
                        $strTipoParq
                    );
                }

                //evaluar si la respuesta es mayor a cero, quiero decir que si se inserto
                if ($request_parq > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estado' => true, 'msg' => 'Datos almacenados correctamente :)');
                    } elseif ($option == 2) {
                        $arrResponse = array('estado' => true, 'msg' => 'Datos actualizados correctamente :)');
                    }
                } else {
                    $arrResponse = array('estado' => false, 'msg' => 'No es posible almacenar los datos :(');
                }
            }
            //retornar el valor de array en formato json
            print_r(json_encode($arrResponse, JSON_UNESCAPED_UNICODE));
        }
        die(); //detener o cerrar el proceso
    }

    public function getParq()
    {
        $arrData = $this->model->selectParq();

        for ($i = 0; $i < count($arrData); $i++) {

            if (
                $_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>' ||
                $_SESSION['tipoUser'] == '<span class="badge badge-info">Guarda seguridad</span>'
            ) {
                $arrData[$i]['options'] = '<div class="text-center">
            <buttom class="btn btn-warning btn-sm btnEditAdmin" onClick="ftnEditParq(' . $arrData[$i]['idParqueadero'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></buttom>
            <buttom class="btn btn-danger btn-sm btnDelAdmin" onClick="fntDeleteParq(' . $arrData[$i]['idParqueadero'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></buttom>
            </div>';
            } elseif (
                $_SESSION['tipoUser'] == '<span class="badge badge-warning">Residente</span>'
            ) {
                $arrData[$i]['options'] = "";
            }
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    //método para extraer un unico administrador
    public function getOneParq(int $idParq)
    {
        $intIdParq = intval(limpiarCadena($idParq));

        //empty (vacio) ó !empy(no esta vacio)
        if ($intIdParq > 0) {
            $arrData = $this->model->selectParqueadero($intIdParq);
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
    public function delParq()
    {
        if ($_POST) {
            $intIdParq = intval($_POST['idParqueadero']);
            $requestDelete = $this->model->deleteParq($intIdParq);
            if ($requestDelete) {
                $arrResponse = array('estado' => true, 'msg' => 'Se ha inhabilitado el Parqueadero');
            } else {
                $arrResponse =
                    array('estado' => false, 'msg' => 'Error al inhabilitar el Parqueadero');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
