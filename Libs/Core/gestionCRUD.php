<?php

class gestionCRUD extends Conexion
{
    //atributos
    private $conexion;
    private $strquery;
    private $arrValues;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    //método para la crud

    //método para insertar un registro
    public function insert(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;

        $insert = $this->conexion->prepare($this->strquery); //preparando el query
        $resInsert = $insert->execute($this->arrValues); //ejecutando el query para guardalro
        if ($resInsert) { //si devuleve true es que se alamaceno correctamente
            $lastInsert = $this->conexion->lastInsertId(); //que me devuelva el ultimo id alamacenado
        } else {
            $lastInsert = 0; //si no se almaceno va a deolver el valor de cero
        }
        return $lastInsert;
    }

    //método para consultar o buscar un registro
    public function select(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC); //por medio de data obtenemos el resultado por medo del fech(obtener un unico registro)
        return $data;
    }

    //método para traer todos los registros de la base de datos
    public function selectAll(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC); //e traer todos los registros por el fechAll(arreglos)
        return $data;
    }

    //método para actualizar un registro
    public  function update(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;
        $update = $this->conexion->prepare($this->strquery);
        $resExecute = $update->execute($this->arrValues);
        return $resExecute;
    }

    //método para eliminar un registro
    public function delete(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $eliminar = $result->execute();
        return $eliminar;
    }
}
