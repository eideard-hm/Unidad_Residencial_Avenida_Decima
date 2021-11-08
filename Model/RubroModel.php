<?php

class RubroModel extends gestionCRUD
{
    //atributos de la tabla administrador    
    private $intIdRubro;
    private $strNombreRubro;
    private $strDescripcionRubro;
    private $strValorRubro;
    private $strEstadoRubro;


    public function __construct()
    {
        parent::__construct();
    }

    //método para extraer los datos de la base de datos
    public function selectRubro()
    {
        //extraer los administradores
        $sql = "SELECT idRubro, nombreRubro, descripcionRubro, valorRubro, estadoRubro
        FROM Rubro WHERE  estadoRubro='Activo' || estadoRubro='Inactivo'";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para extraer un unico registro
    public function selectRubros(int $idRubros)
    {
        //buscar administradores
        $this->intIdRubro = $idRubros;
        $sql = "SELECT idRubro, nombreRubro, descripcionRubro, valorRubro, estadoRubro
        FROM Rubro WHERE idRubro = $this->intIdRubro";
        $request = $this->select($sql);
        return $request;
    }

    //método para insertar datos
    public function insertRubro(
        string $nombreRubro,
        string $descripcionRubro,
        string $inlineFormInputGroup,
        string $estadoRubro
    ) {
        $this->strNombreRubro = $nombreRubro;
        $this->strDescripcionRubro = $descripcionRubro;
        $this->strValorRubro = $inlineFormInputGroup;
        $this->strEstadoRubro = $estadoRubro;

        $return = 0;

        $queryInsert = "INSERT INTO rubro(nombreRubro, descripcionRubro, valorRubro, estadoRubro)
             VALUES (?,?,?,?)";
        //almacena los valores en un arreglo
        $arrData = array(
            $this->strNombreRubro,
            $this->strDescripcionRubro,
            $this->strValorRubro,
            $this->strEstadoRubro
        );
        $requestInsert = $this->insert($queryInsert, $arrData);
        $return = $requestInsert;
        return $return;
    }

    //método para modificar los administradores
    public function updateRubro(
        $idRubro,
        $nombreRubro,
        $descripcionRubro,
        $inlineFormInputGroup,
        $estadoRubro
    ) {
        $this->intIdRubro = $idRubro;
        $this->strNombreRubro = $nombreRubro;
        $this->strDescripcionRubro = $descripcionRubro;
        $this->strValorRubro = $inlineFormInputGroup;
        $this->strEstadoRubro = $estadoRubro;

        $sql = "UPDATE rubro SET nombreRubro=?, descripcionRubro=?, valorRubro=?, estadoRubro=?
                WHERE idRubro = $this->intIdRubro";
        $arrData = array(           
            $this->strNombreRubro,
            $this->strDescripcionRubro,
            $this->strValorRubro,
            $this->strEstadoRubro,
        );

        $request = $this->update($sql, $arrData);
        return $request;
    }

    //método para eliminar el rubro
    public function deleteRubro(int $idRubro)
    {
        $this->intIdRubro = $idRubro;
        $sql = "UPDATE rubro SET estadoRubro=? WHERE idRubro = $this->intIdRubro";
        $arrData = array('Inhabilitado');
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
