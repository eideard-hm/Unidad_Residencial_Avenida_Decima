<?php

class VisitanteModel extends gestionCRUD
{
    //atributos de la tabla administrador    
    private $intIdVist;
    private $strNombres;
    private $strApellidos;
    private $strTipoDoc;
    private $intNumDoc;
    private $intTorre;
    private $intInterior;
    private $intApto;
    private $fchaIngreso;
    private $hrIngreso;
    private $fchaSalida;
    private $hrSalida;
    private $strEstado;

    public function __construct()
    {
        parent::__construct();
    }

    //método para extraer los datos de la base de datos
    public function selectVisit()
    {
        //extraer los administradores
        $sql = "SELECT idVisitante, nombreVisitante, apellidoVisitante, tipoDocumentoVisitante, 
        numeroDocumentoVisitante, numTorreDirige, numBloqueDirige, numApartamentoDirige, fechaIngresoVisitante,
         horaIngresoVisitante, fechaSalidaVisitante, horaSalidaVisitante, estadoVisitante FROM visitante
         WHERE estadoVisitante='Activo' ||  estadoVisitante='Inactivo'";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para extraer los datos de la base de datos
    public function selectVisitante($idVisit)
    {
        //buscar visitantes
        $this->intIdVist = $idVisit;

        //extraer los administradores
        $sql = "SELECT idVisitante, nombreVisitante, apellidoVisitante, tipoDocumentoVisitante, 
        numeroDocumentoVisitante, numTorreDirige, numBloqueDirige, numApartamentoDirige, fechaIngresoVisitante,
         horaIngresoVisitante, fechaSalidaVisitante, horaSalidaVisitante, estadoVisitante FROM visitante
         WHERE idVisitante=$this->intIdVist";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para insertar datos
    public function insertVisit(
        string $nombre,
        string $apellidos,
        string $tipoDoc,
        int $numDoc,
        int $torre,
        int $interior,
        int $apto,
        string $fchaEntrada,
        string $hrEntrada,
        string $fchaSalida,
        string $hrSalida,
        string $estado
    ) {
        $this->strNombres = $nombre;
        $this->strApellidos = $apellidos;
        $this->strTipoDoc = $tipoDoc;
        $this->intNumDoc = $numDoc;
        $this->intTorre = $torre;
        $this->intInterior = $interior;
        $this->intApto = $apto;
        $this->fchaIngreso = $fchaEntrada;
        $this->hrIngreso = $hrEntrada;
        $this->fchaSalida = $fchaSalida;
        $this->hrSalida = $hrSalida;
        $this->strEstado = $estado;
        $return = 0;

        //consutar si ya existe ese administrador
        $sql = "SELECT * FROM visitante WHERE numeroDocumentoVisitante = $this->intNumDoc";
        $request = $this->selectAll($sql);

        //validar si ya existe ese administrador
        //si esta vacio lo que trae request, es decir que si podemos alamcenar ese administrador
        if (empty($request)) {
            $queryInsert = "INSERT INTO visitante(nombreVisitante, apellidoVisitante, tipoDocumentoVisitante,
             numeroDocumentoVisitante, numTorreDirige, numBloqueDirige, numApartamentoDirige, 
             fechaIngresoVisitante, horaIngresoVisitante,fechaSalidaVisitante, horaSalidaVisitante, estadoVisitante)
             VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            //almacena los valores en un arreglo
            $arrData = array(
                $this->strNombres,
                $this->strApellidos,
                $this->strTipoDoc,
                $this->intNumDoc,
                $this->intTorre,
                $this->intInterior,
                $this->intApto,
                $this->fchaIngreso,
                $this->hrIngreso,
                $this->fchaSalida,
                $this->hrSalida,
                $this->strEstado
            );
            $requestInsert = $this->insert($queryInsert, $arrData);
            $return = $requestInsert;
        } else {
            $return = "exits";
        }
        return $return;
    }

    //método para modificar los administradores
    public function updateVist(
        $idVisit,
        $nombre,
        $apellidos,
        $tipoDoc,
        $numDoc,
        $torre,
        $interior,
        $apto,
        $fchaEntrada,
        $hrEntrada,
        $fchaSalida,
        $hrSalida,
        $estado
    ) {
        $this->intIdVist = $idVisit;
        $this->strNombres = $nombre;
        $this->strApellidos = $apellidos;
        $this->strTipoDoc = $tipoDoc;
        $this->intNumDoc = $numDoc;
        $this->intTorre = $torre;
        $this->intInterior = $interior;
        $this->intApto = $apto;
        $this->fchaIngreso = $fchaEntrada;
        $this->hrIngreso = $hrEntrada;
        $this->fchaSalida = $fchaSalida;
        $this->hrSalida = $hrSalida;
        $this->strEstado = $estado;

        $sql = "UPDATE visitante SET nombreVisitante=?, apellidoVisitante=?, tipoDocumentoVisitante=?,
             numeroDocumentoVisitante=?, numTorreDirige=?, numBloqueDirige=?, numApartamentoDirige=?, 
             fechaIngresoVisitante=?, horaIngresoVisitante=?,fechaSalidaVisitante=?, horaSalidaVisitante=?,
             estadoVisitante=? WHERE idVisitante = $this->intIdVist";
        $arrData = array(
            $this->strNombres,
            $this->strApellidos,
            $this->strTipoDoc,
            $this->intNumDoc,
            $this->intTorre,
            $this->intInterior,
            $this->intApto,
            $this->fchaIngreso,
            $this->hrIngreso,
            $this->fchaSalida,
            $this->hrSalida,
            $this->strEstado
        );

        $request = $this->update($sql, $arrData);
        return $request;
    }

    //método para eliminar el Visitante
    public function deleteVisit(int $idVisit)
    {
        $this->intIdVisit = $idVisit;
        $sql = "UPDATE visitante SET estadoVisitante = ? WHERE idVisitante = $this->intIdVisit";
        $arrData = array('Inhabilitar');
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
