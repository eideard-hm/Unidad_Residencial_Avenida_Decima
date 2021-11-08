<?php

class AdministradorModel extends gestionCRUD
{
    //atributos de la tabla administrador    
    private $intIdAdmin;
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

    //método para extraer los datos de la base de datos
    public function selectAdmin()
    {
        //extraer los administradores        
        $sql = "SELECT id, correo, nombres,
        apellidos, tipoDocumento, numDocumento, telefono, 
        estado FROM administrador WHERE  estado='Activo' || estado='Inactivo'";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para extraer un unico registro
    public function selectAdministrador(int $idAdmin)
    {
        //buscar administradores
        $this->intIdAdmin = $idAdmin;
        $sql = "SELECT id, correo,passwordU, nombres,
            apellidos, tipoDocumento, numDocumento, telefono,
            estado FROM administrador WHERE id = $this->intIdAdmin";
        $request = $this->select($sql);
        return $request;
    }

    //método para insertar datos
    public function insertAdmin(
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
        $sql = "SELECT * FROM administrador WHERE correo = '{$this->strEmail}' or 
        numDocumento = '{$this->intNumDoc}'";
        $request = $this->selectAll($sql);

        //validar si ya existe ese administrador
        //si esta vacio lo que trae request, es decir que si podemos alamcenar ese administrador
        if (empty($request)) {
            $queryInsert = "INSERT INTO administrador(correo, passwordU, nombres,
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
    public function updateAdmin(
        int $idAdmin,
        string $email,
        string $pass,
        string $nombres,
        string $apellidos,
        string $tipoDoc,
        int $numDoc,
        int $tel,
        string $estado
        //int $tipoUsu
    ) {
        $this->intIdAdmin = $idAdmin;
        $this->strEmail = $email;
        $this->strPass = $pass;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->strTipoDoc = $tipoDoc;
        $this->intNumDoc = $numDoc;
        $this->intTel = $tel;
        $this->strEstado = $estado;      

        //verificar si el email o la identificacion ya existe
        $sql = "SELECT * FROM administrador WHERE (correo = '{$this->strEmail}' AND id != $this->intIdAdmin)
        OR (numDocumento = $this->intNumDoc AND id !=$this->intIdAdmin)";
        $request = $this->selectAll($sql);

        //procedemos a verificar si la variables request trae algun registro
        if (empty($request)) {
            $sql = "UPDATE administrador SET correo=?,passwordU=?, nombres=?,apellidos=?, tipoDocumento=?,
            numDocumento=?, telefono=?,estado=?
            WHERE id = $this->intIdAdmin";
            $arrData = array(
                $this->strEmail,
                $this->strPass,
                $this->strNombres,
                $this->strApellidos,
                $this->strTipoDoc,
                $this->intNumDoc,
                $this->intTel,
                $this->strEstado,               
            );

            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    //método para eliminar el administrador
    public function deleteAdmin(int $idAdmin)
    {
        $this->intIdAdmin = $idAdmin;
        $sql = "UPDATE administrador SET estado=? WHERE id = $this->intIdAdmin";
        $arrData = array('Inhabilitado');
        $request = $this->update($sql, $arrData);
        return $request;
    }

    //-----------------funciones con procedimientos de almacenado---------------------

    public function PinsertAdmin(
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
        $sql = "SELECT * FROM administrador WHERE correo = '{$this->strEmail}' or 
        numDocumento = '{$this->intNumDoc}'";
        $request = $this->selectAll($sql);

        //validar si ya existe ese administrador
        //si esta vacio lo que trae request, es decir que si podemos alamcenar ese administrador
        if (empty($request)) {
            $sql =  "CALL insertAdmin($email, $pass, $nombres, $apellidos, $tipoDoc, $numDoc, $tel, $estado)";
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
            $requestInsert = $this->insert($sql, $arrData);
            $return = $requestInsert;
        } else {
            $return = "exits";
        }
        return $return;
    }

    public function PupdateAdmin(
        int $idAdmin,
        string $email,
        string $pass,
        string $nombres,
        string $apellidos,
        string $tipoDoc,
        int $numDoc,
        int $tel,
        string $estado
        //int $tipoUsu
    ) {
        $this->intIdAdmin = $idAdmin;
        $this->strEmail = $email;
        $this->strPass = $pass;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->strTipoDoc = $tipoDoc;
        $this->intNumDoc = $numDoc;
        $this->intTel = $tel;
        $this->strEstado = $estado;
        //$this->intTipoUsu = $tipoUsu;

        //verificar si el email o la identificacion ya existe
        $sql = "SELECT * FROM administrador WHERE (correo = '{$this->strEmail}' AND id != $this->intIdAdmin)
        OR (numDocumento = $this->intNumDoc AND id !=$this->intIdAdmin)";
        $request = $this->selectAll($sql);

        //procedemos a verificar si la variables request trae algun registro
        if (empty($request)) {
            $sql = "CALL updateAdmin($idAdmin, $email, $pass, $nombres, $apellidos, $tipoDoc, $numDoc, $tel, $estado)";
            $arrData = array(
                $this->strEmail,
                $this->strPass,
                $this->strNombres,
                $this->strApellidos,
                $this->strTipoDoc,
                $this->intNumDoc,
                $this->intTel,
                $this->strEstado,
                //$this->intTipoUsu
            );

            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function PselectAdmin($idAdmin, $email, $pass, $nombres, $apellidos, $tipoDoc, $numDoc, $tel, $estado)
    {
        //extraer los administradores        
        $sql = "selectAdmin($idAdmin, $email, $pass, $nombres, $apellidos, $tipoDoc, $numDoc, $tel, $estado)";
        $request = $this->selectAll($sql);
        return $request;
    }

    //método para eliminar el administrador
    public function PdeleteAdmin(int $idAdmin)
    {
        $this->intIdAdmin = $idAdmin;
        $sql = "deleteAdmin($idAdmin)";
        $arrData = array('Inhabilitado');
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
