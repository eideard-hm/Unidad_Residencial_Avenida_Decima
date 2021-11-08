<?php
class Empleado extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Empleado()
    {
        $data['titulo_pagina'] = "Empleado | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Empleado", $data);
    }
    public function setEmp()
    {
        if ($_POST) {

            //verificar que ningun campo este vació
            if (
                empty($_POST['nombreEmpleado']) || empty($_POST['apellidosEmpleado'])
                || empty($_POST['tipoDocEmpleado']) || empty($_POST['numDocEmpleado']) ||
                empty($_POST['numTelEmpleado']) || empty($_POST['cargoEmpleado']) ||
                empty($_POST['ARLEmpleado']) || empty($_POST['estadoEmpleado'])
            ) {
                $arrResponse = array("estadoEmpleado" => false, "msg" => "Los datos ingresado son incorrectos :(");
            } else {
                $intIdEmpleado = intval($_POST['idEmpleado']);
                $strNombresEmpleado = ucwords(limpiarCadena($_POST['nombreEmpleado'])); //strtolower(convertir todos las letras en minusculas)
                $strApellidosEmpleado = ucwords(limpiarCadena($_POST['apellidosEmpleado']));
                $strDocEmpleado = limpiarCadena($_POST['tipoDocEmpleado']);
                $intNumDocEmpleado = intval(limpiarCadena($_POST['numDocEmpleado'])); //ucwords (convierte las inciales de cada palabra en mayusculs)
                $intTelefonoEmpleado = intval(limpiarCadena($_POST['numTelEmpleado']));
                $strCargoEmpleado = limpiarCadena($_POST['cargoEmpleado']);
                $strARLEmpleado = limpiarCadena($_POST['ARLEmpleado']);
                $strEstadoEmpleado = limpiarCadena($_POST['estadoEmpleado']);

                //método par actualizar e insertar
                if ($intIdEmpleado == 0) {
                    /*-----------------INSERTAR EMPLEADO ---------------*/
                    $option = 1;
                    //INSERTAR LOS DATOS EN EL MODELO DEL EMPLEADO
                    $request_empleado = $this->model->insertEmpleado(
                        $strNombresEmpleado,
                        $strApellidosEmpleado,
                        $strDocEmpleado,
                        $intNumDocEmpleado,
                        $intTelefonoEmpleado,
                        $strCargoEmpleado,
                        $strARLEmpleado,
                        $strEstadoEmpleado
                    );
                } else {
                    /*-----------------------------ACTUALIZAR EMPLEADO---------- */
                    $option = 2;
                    //INSERTAR LOS DATOS EN EL MODELO DEL EMPLEADO
                    $request_empleado = $this->model->updateEmpleado(
                        $intIdEmpleado,
                        $strNombresEmpleado,
                        $strApellidosEmpleado,
                        $strDocEmpleado,
                        $intNumDocEmpleado,
                        $intTelefonoEmpleado,
                        $strCargoEmpleado,
                        $strARLEmpleado,
                        $strEstadoEmpleado
                    );
                }

                //evaluar si la respuesta es mayor a cero, quiero decir que si se inserto
                if ($request_empleado > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estadoEmpleado' => true, 'msg' => 'Datos almacenados correctamente :)');
                    } elseif ($option == 2) {
                        $arrResponse = array('estadoEmpleado' => true, 'msg' => 'Datos actualizados correctamente :)');
                    }
                } elseif ($request_empleado == 'exits') {
                    $arrResponse = array('estadoEmpleado' => false, 'msg' => '!Atención! la identificación ya existe. Intenta con otro');
                } else {
                    $arrResponse = array('estadoEmpleado' => false, 'msg' => 'No es posible almacenar los datos :(');
                }
            }
            //retornar el valor de array en formato json
            print_r(json_encode($arrResponse, JSON_UNESCAPED_UNICODE));
        }
        die(); //detener o cerrar el proceso
    }

    public function getEmpleado()
    {
        $arrData = $this->model->selectEmpleado();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estadoEmpleado'] == 'Activo') {
                $arrData[$i]['estadoEmpleado'] = '<span class="badge badge-success">Activo</span>';
            } elseif ($arrData[$i]['estadoEmpleado'] == 'Inactivo') {
                $arrData[$i]['estadoEmpleado'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            //configuración tipo usuarios
            if ($_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>') {
                $arrData[$i]['options'] = '<div class="text-center">
            <buttom class="btn btn-warning btn-sm btnEditEmp" onClick="ftnEditEmp(' . $arrData[$i]['idEmpleado'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></buttom>
            <buttom class="btn btn-danger btn-sm btnDelEmp" onClick="fntDeleteEmp(' . $arrData[$i]['idEmpleado'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></buttom>
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
    public function getOneEmpleado(int $idEmpleado)
    {
        $intIdEmpleado = intval(limpiarCadena($idEmpleado));

        //empty (vacio) ó !empy(no esta vacio)
        if ($intIdEmpleado > 0) {
            $arrData = $this->model->selectEmpleados($intIdEmpleado);
            if (empty($arrData)) {
                $arrResponse = array('estadoEmpleado' => false, 'msg' => 'Datos no encontrado');
            } else {
                $arrResponse = array('estadoEmpleado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //método para eliminar los administradores
    public function delEmpleado()
    {
        if ($_POST) {
            $intIdEmpleado = intval($_POST['idEmpleado']);
            $requestDelete = $this->model->deleteEmpleado($intIdEmpleado);
            if ($requestDelete) {
                $arrResponse = array('estadoEmpleado' => true, 'msg' => 'Se ha inhabilitado el Empleado');
            } else {
                $arrResponse =
                    array('estadoEmpleado' => false, 'msg' => 'Error al inhabilitar el Empleado');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
