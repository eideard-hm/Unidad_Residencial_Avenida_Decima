<?php
class Cuenta_cobro extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Cuenta_cobro()
    {
        $data['titulo_pagina'] = "Cuentas de cobro | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Cuenta_cobro", $data);
    }

    public function setCuenta()
    {
        if ($_POST) {

            //verificar que ningun campo este vació
            if (
                empty($_POST['fechaExpideCuenta']) || empty($_POST['fechaVencimientoPago'])
                || empty($_POST['estadoCuenta']) || empty($_POST['periodoCuenta']) || empty($_POST['fechaPagoOportuno'])
                || empty($_POST['fechaConsignacion']) || empty($_POST['valorPagoCuenta'])
            ) {
                $arrResponse = array("estadoCuenta" => false, "msg" => "Los datos ingresado son incorrectos :(");
            } else {
                $intIdCuenta = intval(limpiarCadena($_POST['idCuenta']));
                $strFechaExpideCuenta = limpiarCadena($_POST['fechaExpideCuenta']);
                $strFechaVencimientoPago = limpiarCadena($_POST['fechaVencimientoPago']);
                $strEstadoCuenta = limpiarCadena($_POST['estadoCuenta']);
                $strPeriodoCuenta = limpiarCadena($_POST['periodoCuenta']);
                $strFechaPagoOportuno = limpiarCadena($_POST['fechaPagoOportuno']);
                $strFechaConsignación = $_POST['fechaConsignacion']; //intval (convierte todos los valores en enteros)
                $strValorPagoCuenta = limpiarCadena($_POST['valorPagoCuenta']); //intval (convierte todos los valores en enteros)
                
                //método par actualizar e insertar
                if ($intIdCuenta == 0) {
                    /*-----------------INSERTAR CUENTA---------------*/
                    $option = 1;

                    //INSERTAR LOS DATOS EN EL MODELO DEL Cuenta
                    $request_cuenta = $this->model->insertCuenta(
                        $strFechaExpideCuenta,
                        $strFechaVencimientoPago,
                        $strEstadoCuenta,
                        $strPeriodoCuenta,
                        $strFechaPagoOportuno,
                        $strFechaConsignación,
                        $strValorPagoCuenta
                    );
                } else {
                    /*-----------------------------ACTUALIZAR CUENTA---------- */
                    $option = 2;                   
                    //INSERTAR LOS DATOS EN EL MODELO DEL CUENTA DE COBRO
                    $request_cuenta = $this->model->updateCuenta(
                        $intIdCuenta,
                        $strFechaExpideCuenta,
                        $strFechaVencimientoPago,
                        $strEstadoCuenta,
                        $strPeriodoCuenta,
                        $strFechaPagoOportuno,
                        $strFechaConsignación,
                        $strValorPagoCuenta
                    );
                }

                //evaluar si la respuesta es mayor a cero, quiero decir que si se inserto
                if ($request_cuenta > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estadoCuenta' => true, 'msg' => 'Datos almacenados correctamente :)');
                    } elseif ($option == 2) {
                        $arrResponse = array('estadoCuenta' => true, 'msg' => 'Datos actualizados correctamente :)');
                    }
                } elseif ($request_cuenta == 'exits') {
                    $arrResponse = array('estadoCuenta' => false, 'msg' => '!Atención! cuenta ya existe. Intenta con otro');
                } else {
                    $arrResponse = array('estadoCuenta' => false, 'msg' => 'No es posible almacenar los datos :(');
                }
            }
            //retornar el valor de array en formato json
            print_r(json_encode($arrResponse, JSON_UNESCAPED_UNICODE));
        }
        die(); //detener o cerrar el proceso
    }

    public function getCuenta()
    {
        $arrData = $this->model->selectCuenta();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estadoCuenta'] == 'Cancelado') {
                $arrData[$i]['estadoCuenta'] = '<span class="badge badge-success">Cancelado</span>';
            } elseif ($arrData[$i]['estadoCuenta'] == 'Pendiente') {
                $arrData[$i]['estadoCuenta'] = '<span class="badge badge-danger">Pendiente</span>';
            } else {
                $arrData[$i]['estadoCuenta'] = '<span class="badge badge-warning">Parcial</span>';
            }

            $arrData[$i]['options'] = '<div class="text-center">
            <buttom class="btn btn-warning btn-sm btnEditCuenta" onClick="ftnEditCuenta(' . $arrData[$i]['idCuenta'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></buttom>
            <buttom class="btn btn-danger btn-sm btnDelCuenta" onClick="fntDeleteCuenta(' . $arrData[$i]['idCuenta'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></buttom>
            </div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    //método para extraer un unico administrador
    public function getOneCuenta(int $idCuenta)
    {
        $intIdCuenta = intval(limpiarCadena($idCuenta));

        //empty (vacio) ó !empy(no esta vacio)
        if ($intIdCuenta > 0) {
            $arrData = $this->model->selectCuen($intIdCuenta);
            if (empty($arrData)) {
                $arrResponse = array('estadoCuenta' => false, 'msg' => 'Datos no encontrado');
            } else {
                $arrResponse = array('estadoCuenta' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //método para eliminar los administradores
    public function delCuenta()
    {
        if ($_POST) {
            $intIdCuenta = intval($_POST['idCuenta']);
            $requestDelete = $this->model->deleteCuentaCobro($intIdCuenta);
            if ($requestDelete) {
                $arrResponse = array('estadoCuenta' => true, 'msg' => 'Se ha inhabilitado la cuenta');
            } else {
                $arrResponse =
                    array('estadoCuenta' => false, 'msg' => 'Error al inhabilitar la cuenta');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
