<?php

class AnuncioModel extends gestionCRUD
{
    //atributos de la tabla administrador    
    private $intIdAnuncio;
    private $strTitulo;
    private $strCuerpo;
    private $strInicio;
    private $strFin;
    private $strImagen;
    private $strEstadoA;

    public function __construct()
    {
        parent::__construct();
    }

    //método para extraer los datos de la base de datos
    public function selectAnun()
    {
        //extraer los administradores
        $sql = "SELECT idAnuncio, tituloAnuncio, cuerpoAnuncio,
        fechaInicioAnuncio, fechaFinAnuncio, imagenAnuncio, estadoAnuncio 
      FROM anuncio WHERE  estadoAnuncio='Activo' || estadoAnuncio='Inactivo'";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para extraer un unico registro
    public function selectAnuncio(int $idAnun)
    {
        //buscar administradores
        $this->intIdAnuncio = $idAnun;
        $sql = "SELECT idAnuncio, tituloAnuncio, cuerpoAnuncio,
        fechaInicioAnuncio, fechaFinAnuncio, imagenAnuncio, estadoAnuncio 
      FROM anuncio WHERE  estadoAnuncio='Activo' || estadoAnuncio='Inactivo'";
        $request = $this->selectAll($sql);
        return $request;
    }
    //método para insertar datos
    public function insertAnuncio(
        string $tituloAnuncio,
        string $cuerpoAnuncio,
        string $fechaInicioAnuncio,
        string $fechaFinAnuncio,
        string $imagenAnuncio,
        string $estadoAnuncio

    ) {
        $this->strTitulo = $tituloAnuncio;
        $this->strCuerpo = $cuerpoAnuncio;
        $this->strInicio = $fechaInicioAnuncio;
        $this->strFin = $fechaFinAnuncio;
        $this->strImagen = $imagenAnuncio;
        $this->strEstadoA = $estadoAnuncio;
        $return = 0;

        $queryInsert = "INSERT INTO anuncio(tituloAnuncio, cuerpoAnuncio,
            fechaInicioAnuncio, fechaFinAnuncio, imagenAnuncio, estadoAnuncio)
             VALUES (?,?,?,?,?,?)";
        //almacena los valores en un arreglo
        $arrData = array(           
            $this->strTitulo,
            $this->strCuerpo,
            $this->strInicio,
            $this->strFin,
            $this->strImagen,
            $this->strEstadoA,
        );
        $requestInsert = $this->insert($queryInsert, $arrData);
        $return = $requestInsert;

        return $return;
    }

    //método para modificar los administradores
    public function updateAnuncio(
        int $idAnuncio,
        string $tituloAnuncio,
        string $cuerpoAnuncio,
        string $fechaInicioAnuncio,
        string $fechaFinAnuncio,
        string $imagenAnuncio,
        string $estadoAnuncio       
    ) {
        $this->intIdAnuncio = $idAnuncio;
        $this->strTitulo = $tituloAnuncio;
        $this->strCuerpo = $cuerpoAnuncio;
        $this->strInicio = $fechaInicioAnuncio;
        $this->strFin = $fechaFinAnuncio;
        $this->strImagen = $imagenAnuncio;
        $this->strEstadoA = $estadoAnuncio;       

        //verificar si el email o la identificacion ya existe
        $sql = "SELECT * FROM anuncio WHERE idAnuncio = $this->intIdAnuncio";
        $request = $this->selectAll($sql);

        //procedemos a verificar si la variables request trae algun registro
        if (empty($request)) {
            $sql = "UPDATE anuncio SET tituloAnuncio=?,
            cuerpoAnuncio=?,fechaInicioAnuncio=?, fechaFinAnuncio=?,
            imagenAnuncio=?, estadoAnuncio=?
            WHERE idAnuncio = $this->intIdAdmin";
            $arrData = array(                
                $this - $tituloAnuncio,
                $this - $cuerpoAnuncio,
                $this - $fechaInicioAnuncio,
                $this - $fechaFinAnuncio,
                $this - $imagenAnuncio,
                $this - $estadoAnuncio
               
            );

            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    //método para eliminar el anuncio
    public function deleteAnuncio(int $idAnun)
    {
        $this->intIdAnuncio = $idAnun;
        $sql = "UPDATE anuncio SET estadoAnuncio=? WHERE idAnuncio = $this->intIdAnuncio";
        $arrData = array('Inhabilitado');
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
