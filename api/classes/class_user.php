<?php
require_once '../classes/conexion.php';

class Usuario extends Conecction{
    
    private $documento;
    private $nombres;
    private $apellidos;
    private $id_tipo_docu;
    private $id_tipo_usu;
    private $telefono;
    private $correo;

    public function __construct($documento = null, $nombres = null, $apellidos = null, $id_tipo_docu = null, $id_tipo_usu = null, $telefono = null, $correo = null)
    {
        parent::__construct();
        $this->$documento = $documento;
        $this->$nombres = $nombres;
        $this->$apellidos = $apellidos;
        $this->$id_tipo_docu = $id_tipo_docu;
        $this->$id_tipo_usu = $id_tipo_usu;
        $this->$telefono = $telefono;
        $this->$correo = $correo;
    }

    public function getDocumento(){
        return $this->documento;
    }

    public function setDocumento($documento){
        $this->documento = $documento;
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function setNombres($nombres){
        $this->nombres = $nombres;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function getId_tipo_docu(){
        return $this->id_tipo_docu;
    }

    public function setId_tipo_docu($id_tipo_docu){
        $this->id_tipo_docu = $id_tipo_docu;
    }

    public function getId_tipo_usu(){
        return $this->id_tipo_usu;
    }

    public function setId_tipo_usu($id_tipo_usu){
        $this->id_tipo_usu = $id_tipo_usu;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function addUser(){
        try{
            $sql = 'INSERT INTO usuarios (documento, nombres, apellidos, id_tipo_docu, id_tipo_usu, telefono, correo) VALUES (?,?,?,?,?,?,?)';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_bind_param($query,'issiiis',$this->documento, $this->nombres, $this->apellidos, $this->id_tipo_docu, $this->id_tipo_usu, $this->telefono, $this->correo);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }
        catch(Throwable $except){
            echo $except;
            return false;
        }
    }
    
    public function getAllUsers(){
        try{
            $users = [];
            $sql = 'SELECT * FROM usuarios';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_execute($query);
            $ok = mysqli_stmt_bind_result($query,$this->documento, $this->nombres, $this->apellidos, $this->id_tipo_docu, $this->id_tipo_usu, $this->telefono, $this->correo);
            while(mysqli_stmt_fetch($query)){
                array_push($users,['documento'=>$this->documento, 'nombres' =>$this->nombres, 'apellidos' => $this->apellidos, 'id_tipo_docu' => $this->id_tipo_docu, 'id_tipo_usu' => $this->id_tipo_usu, 'telefono' => $this->telefono, 'correo' => $this->correo]);
            }
            mysqli_stmt_close($query);
            return $users;
        }
        catch(Throwable $exe){
            echo $exe;
            return false;
        }
    }

    public function updateUser(){
        try{
            $sql = "UPDATE usuarios set nombres = ? , apellidos = ? , telefono = ?, correo = ?, id_tipo_docu = ?, id_tipo_usu = ?  where usuarios.documento = ?";
            $query = mysqli_prepare($this->connection , $sql);
            $ok = mysqli_stmt_bind_param($query , 'ssisii', $this->nombres , $this->apellidos, $this->telefono, $this->correo, $this->id_tipo_docu, $this->id_tipo_usu);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $th){
            echo "El error esta en ". $th;
        }
    }

    public function deleteUser(){
        try{
            $sql = "DELETE from usuarios where documento = ?";
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_bind_param($query , 'i' , $this->documento);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $th){
            echo "El error esta en: " . $th;
        }
    }

    public function getUser(){
        try {
            $users = [];
            $sql = 'SELECT * FROM usuarios WHERE documento = ?';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_execute($query);
            $ok = mysqli_stmt_bind_result($query,$this->documento, $this->nombres, $this->apellidos, $this->id_tipo_docu, $this->id_tipo_usu, $this->telefono, $this->correo);
            while(mysqli_stmt_fetch($query)){
                array_push($users,['documento'=>$this->documento, 'nombres' =>$this->nombres, 'apellidos' => $this->apellidos, 'id_tipo_docu' => $this->id_tipo_docu, 'id_tipo_usu' => $this->id_tipo_usu, 'telefono' => $this->telefono, 'correo' => $this->correo]);
            }
            mysqli_stmt_close($query);
            return true;
        }catch (Throwable $th) {
            echo "El error esta en" . $th;
            return false;
        }
        return [];
    }
} 