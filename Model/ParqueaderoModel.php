<?php

class ParqueaderoModel extends gestionCRUD
{
    //atributos de la tabla administrador    
    private $intIdParq;
    private $strUsoParq;
    private $strEstadoParq;
    private $strTipoParq;


    public function __construct()
    {
        parent::__construct();
    }

    //método para extraer los datos de la base de datos
    public function selectParq()
    {
        //extraer los administradores
        $sql = "SELECT idParqueadero, usoParqueadero, estadoParqueadero, tipoParqueadero
        FROM parqueadero";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para extraer un unico registro
    public function selectParqueadero(int $idParq)
    {
        //buscar administradores
        $this->intIdParq = $idParq;
        $sql = "SELECT idParqueadero, usoParqueadero, estadoParqueadero, tipoParqueadero
        FROM parqueadero WHERE idParqueadero = $this->intIdParq";
        $request = $this->select($sql);
        return $request;
    }

    //método para insertar datos
    public function insertParq(
        string $usoParq,
        string $estadoParq,
        string $tipoParq

    ) {
        $this->strUsoParq = $usoParq;
        $this->strEstadoParq = $estadoParq;
        $this->strTipoParq = $tipoParq;

        $return = 0;

        $queryInsert = "INSERT INTO parqueadero(usoParqueadero, estadoParqueadero, tipoParqueadero)
             VALUES (?,?,?)";
        //almacena los valores en un arreglo
        $arrData = array(
            $this->strUsoParq,
            $this->strEstadoParq,
            $this->strTipoParq
        );
        $requestInsert = $this->insert($queryInsert, $arrData);
        $return = $requestInsert;

        return $return;
    }

    //método para modificar los administradores
    public function updateParq(
        int $idParq,
        string $usoParq,
        string $estadoParq,
        string $tipoParq
    ) {
        $this->intIdParq = $idParq;
        $this->strUsoParq = $usoParq;
        $this->strEstadoParq = $estadoParq;
        $this->strTipoParq = $tipoParq;

        $sql = "UPDATE parqueadero SET usoParqueadero =?, estadoParqueadero=?, tipoParqueadero=?
            WHERE idParqueadero = $this->intIdParq";
        $arrData = array(            
            $this->strUsoParq,
            $this->strEstadoParq,
            $this->strTipoParq
        );

        $request = $this->update($sql, $arrData);
        return $request;
    }

    //método para eliminar el administrador
    public function deleteParq(int $idParq)
    {
        $this->intIdParq = $idParq;
        $sql = "DELETE FROM parqueadero WHERE idParqueadero=$this->intIdParq";
        $request = $this->delete($sql);
        return $request;
    }
}
