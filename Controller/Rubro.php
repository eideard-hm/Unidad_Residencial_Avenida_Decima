<?php
class Rubro extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Rubro()
    {
        $data['titulo_pagina'] = "Rubro | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Rubro", $data);
    }

    public function setRubro()
    {
        if ($_POST) {

            //verificar que ningun campo este vació
            if (
                empty($_POST['nombreRubro']) || empty($_POST['descripcionRubro']) || empty($_POST['valorRubro'])
                || empty($_POST['valorRubro'])
            ) {
                $arrResponse = array("estadoRubro" => false, "msg" => "Los datos ingresado son incorrectos :(");
            } else {
                $intIdRubro = ($_POST['idRubro']);
                $strNombreRublo = strtolower(limpiarCadena($_POST['nombreRubro'])); //strtolower(convertir todos las letras en minusculas)
                $strDescripcionRubro = limpiarCadena($_POST['descripcionRubro']);
                $strValorRubro = limpiarCadena($_POST['valorRubro']);
                $strEstadoRubro = ucwords(limpiarCadena($_POST['estadoRubro'])); //ucwords (convierte las inciales de cada palabra en mayusculs)

                //método par actualizar e insertar
                if ($intIdRubro == 0) {
                    /*-----------------INSERTAR RUBRO ---------------*/
                    $option = 1;

                    //INSERTAR LOS DATOS EN EL MODELO DEL RUBRO
                    $request_rubro = $this->model->insertRubro(
                        $strNombreRublo,
                        $strDescripcionRubro,
                        $strValorRubro,
                        $strEstadoRubro
                    );
                } else {
                    /*-----------------------------ACTUALIZAR ADMINISTRADOR---------- */
                    $option = 2;
                    //INSERTAR LOS DATOS EN EL MODELO DEL RUBRO
                    $request_rubro = $this->model->updateRubro(
                        $intIdRubro,
                        $strNombreRublo,
                        $strDescripcionRubro,
                        $strValorRubro,
                        $strEstadoRubro
                    );
                }

                //evaluar si la respuesta es mayor a cero, quiero decir que si se inserto
                if ($request_rubro > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estadoRubro' => true, 'msg' => 'Datos almacenados correctamente :)');
                    } elseif ($option == 2) {
                        $arrResponse = array('estadoRubro' => true, 'msg' => 'Datos actualizados correctamente :)');
                    }
                } else {
                    $arrResponse = array('estadoRubro' => false, 'msg' => 'No es posible almacenar los datos :(');
                }
            }
            //retornar el valor de array en formato json
            print_r(json_encode($arrResponse, JSON_UNESCAPED_UNICODE));
        }
        die(); //detener o cerrar el proceso
    }

    public function getRubro()
    {
        $arrData = $this->model->selectRubro();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estadoRubro'] == 'Activo') {
                $arrData[$i]['estadoRubro'] = '<span class="badge badge-success">Activo</span>';
            } elseif ($arrData[$i]['estadoRubro'] == 'Inactivo') {
                $arrData[$i]['estadoRubro'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $arrData[$i]['options'] = '<div class="text-center">
            <buttom class="btn btn-warning btn-sm btnEditAdmin" onClick="ftnEditRubro(' . $arrData[$i]['idRubro'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></buttom>
            <buttom class="btn btn-danger btn-sm btnDelAdmin" onClick="fntDeleteRubro(' . $arrData[$i]['idRubro'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></buttom>
            </div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    //método para extraer un único rubro
    public function getOneRubro(int $idRubro)
    {
        $intIdRubro = intval(limpiarCadena($idRubro));

        //empty (vacio) ó !empy(no esta vacio)
        if ($intIdRubro > 0) {
            $arrData = $this->model->selectRubros($intIdRubro);
            if (empty($arrData)) {
                $arrResponse = array('estadoRubro' => false, 'msg' => 'Datos no encontrado');
            } else {
                $arrResponse = array('estadoRubro' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //método para eliminar los rubros
    public function delRubro()
    {
        if ($_POST) {
            $intIdRubro = intval($_POST['idRubro']);
            $requestDelete = $this->model->deleteRubro($intIdRubro);
            if ($requestDelete) {
                $arrResponse = array('estadoRubro' => true, 'msg' => 'Se ha inhabilitado el Rubro');
            } else {
                $arrResponse =
                    array('estadoRubro' => false, 'msg' => 'Error al inhabilitar el Rubro');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
