<?php
class Anuncio extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url());
        }
    }

    public function Anuncio()
    {
        $data['titulo_pagina'] = "Anuncio | Unidad Residencial Avenida Décima";
        $this->view->getView($this, "Anuncio", $data);
    }

    public function setAnuncio()
    {
        if ($_POST) {

            //verificar que ningun campo este vació
            if (
                empty($_POST['tituloAnuncio']) || empty($_POST['cuerpoAnuncio'])
                || empty($_POST['fechaInicioAnuncio']) || empty($_POST['fechaFinAnuncio']) ||
                empty($_POST['estadoAnuncio'])
            ) {
                $arrResponse = array("estadoAnuncio" => false, "msg" => "Los datos ingresado son incorrectos :(");
            } else {
                $intIdAnuncio = intval($_POST['idAnuncio']);
                $strTitulo = ucfirst((limpiarCadena($_POST['tituloAnuncio'])));
                $strCuerpo = limpiarCadena($_POST['cuerpoAnuncio']);
                $strInicio = limpiarCadena($_POST['fechaInicioAnuncio']);
                $strFin = limpiarCadena($_POST['fechaFinAnuncio']);
                $strImagen = addslashes(file_get_contents($_FILES['imagenAnuncio']['tmp_name']));
                $strEstadoA = ($_POST['estadoAnuncio']);

                //método par actualizar e insertar
                if ($intIdAnuncio == 0) {
                    /*-----------------INSERTAR ANUNCIO ---------------*/
                    $option = 1;
                    //encriptar las contraseñas
                    //INSERTAR LOS DATOS EN EL MODELO DEL ANUNCIO
                    $request_anuncio = $this->model->insertAnuncio(
                        $strTitulo,
                        $strCuerpo,
                        $strInicio,
                        $strFin,
                        $strImagen,
                        $strEstadoA
                    );
                } else {
                    /*-----------------------------ACTUALIZAR ANUNCIO---------- */
                    $option = 2;

                    //INSERTAR LOS DATOS EN EL MODELO DEL ANUNCIO
                    $request_anuncio = $this->model->updateAnuncio(
                        $intIdAnuncio,
                        $strTitulo,
                        $strCuerpo,
                        $strInicio,
                        $strFin,
                        $strImagen,
                        $strEstadoA
                    );
                }

                //evaluar si la respuesta es mayor a cero, quiero decir que si se inserto
                if ($request_anuncio > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estadoAnuncio' => true, 'msg' => 'Datos almacenados correctamente :)');
                    } elseif ($option == 2) {
                        $arrResponse = array('estadoAnuncio' => true, 'msg' => 'Datos actualizados correctamente :)');
                    }
                } elseif ($request_anuncio == 'exits') {
                    $arrResponse = array('estadoAnuncio' => false, 'msg' => '!Atención! el anuncio ya existe. Intenta con otro');
                } else {
                    $arrResponse = array('estadoAnuncio' => false, 'msg' => 'No es posible almacenar los datos :(');
                }
            }
            //retornar el valor de array en formato json
            print_r(json_encode($arrResponse, JSON_UNESCAPED_UNICODE));
        }
        die(); //detener o cerrar el proceso
    }

    public function getAnuncio()
    {
        $arrData = $this->model->selectAnun();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estadoAnuncio'] == 'Activo') {
                $arrData[$i]['estadoAnuncio'] = '<span class="badge badge-success">Activo</span>';
            } elseif ($arrData[$i]['estadoAnuncio'] == 'Inactivo') {
                $arrData[$i]['estadoAnuncio'] = '<span class="badge badge-danger">Inactivo</span>';
            }
            if ($_SESSION['tipoUser'] == '<span class="badge badge-success">Administrador</span>') {
                $arrData[$i]['options'] = '<div class="text-center">
            <buttom class="btn btn-warning btn-sm btnEditAnuncio" onClick="ftnEditAnuncio(' . $arrData[$i]['idAnuncio'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></buttom>
            <buttom class="btn btn-danger btn-sm btnDelAnuncio" onClick="fntDeleteAnuncio(' . $arrData[$i]['idAnuncio'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></buttom>
            </div>';
            }
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    //método para extraer un unico administrador
    public function getOneAnuncio(int $idAnuncio)
    {
        $intIdAnuncio = intval(limpiarCadena($idAnuncio));

        //empty (vacio) ó !empy(no esta vacio)
        if ($intIdAnuncio > 0) {
            $arrData = $this->model->selectAnuncio($intIdAnuncio);
            if (empty($arrData)) {
                $arrResponse = array('estadoAnuncio' => false, 'msg' => 'Datos no encontrado');
            } else {
                $arrResponse = array('estadoAnuncio' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //método para eliminar los anuncios
    public function delAnun()
    {
        if ($_POST) {
            $intIdAnuncio = intval($_POST['idAnuncio']);
            $requestDelete = $this->model->deleteAnuncio($intIdAnuncio);
            if ($requestDelete) {
                $arrResponse = array('estadoAnuncio' => true, 'msg' => 'Se ha inhabilitado el Anuncio');
            } else {
                $arrResponse =
                    array('estadoAdministrador' => false, 'msg' => 'Error al inhabilitar el Anuncio');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
