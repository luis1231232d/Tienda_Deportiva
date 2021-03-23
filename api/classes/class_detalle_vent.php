<?php
require_once '../classes/conexion.php';

class VentaDeta extends Conecction{   
    private $id_detalle_venta;
    private $id_venta_enca;
    private $id_prenda;
    private $cantidad;
    private $valor_total_venta;

    public function __construct($id_detalle_venta = null, $id_venta_enca = null, $id_prenda = null, $cantidad = null, $valor_total_venta = null)
        {
            parent::__construct();
            $this->$id_detalle_venta = $id_detalle_venta;
            $this->$id_venta_enca = $id_venta_enca;
            $this->$id_prenda = $id_prenda;
            $this->$cantidad = $cantidad;
            $this->$valor_total_venta = $valor_total_venta;
        }

    public function getId_detalle_venta(){
        return $this->id_detalle_venta;
    }

    public function setId_detalle_venta($id_detalle_venta){
        $this->id_detalle_venta = $id_detalle_venta;
    }

    public function getId_venta_enca(){
        return $this->id_venta_enca;
    }

    public function setId_venta_enca($id_venta_enca){
        $this->id_venta_enca = $id_venta_enca;
    }

    public function getId_prenda(){
        return $this->id_prenda;
    }

    public function setId_prenda($id_prenda){
        $this->id_prenda = $id_prenda;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function getValor_total_venta(){
        return $this->valor_total_venta;
    }

    public function setValor_total_venta($valor_total_venta){
        $this->valor_total_venta = $valor_total_venta;
    }

    public function addVentaDeta(){
        try{
            $sql = 'INSERT INTO detalle_venta (id_detalle_venta ,id_venta_enca ,id_prenda  ,cantidad ,valor_total_venta) VALUES (?,?,?,?,?)';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_bind_param($query,'iiii',$this->id_venta_enca, $this->id_prenda, $this->cantidad, $this->valor_total_venta);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }
        catch(Throwable $except){
            echo $except;
            return false;
        }
    }

    public function getAllVentaDeta(){
        try{
            $VentaDeta = [];
            $sql = 'SELECT * FROM detalle_venta';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_execute($query);
            $ok = mysqli_stmt_bind_result($query,$this->id_detalle_venta, $this->id_venta_enca, $this->id_prenda, $this->cantidad, $this->valor_total_venta);
            while(mysqli_stmt_fetch($query)){
                array_push($VentaDeta,['id_detalle_venta'=>$this->id_detalle_venta, 'id_venta_enca' =>$this->id_venta_enca, 'id_prenda' => $this->id_prenda, 'cantidad' => $this->cantidad, 'valor_total_venta' => $this->valor_total_venta]);
            }
            mysqli_stmt_close($query);
            return $VentaDeta;
        }
        catch(Throwable $exe){
            echo $exe;
            return false;
        }
    }

    public function getVentaDeta(){
        try{
            $sql = 'SELECT * FROM detalle_venta WHERE id_detalle_venta = ? ';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_execute($query);
            $ok = mysqli_stmt_bind_result($query,$this->id_detalle_venta, $this->id_venta_enca, $this->id_prenda, $this->cantidad, $this->valor_total_venta);
            while(mysqli_stmt_fetch($query)){
                array_push($VentaDeta,['id_detalle_venta'=>$this->id_detalle_venta, 'id_venta_enca' =>$this->id_venta_enca, 'id_prenda' => $this->id_prenda, 'cantidad' => $this->cantidad, 'valor_total_venta' => $this->valor_total_venta]);
            }
            mysqli_stmt_close($query);
            return true;
        }
        catch(Throwable $exe){
            echo $exe;
            return false;
        }
    }

    public function updateVentaDeta(){
        try{
            $sql = "UPDATE detalle_venta set  id_venta_enca = ? , id_prenda = ?, cantidad = ?, valor_total_venta = ?  where detalle_venta.id_detalle_venta = ?";
            $query = mysqli_prepare($this->connection , $sql);
            $ok = mysqli_stmt_bind_param($query , 'iiii', $this->id_venta_enca , $this->id_prenda, $this->cantidad, $this->valor_total_venta);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $th){
            echo "El error esta en ". $th;
        }
    }

    public function deleteVentaDeta(){
        try{
            $sql = "DELETE from detalle_venta where id_detalle_venta = ?";
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_bind_param($query , 'i' , $this->id_detalle_venta);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $th){
            echo "El error esta en: " . $th;
        }
    }
}