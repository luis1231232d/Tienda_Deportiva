<?php
require_once './../classes/conexion.php';

class Almacen extends Conecction{
    private $idAlmacen;
    private $nomAlmacen ;
    private $direccion;
    private $correo;
    private $telefono;
    public function __construct($idAlmacen = null , $nombreAlmacen = null , $direccion = null , $correo = null, $telefono = null)
    {
        $this->idAlmacen = $idAlmacen;
        $this->nomAlmacen = $nombreAlmacen;
        $this->direccion = $direccion;
        $this->correo = $correo;
        $this->telefono = $telefono;
    }

    /******** encapsulamiento metodos public y private */

    public function getIdAlmacen(){ return $this->idAlmacen; }
    public function getNomAlmacen(){ return $this->nomAlmacen; }
    public function getDireccion(){ return $this->direccion; }
    public function getCorreo(){ return $this->correo; }
    public function getTelefono(){ return $this->telefono; }

    public function setIdAlmacen( $idAlmacen ){
        $this->idAlmacen = $idAlmacen;
    }
    public function setNomAlmacen( $nomAlmacen ){
        $this->nomAlmacen = $nomAlmacen;
    }
    public function setDireccion( $direccion ){
        $this->direccion = $direccion;
    }
    public function setCorreo( $correo ){
        $this->correo = $correo;
    }
    public function setTelefono( $telefono ){
        $this->telefono = $telefono;
    }

    /********** metodos para el crud  */
    public function AddAlmacen(){
        try{
            $sql = "INSERT INTO almacen(id_almacen , nombre_almacen, direccion , correo , telefono) values(NULL , ? , ?, ? , ?)";
            $query = mysqli_prepare($this->connection , $sql);
            $ok = mysqli_stmt_bind_param($query , 'sssi' , $this->nomAlmacen , $this->direeccion , $this->correo, $this->telefono );
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $ex){
            echo "El error esta en: " . $ex;
            return false;
        }
    } 

    public function getAlmacen(){
        try{
            $almacen= [];
            $sql = "SELECT * from almacen where id_almacen = ?";
            $query = mysqli_prepare($this->connection , $sql);
            $ok = mysqli_stmt_bind_param($query , 'i' , $this->idAlmacen);
            $ok = mysqli_stmt_execute($query);
            $ok= mysqli_stmt_bind_result($query , $this->idAlmacen , $this->nomAlmacen , $this->direccion , $this->correo, $this->telefono);
            while(mysqli_stmt_fetch($query)){
                array_push($almacen , ['id_almacen' => $this->idAlmacen , 'nom_almacen' => $this->nomAlmacen , 'direccion' => $this->direccion , 'correo' => $this->correo, 'telefono' => $this->telefono]);
            }
            mysqli_stmt_close($query);
            return $almacen;
        }catch( Throwable $th ){
            echo "El error esta en: " . $th;
            return false;
        }
    }

    public function getAllsAlmacenes(){
        try{
            $almacenes = [];
            $sql = "SELECT * from almacen";
            $query = mysqli_prepare($this->connection , $sql);
            $ok = mysqli_stmt_execute($query); 
            $ok = mysqli_stmt_bind_result($query , $this->idAlmacen, $this->nomAlmacen, $this->direccion , $this->correo ,$this->telefono);
            while(mysqli_stmt_fetch($query)){
                array_push($almacenes, ['id_almacen' => $this->idAlmacen , 'nom_almacen' => $this->nomAlmacen , 'direccion' => $this->direccion , 'correo' => $this->correo, 'telefono' => $this->telefono]);
            }
            mysqli_stmt_close($query);
            return $almacenes;
        }catch(Throwable $th){
            echo "Error encontrado en: " . $th;
            return false;
        }
    }

    public function updateAlmacen(){
        try{
            $sql = "UPDATE almacen SET nombre_almacen = ?, direccion = ?, correo = ? ,telefono = ?  WHERE almacen.id_almacen = ?";
            $query = mysqli_prepare($this->connection , $sql);
            $ok = mysqli_stmt_bind_param($query , 'sssi', $this->nomAlmacen ,$this->direccion ,$this->correo, $this->telefono);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $th){
            echo "El error esta en ". $th;
        }
    }

    public function deleteAlmacen(){
        try{
            $sql = "DELETE from almacen where id_almacen = ?";
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_bind_param($query , 'i' , $this->idAlmacen);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $th){
            echo "El error esta en: " . $th;
        }        
    }
}