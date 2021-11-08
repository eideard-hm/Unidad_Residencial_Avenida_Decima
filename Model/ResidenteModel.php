<?php

class ResidenteModel extends gestionCRUD
{
    //atributos de la tabla residente   
    private $intIdResid;
    private $strEmail;
    private $strPass;
    private $strNombres;
    private $strApellidos;
    private $strTipoDoc;
    private $intNumDoc;
    private $intTel;
    private $intTelFij;
    private $intTorre;
    private $intInterior;
    private $intApto;
    private $strEstado;
    private $intTipoUsu;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectResid()
    {
        //extraer los administradores
        $sql = "SELECT id, correo, nombres, apellidos,
        tipoDocumento, numDocumento, telefono, telFijo,numTorre, numBloque,
        numApartamento, estado FROM residente WHERE estado='Activo' || estado='Inactivo'";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para extraer un unico registro
    public function selectResidente(int $idResid)
    {
        //buscar residente
        $this->intIdResid = $idResid;
        $sql = "SELECT id, correo, passwordU, nombres, apellidos,
        tipoDocumento, numDocumento, telefono, telFijo,numTorre, numBloque,
        numApartamento, estado FROM residente WHERE id = $this->intIdResid";
        $request = $this->select($sql);
        return $request;
    }

    //método para insertar datos
    public function insertResid(
        string $email,
        string $pass,
        string $nombres,
        string $apellidos,
        string $tipoDoc,
        int $numDoc,
        int $tel,
        int $telFij,
        int $torre,
        int $interior,
        int $apto,
        string $estado,
        int $tipoUsu
    ) {
        $this->strEmail = $email;
        $this->strPass = $pass;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->strTipoDoc = $tipoDoc;
        $this->intNumDoc = $numDoc;
        $this->intTel = $tel;
        $this->intTelFij = $telFij;
        $this->intTorre = $torre;
        $this->intInterior = $interior;
        $this->intApto = $apto;
        $this->strEstado = $estado;
        $this->intTipoUsu = $tipoUsu;
        $return = 0;

        //consutar si ya existe ese administrador
        $sql = "SELECT * FROM residente WHERE correo = '{$this->strEmail}' or 
        numDocumento = '{$this->intNumDoc}'";
        $request = $this->selectAll($sql);

        //validar si ya existe ese rol
        //si esta vacio lo que trae request, es decir que si podemos alamcenar ese administrador
        if (empty($request)) {
            $queryInsert = "INSERT INTO residente(correo, passwordU, nombres,
            apellidos,tipoDocumento, numDocumento, telefono, 
            telFijo,numTorre, numBloque, numApartamento, estado,
            tipoUsuario)
             VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            //almacena los valores en un arreglo
            $arrData = array(
                $this->strEmail,
                $this->strPass,
                $this->strNombres,
                $this->strApellidos,
                $this->strTipoDoc,
                $this->intNumDoc,
                $this->intTel,
                $this->intTelFij,
                $this->intTorre,
                $this->intInterior,
                $this->intApto,
                $this->strEstado,
                $this->intTipoUsu
            );
            $requestInsert = $this->insert($queryInsert, $arrData);
            $return = $requestInsert;
        } else {
            $return = "exits";
        }
        return $return;
    }

    //método para modificar los residentes
    public function updateResid(
        int $idResid,
        string $email,
        string $pass,
        string $nombres,
        string $apellidos,
        string $tipoDoc,
        int $numDoc,
        int $tel,
        int $telFij,
        int $torre,
        int $interior,
        int $apto,
        string $estado
        // int $tipoUsu
    ) {
        $this->intIdResid = $idResid;
        $this->strEmail = $email;
        $this->strPass = $pass;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->strTipoDoc = $tipoDoc;
        $this->intNumDoc = $numDoc;
        $this->intTel = $tel;
        $this->intTelFij = $telFij;
        $this->intTorre = $torre;
        $this->intInterior = $interior;
        $this->intApto = $apto;
        $this->strEstado = $estado;
        //$this->intTipoUsu = $tipoUsu;

        //verificar si el email o la identificacion ya existe
        $sql = "SELECT * FROM residente WHERE (correo = '{$this->strEmail}' AND id != $this->intIdResid)
        OR (numDocumento = $this->intNumDoc AND id !=$this->intIdResid)";
        $request = $this->selectAll($sql);

        //procedemos a verificar si la variables request trae algun registro
        if (empty($request)) {
            $sql = "UPDATE residente SET correo=?, passwordU=?, nombres=?,
            apellidos=?,tipoDocumento=?, numDocumento=?, telefono=?, 
            telFijo=?,numTorre=?, numBloque=?, numApartamento=?, estado=?
            WHERE id = $this->intIdResid";
            $arrData = array(
                $this->strEmail,
                $this->strPass,
                $this->strNombres,
                $this->strApellidos,
                $this->strTipoDoc,
                $this->intNumDoc,
                $this->intTel,
                $this->intTelFij,
                $this->intTorre,
                $this->intInterior,
                $this->intApto,
                $this->strEstado,
                //$this->intTipoUsu = $t,
            );

            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    //método para inhabilitar residente
    public function deleteAdmin(int $idResid)
    {
        $this->intIdResid = $idResid;
        $sql = "UPDATE residente SET estado=? WHERE id = $this->intIdResid";
        $arrData = array('Inhabilitado');
        $request = $this->update($sql, $arrData);
        return $request;
    }

    //--------------------funciones con procedimientos de almacendo

    //método para insertar datos
    public function PinsertResid(
        string $email,
        string $pass,
        string $nombres,
        string $apellidos,
        string $tipoDoc,
        int $numDoc,
        int $tel,
        int $telFij,
        int $torre,
        int $interior,
        int $apto,
        string $estado,
        int $tipoUsu
    ) {
        $this->strEmail = $email;
        $this->strPass = $pass;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->strTipoDoc = $tipoDoc;
        $this->intNumDoc = $numDoc;
        $this->intTel = $tel;
        $this->intTelFij = $telFij;
        $this->intTorre = $torre;
        $this->intInterior = $interior;
        $this->intApto = $apto;
        $this->strEstado = $estado;
        $this->intTipoUsu = $tipoUsu;
        $return = 0;

        //consutar si ya existe ese administrador
        $sql = "SELECT * FROM residente WHERE correo = '{$this->strEmail}' or 
        numDocumento = '{$this->intNumDoc}'";
        $request = $this->selectAll($sql);

        //validar si ya existe ese rol
        //si esta vacio lo que trae request, es decir que si podemos alamcenar ese administrador
        if (empty($request)) {
            $queryInsert = "insertResid($email, $pass, $nombres, $apellidos, $tipoDoc, $numDoc, $tel, $telFij,
            $torre, $interior, $apto, $estado, $tipoUsu)";
            
            //almacena los valores en un arreglo
            $arrData = array(
                $this->strEmail,
                $this->strPass,
                $this->strNombres,
                $this->strApellidos,
                $this->strTipoDoc,
                $this->intNumDoc,
                $this->intTel,
                $this->intTelFij,
                $this->intTorre,
                $this->intInterior,
                $this->intApto,
                $this->strEstado,
                $this->intTipoUsu
            );
            $requestInsert = $this->insert($queryInsert, $arrData);
            $return = $requestInsert;
        } else {
            $return = "exits";
        }
        return $return;
    }

    //método para modificar los residentes
    public function PupdateResid(
        int $idResid,
        string $email,
        string $pass,
        string $nombres,
        string $apellidos,
        string $tipoDoc,
        int $numDoc,
        int $tel,
        int $telFij,
        int $torre,
        int $interior,
        int $apto,
        string $estado
        // int $tipoUsu
    ) {
        $this->intIdResid = $idResid;
        $this->strEmail = $email;
        $this->strPass = $pass;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->strTipoDoc = $tipoDoc;
        $this->intNumDoc = $numDoc;
        $this->intTel = $tel;
        $this->intTelFij = $telFij;
        $this->intTorre = $torre;
        $this->intInterior = $interior;
        $this->intApto = $apto;
        $this->strEstado = $estado;
        //$this->intTipoUsu = $tipoUsu;

        //verificar si el email o la identificacion ya existe
        $sql = "SELECT * FROM residente WHERE (correo = '{$this->strEmail}' AND id != $this->intIdResid)
        OR (numDocumento = $this->intNumDoc AND id !=$this->intIdResid)";
        $request = $this->selectAll($sql);

        //procedemos a verificar si la variables request trae algun registro
        if (empty($request)) {
            $sql = "updateResidente($email, $pass, $nombres, $apellidos, $tipoDoc, $numDoc, $tel, $telFij,
            $torre, $interior, $apto, $estado)";
            $arrData = array(
                $this->strEmail,
                $this->strPass,
                $this->strNombres,
                $this->strApellidos,
                $this->strTipoDoc,
                $this->intNumDoc,
                $this->intTel,
                $this->intTelFij,
                $this->intTorre,
                $this->intInterior,
                $this->intApto,
                $this->strEstado,
                //$this->intTipoUsu = $t,
            );

            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    //método para inhabilitar residente
    public function PdeleteAdmin(int $idResid)
    {
        $this->intIdResid = $idResid;
        $sql = "deleteResid($idResid)";
        $arrData = array('Inhabilitado');
        $request = $this->update($sql, $arrData);
        return $request;
    }
}


