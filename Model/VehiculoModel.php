<?php

class VehiculoModel extends gestionCRUD
{
    //atributos de la tabla administrador    
    private $intIdVehiculo;
    private $strPlaca;
    private $intModelo;
    private $strMarca;
    private $strColor;
    private $strTipo;


    public function __construct()
    {
        parent::__construct();
    }

    //método para extraer los datos de la base de datos
    public function selectVehi()
    {
        //extraer los administradores
        $sql = "SELECT idVehiculo, placaVehiculo, modeloVehiculo, marcaVehiculo, colorVehiculo, tipoVehiculo FROM
        vehiculo";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para extraer un unico registro
    public function selectVehiculo(int $idVehiculo)
    {
        //buscar administradores
        $this->intIdVehiculo = $idVehiculo;
        $sql = "SELECT idVehiculo, placaVehiculo, modeloVehiculo, marcaVehiculo, colorVehiculo, tipoVehiculo
        FROM vehiculo WHERE idVehiculo = $this->intIdVehiculo";
        $request = $this->select($sql);
        return $request;
    }

    //método para insertar datos
    public function insertVehi(
        string $placa,
        int $modelo,
        string $marca,
        string $color,
        string $tipo
    ) {
        $this->strPlaca = $placa;
        $this->intModelo = $modelo;
        $this->strMarca = $marca;
        $this->strColor = $color;
        $this->strTipo = $tipo;
        $return = 0;

        $queryInsert = "INSERT INTO vehiculo(placaVehiculo, modeloVehiculo, marcaVehiculo, colorVehiculo, tipoVehiculo)
             VALUES (?,?,?,?,?)";
        //almacena los valores en un arreglo
        $arrData = array(
            $this->strPlaca,
            $this->intModelo,
            $this->strMarca,
            $this->strColor,
            $this->strTipo
        );
        $requestInsert = $this->insert($queryInsert, $arrData);
        $return = $requestInsert;

        return $return;
    }

    //método para modificar los administradores
    public function updateVehi(
        int $idVehiculo,
        string $placa,
        int $modelo,
        string $marca,
        string $color,
        string $tipo
    ) {
        $this->intIdVehiculo = $idVehiculo;
        $this->strPlaca = $placa;
        $this->intModelo = $modelo;
        $this->strMarca = $marca;
        $this->strColor = $color;
        $this->strTipo = $tipo;

        $sql = "UPDATE vehiculo SET placaVehiculo =?, modeloVehiculo=?, marcaVehiculo=?, 
            colorVehiculo=?, tipoVehiculo=? WHERE idVehiculo = $this->intIdVehiculo";
        $arrData = array(
            $this->strPlaca,
            $this->intModelo,
            $this->strMarca,
            $this->strColor,
            $this->strTipo
        );
        $request = $this->update($sql, $arrData);

        return $request;
    }

    //método para eliminar el administrador
    public function deleteVehi(int $idVehi)
    {
        $this->intIdVehiculo = $idVehi;
        $sql = "DELETE FROM vehiculo WHERE idVehiculo = $this->intIdVehiculo";
        $request = $this->delete($sql);
        return $request;
    }
}
