<?php

class Cuenta_cobroModel extends gestionCRUD
{
    //atributos de la tabla Cuenta de Cobro   
    private $intIdCuenta;
    private $strFechaExpideCuenta;
    private $strFechaVencimientoPago;
    private $strEstadoCuenta;
    private $strPeriodoCuenta;
    private $strFechaPagoOportuno;
    private $strFechaConsignación;
    private $strValorPagoCuenta;

    public function __construct()
    {
        parent::__construct();
    }

    //método para extraer los datos de la base de datos
    public function selectCuenta()
    {
        //extraer las cuentas
        $sql = "SELECT idCuenta, fechaExpideCuenta, fechaVencimientoPago,
        estadoCuenta, periodoCuenta, fechaPagoOportuno, fechaConsignacion, 
        valorPagoCuenta FROM CUENTACOBRO WHERE  estadoCuenta = 'Pendiente' || 
        estadoCuenta = 'Cancelado' || estadoCuenta = 'Parcial'";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para extraer un unico registro
    public function selectCuen(int $idCuenta)
    {
        //buscar administradores
        $this->intIdCuenta = $idCuenta;
        $sql = "SELECT  idCuenta, fechaExpideCuenta, fechaVencimientoPago,
        estadoCuenta, periodoCuenta, fechaPagoOportuno, fechaConsignacion, 
        valorPagoCuenta FROM CUENTACOBRO WHERE idCuenta =  $this->intIdCuenta";
        $request = $this->select($sql);
        return $request;
    }

    //método para insertar datos
    public function insertCuenta(
        $fechaExpideCuenta,
        $fechaVencimientoPago,
        $estadoCuenta,
        $periodoCuenta,
        $fechaPagoOportuno,
        $fechaConsignacion,
        $pagoValorCuenta
    ) {
        $this->strFechaExpideCuenta = $fechaExpideCuenta;
        $this->strFechaVencimientoPago = $fechaVencimientoPago;
        $this->strEstadoCuenta = $estadoCuenta;
        $this->strPeriodoCuenta = $periodoCuenta;
        $this->strFechaPagoOportuno = $fechaPagoOportuno;
        $this->strFechaConsignación = $fechaConsignacion;
        $this->strValorPagoCuenta = $pagoValorCuenta;
        $return = 0;

        $queryInsert = "INSERT INTO CUENTACOBRO(fechaExpideCuenta, fechaVencimientoPago, estadoCuenta,
        periodoCuenta, fechaPagoOportuno, fechaConsignacion, valorPagoCuenta)
        VALUES (?,?,?,?,?,?,?)";
        //almacena los valores en un arreglo
        $arrData = array(
            $this->strFechaExpideCuenta = $fechaExpideCuenta,
            $this->strFechaVencimientoPago = $fechaVencimientoPago,
            $this->strEstadoCuenta = $estadoCuenta,
            $this->strPeriodoCuenta = $periodoCuenta,
            $this->strFechaPagoOportuno = $fechaPagoOportuno,
            $this->strFechaConsignación = $fechaConsignacion,
            $this->strValorPagoCuenta = $pagoValorCuenta
        );
        $requestInsert = $this->insert($queryInsert, $arrData);
        $return = $requestInsert;
        return $return;
    }

    //método para modificar los administradores
    public function updateCuenta(
        $idCuenta,
        $fechaExpideCuenta,
        $fechaVencimientoPago,
        $estadoCuenta,
        $periodoCuenta,
        $fechaPagoOportuno,
        $fechaConsignacion,
        $pagoValorCuenta

    ) {
        $this->intIdCuenta = $idCuenta;
        $this->strFechaExpideCuenta = $fechaExpideCuenta;
        $this->strFechaVencimientoPago = $fechaVencimientoPago;
        $this->strEstadoCuenta = $estadoCuenta;
        $this->strPeriodoCuenta = $periodoCuenta;
        $this->strFechaPagoOportuno = $fechaPagoOportuno;
        $this->strFechaConsignación = $fechaConsignacion;
        $this->strValorPagoCuenta = $pagoValorCuenta;

        $sql = "UPDATE CUENTACOBRO SET fechaExpideCuenta=?, fechaVencimientoPago=?, estadoCuenta=?,
        periodoCuenta=?, fechaPagoOportuno=?, fechaConsignacion=?, valorPagoCuenta=?
        WHERE idCuenta = $this->intIdCuenta";
        $arrData = array(           
            $this->strFechaExpideCuenta,
            $this->strFechaVencimientoPago,
            $this->strEstadoCuenta,
            $this->strPeriodoCuenta,
            $this->strFechaPagoOportuno,
            $this->strFechaConsignación,
            $this->strValorPagoCuenta
        );

        $request = $this->update($sql, $arrData);
        return $request;
    }

    //método para eliminar el administrador
    public function deleteCuentaCobro(int $idCuenta)
    {
        $this->intIdCuenta = $idCuenta;
        $sql = "UPDATE CUENTACOBRO SET estadoCuenta=? WHERE idCuenta = $this->intIdCuenta";
        $arrData = array('Inhabilitado');
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
