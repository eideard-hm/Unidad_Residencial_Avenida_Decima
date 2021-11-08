<?php

class EmpleadoModel extends gestionCRUD
{
    //atributos de la tabla administrador    
    private $intIdEmpleado;
    private $strNombresEmpleado;
    private $strApellidosEmpleado;
    private $strDocEmpleado;
    private $intNumDocEmpleado;
    private $intTelefonoEmpleado;
    private $strCargoEmpleado;
    private $strARLEmpleado;
    private $strEstadoEmpleado;


    public function __construct()
    {
        parent::__construct();
    }

    //método para extraer los datos de la base de datos
    public function selectEmpleado()
    {
        //extraer los administradores
        $sql = "SELECT idEmpleado, nombresEmpleado, apellidosEmpleado, tipoDocumentoEmpleado, numDocumentoEmpleado,
        telefonoEmpleado, cargoEmpleado, ARLEmpleado, estadoEmpleado
        FROM Empleado WHERE  estadoEmpleado='Activo' || estadoEmpleado='Inactivo'";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para extraer un unico registro
    public function selectEmpleados(int $idEmpleados)
    {
        //buscar administradores
        $this->intIdEmpleado = $idEmpleados;
        $sql = "SELECT idEmpleado, nombresEmpleado, apellidosEmpleado, tipoDocumentoEmpleado, numDocumentoEmpleado,
        telefonoEmpleado, cargoEmpleado, ARLEmpleado, estadoEmpleado
        FROM Empleado WHERE idEmpleado = $this->intIdEmpleado";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para insertar datos
    public function insertEmpleado(
        string $nombreEmpleado,
        string $apellidosEmpleado,
        string $tipoDocEmpleado,
        int $numDocEmpleado,
        int $numTelEmpleado,
        string $cargoEmpleado,
        string $ARLEmpleado,
        string $estadoEmpleado
    ) {
        $this->strNombresEmpleado = $nombreEmpleado;
        $this->strApellidosEmpleado = $apellidosEmpleado;
        $this->strDocEmpleado = $tipoDocEmpleado;
        $this->intNumDocEmpleado = $numDocEmpleado;
        $this->intTelefonoEmpleado = $numTelEmpleado;
        $this->strCargoEmpleado = $cargoEmpleado;
        $this->strARLEmpleado = $ARLEmpleado;
        $this->strEstadoEmpleado = $estadoEmpleado;

        $return = 0;

        //consutar si ya existe ese administrador
        $sql = "SELECT * FROM empleado WHERE numDocumentoEmpleado = '{$this->intNumDocEmpleado}'";
        $request = $this->selectAll($sql);

        //validar si ya existe ese rubro
        //si esta vacio lo que trae request, es decir que si podemos alamcenar ese rubro
        if (empty($request)) {
            $queryInsert = "INSERT INTO empleado(nombresEmpleado, apellidosEmpleado, tipoDocumentoEmpleado,
            numDocumentoEmpleado, telefonoEmpleado, cargoEmpleado, ARLEmpleado, estadoEmpleado)
             VALUES (?,?,?,?,?,?,?,?)";
            //almacena los valores en un arreglo
            $arrData = array(
                $this->strNombresEmpleado,
                $this->strApellidosEmpleado,
                $this->strDocEmpleado,
                $this->intNumDocEmpleado,
                $this->intTelefonoEmpleado,
                $this->strCargoEmpleado,
                $this->strARLEmpleado,
                $this->strEstadoEmpleado,
            );
            $requestInsert = $this->insert($queryInsert, $arrData);
            $return = $requestInsert;
        } else {
            $return = "exits";
        }
        return $return;
    }

    //método para modificar los administradores
    public function updateEmpleado(
        int $idEmpleado,
        string $nombreEmpleado,
        string $apellidosEmpleado,
        string $tipoDocEmpleado,
        int $numDocEmpleado,
        int $numTelEmpleado,
        string $cargoEmpleado,
        string $ARLEmpleado,
        string $estadoEmpleado

    ) {
        $this->intidEmpleado = $idEmpleado;
        $this->strNombresEmpleado = $nombreEmpleado;
        $this->strApellidosEmpleado = $apellidosEmpleado;
        $this->strDocEmpleado = $tipoDocEmpleado;
        $this->intNumDocEmpleado = $numDocEmpleado;
        $this->intTelefonoEmpleado = $numTelEmpleado;
        $this->strCargoEmpleado = $cargoEmpleado;
        $this->strARLEmpleado = $ARLEmpleado;
        $this->strEstadoEmpleado = $estadoEmpleado;

        //verificar si el email o la identificacion ya existe
        $sql = "SELECT * FROM empleado WHERE (numDocumentoEmpleado = '{$this->intNumDocEmpleado}' AND 
        idEmpleado != $this->intidEmpleado)";
        $request = $this->selectAll($sql);

        //procedemos a verificar si la variables request trae algun registro
        if (empty($request)) {
            $sql = "UPDATE empleado SET nombresEmpleado=?, apellidosEmpleado=?, tipoDocumentoEmpleado=?, 
            numDocumentoEmpleado=?, telefonoEmpleado=?, cargoEmpleado=?, ARLEmpleado=?, estadoEmpleado=?
            WHERE idEmpleado = $this->intIdEmpleado";
            $arrData = array(               
                $this->strNombresEmpleado,
                $this->strApellidosEmpleado,
                $this->strDocEmpleado,
                $this->intNumDocEmpleado,
                $this->intTelefonoEmpleado,
                $this->strCargoEmpleado,
                $this->strARLEmpleado,
                $this->strEstadoEmpleado
            );

            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    //método para eliminar el empleado
    public function deleteEmpleado(int $idEmpleados)
    {
        $this->intIdEmpleado = $idEmpleados;
        $sql = "UPDATE empleado SET estadoEmpleado=? WHERE idEmpleado = $this->intIdEmpleado";
        $arrData = array('Inhabilitado');
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
