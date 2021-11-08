<?php

class Guarda_seguridadModel extends gestionCRUD
{
    //atributos de la tabla administrador    
    private $intIdGuarda;
    private $strEmail;
    private $strPass;
    private $strNombres;
    private $strApellidos;
    private $strTipoDoc;
    private $intNumDoc;
    private $intTel;
    private $strEstado;
    private $intTipoUsu;


    public function __construct()
    {
        parent::__construct();
    }

    public function selectGuarda()
    {
        //extraer los administradores
        $sql = "SELECT id, correo, nombres,
        apellidos, tipoDocumento, numDocumento, telefono, 
        estado FROM guarda_seguridad WHERE estado='Activo' || estado='Inactivo'";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para extraer un unico registro
    public function selectGuardaSeguridad(int $idGuarda)
    {
        //buscar administradores
        $this->intIdGuarda = $idGuarda;
        $sql = "SELECT id, correo,passwordU, nombres,
            apellidos, tipoDocumento, numDocumento, telefono,
            estado FROM guarda_seguridad WHERE id = $this->intIdGuarda";
        $request = $this->select($sql);
        return $request;
    }

    //método para insertar datos guarda
    public function insertGuarda(
        string $email,
        string $pass,
        string $nombres,
        string $apellidos,
        string $tipoDoc,
        int $numDoc,
        int $tel,
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
        $this->strEstado = $estado;
        $this->intTipoUsu = $tipoUsu;
        $return = 0;

        //consutar si ya existe ese administrador
        $sql = "SELECT * FROM guarda_seguridad WHERE correo = '{$this->strEmail}' or 
        numDocumento = '{$this->intNumDoc}'";
        $request = $this->selectAll($sql);

        //validar si ya existe ese guarda
        //si esta vacio lo que trae request, es decir que si podemos alamcenar ese administrador
        if (empty($request)) {
            $queryInsert = "INSERT INTO guarda_seguridad(correo, passwordU, nombres,
            apellidos, tipoDocumento, numDocumento, telefono,
            estado, tipoUsuario)
             VALUES (?,?,?,?,?,?,?,?,?)";
            //almacena los valores en un arreglo
            $arrData = array(
                $this->strEmail,
                $this->strPass,
                $this->strNombres,
                $this->strApellidos,
                $this->strTipoDoc,
                $this->intNumDoc,
                $this->intTel,
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

    //método para modificar los administradores
    public function updateGuarda(
        int $idGuarda,
        string $email,
        string $pass,
        string $nombres,
        string $apellidos,
        string $tipoDoc,
        int $numDoc,
        int $tel,
        string $estado
    ) {
        $this->intIdGuarda = $idGuarda;
        $this->strEmail = $email;
        $this->strPass = $pass;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->strTipoDoc = $tipoDoc;
        $this->intNumDoc = $numDoc;
        $this->intTel = $tel;
        $this->strEstado = $estado;

        //verificar si el email o la identificacion ya existe
        $sql = "SELECT * FROM guarda_seguridad WHERE (correo = '{$this->strEmail}' AND id != $this->intIdGuarda)
        OR (numDocumento = $this->intNumDoc AND id != $this->intIdGuarda)";
        $request = $this->selectAll($sql);

        //procedemos a verificar si la variables request trae algun registro
        if (empty($request)) {
            $sql = "UPDATE guarda_seguridad SET correo=?,passwordU=?,
            nombres=?,apellidos=?, tipoDocumento=?,
            numDocumento=?, telefono=?,estado=?
            WHERE id = $this->intIdGuarda";
            $arrData = array(
                $this->strEmail,
                $this->strPass,
                $this->strNombres,
                $this->strApellidos,
                $this->strTipoDoc,
                $this->intNumDoc,
                $this->intTel,
                $this->strEstado
            );

            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    //método para eliminar el guardas
    public function deleteGuarda(int $idGuarda)
    {
        $this->intIdGuarda = $idGuarda;
        $sql = "UPDATE guarda_seguridad SET estado=? WHERE id = $this->intIdGuarda";
        $arrData = array('Inhabilitado');
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
