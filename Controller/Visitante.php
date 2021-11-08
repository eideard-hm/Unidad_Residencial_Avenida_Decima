<?php
class Visitante extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Visitante()
    {
        $data['titulo_pagina'] = "Visitante | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Visitante", $data);
    }

    //método para insertar los administradores
    public function setVisit()
    {
        if ($_POST) {

            //verificar que ningun campo este vació
            if (
                empty($_POST['nombreVisitante']) || empty($_POST['apellidosVisitante']) || empty($_POST['tipoDocVisitante'])
                || empty($_POST['numeroDocVisitante']) || empty($_POST['numTorreVisitante']) || empty($_POST['numInteriorVisitante'])
                || empty($_POST['numAptoVisitante']) || empty($_POST['fechaIngresoVisitante']) || empty($_POST['horaIngresoVisitante'])
                || empty($_POST['fechaSalidaVisitante']) || empty($_POST['horaSalidaVisitante'])
                || empty($_POST['estadoVisitante'])
            ) {
                $arrResponse = array("estado" => false, "msg" => "Los datos ingresado son incorrectos :(");
            } else {
                $intIdVisit = ($_POST['idVisitante']);
                $strNombres = ucwords(limpiarCadena($_POST['nombreVisitante'])); //strtolower(convertir todos las letras en minusculas)
                $strApellidos = ucwords(limpiarCadena($_POST['apellidosVisitante']));
                $sttipoDoc = limpiarCadena($_POST['tipoDocVisitante']);
                $intNumDoc = limpiarCadena($_POST['numeroDocVisitante']); //ucwords (convierte las inciales de cada palabra en mayusculs)
                $intTorre = limpiarCadena($_POST['numTorreVisitante']);
                $intInte = ($_POST['numInteriorVisitante']); //intval (convierte todos los valores en enteros)
                $intApto = ($_POST['numAptoVisitante']); //intval (convierte todos los valores en enteros)
                $fchaIngreso = limpiarCadena($_POST['fechaIngresoVisitante']);
                //$fchaIngreso = setlocale(LC_TIME, 'es_CO.UTF-8');
                $hrIngreso = limpiarCadena($_POST['horaIngresoVisitante']);
                //$hrIngreso = setlocale(LC_TIME, 'es_CO.UTF-8');
                $fchaSalida = limpiarCadena($_POST['fechaSalidaVisitante']);
                //$fchaSalida = setlocale(LC_TIME, 'es_CO.UTF-8');
                $hrSalida = limpiarCadena($_POST['horaSalidaVisitante']);  
                //$hrSalida = setlocale(LC_TIME, 'es_CO.UTF-8');                             
                $estadoVisit = limpiarCadena($_POST['estadoVisitante']);

                //método par actualizar e insertar
                if ($intIdVisit == 0) {
                    /*-----------------INSERTAR VISNTANTES ---------------*/
                    $option = 1;

                    //INSERTAR LOS DATOS EN EL MODELO DEL ADMINISTRADOR
                    $request_vist = $this->model->insertVisit(
                        $strNombres,
                        $strApellidos,
                        $sttipoDoc,
                        $intNumDoc,
                        $intTorre,
                        $intInte,
                        $intApto,
                        $fchaIngreso,
                        $hrIngreso,
                        $fchaSalida,
                        $hrSalida,
                        $estadoVisit
                    );
                } else {
                    /*-----------------------------ACTUALIZAR VISNTANTES---------- */
                    $option = 2;
                    //INSERTAR LOS DATOS EN EL MODELO DEL VISITANTE
                    $request_vist = $this->model->updateVist(
                        $intIdVisit,
                        $strNombres,
                        $strApellidos,
                        $sttipoDoc,
                        $intNumDoc,
                        $intTorre,
                        $intInte,
                        $intApto,
                        $fchaIngreso,
                        $hrIngreso,
                        $fchaSalida,
                        $hrSalida,
                        $estadoVisit
                    );
                }

                //evaluar si la respuesta es mayor a cero, quiero decir que si se inserto
                if ($request_vist > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estadoVisitante' => true, 'msg' => 'Datos almacenados correctamente :)');
                    } elseif ($option == 2) {
                        $arrResponse = array('estadoVisitante' => true, 'msg' => 'Datos actualizados correctamente :)');
                    }
                } elseif ($request_vist == 'exits') {
                    $arrResponse = array('estadoVisitante' => false, 'msg' => '!Atención! el email o la identificación ya existen. Intenta con otro');
                } else {
                    $arrResponse = array('estadoVisitante' => false, 'msg' => 'No es posible almacenar los datos :(');
                }
            }
            //retornar el valor de array en formato json
            print_r(json_encode($arrResponse, JSON_UNESCAPED_UNICODE));
        }
        die(); //detener o cerrar el proceso
    }

    public function getVisit()
    {
        $arrData = $this->model->selectVisit();

        for ($i = 0; $i < count($arrData); $i++) {

            if ($arrData[$i]['estadoVisitante'] == 'Activo') {
                $arrData[$i]['estadoVisitante'] = '<span class="badge badge-success">Activo</span>';
            } elseif ($arrData[$i]['estadoVisitante'] == 'Inactivo') {
                $arrData[$i]['estadoVisitante'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            //configiración de permisos segín tipo usuario
            if (
                $_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>' ||
                $_SESSION['tipoUser'] == '<span class="badge badge-info">Guarda seguridad</span>'
            ) {
                $arrData[$i]['options'] = '<div class="text-center">
            <buttom class="btn btn-warning btn-sm btnEditAdmin" onClick="ftnEditVisit(' . $arrData[$i]['idVisitante'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></buttom>
            <buttom class="btn btn-danger btn-sm btnDelAdmin" onClick="fntDeleteVist(' . $arrData[$i]['idVisitante'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></buttom>
            </div>';
            } else {
                $arrData[$i]['options'] = "";
            }
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    //método para extraer un unico administrador
    public function getOneVisit(int $idVisit)
    {
        $intIdVisit = intval(limpiarCadena($idVisit));

        //empty (vacio) ó !empy(no esta vacio)
        if ($intIdVisit > 0) {
            $arrData = $this->model->selectVisitante($idVisit);
            if (empty($arrData)) {
                $arrResponse = array('estadoVisitante' => false, 'msg' => 'Datos no encontrado');
            } else {
                $arrResponse = array('estadoVisitante' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }    

    //método para eliminar los administradores
    public function delVisit()
    {
        if ($_POST) {
            $intIdVisit = intval($_POST['idVisitante']);
            $requestDelete = $this->model->deleteVisit($intIdVisit);
            if ($requestDelete) {
                $arrResponse = array('estadoVisitante' => true, 'msg' => 'Se ha inhabilitado el Visitante');
            } else {
                $arrResponse =
                    array('estadoVisitante' => false, 'msg' => 'Error al inhabilitar el Visitante');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
