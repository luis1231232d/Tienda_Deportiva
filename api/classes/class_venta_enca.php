<?php
require_once '../classes/conexion.php';

class VentaEnca extends Conecction{
    private $id_venta_enca;
    private $fecha_venta;
    private $forma_pago;
    private $documento;
    private $total_venta_enca;

    public function __construct($id_venta_enca = null, $fecha_venta = null, $forma_pago = null, $documento = null, $total_venta_enca = null)
        {
            parent::__construct();
            $this->$id_venta_enca = $id_venta_enca;
            $this->$fecha_venta = $fecha_venta;
            $this->$forma_pago = $forma_pago;
            $this->$documento = $documento;
            $this->$total_venta_enca = $total_venta_enca;
        }

    public function getId_venta_enca(){
        return $this->id_venta_enca;
    }

    public function setId_venta_enca($id_venta_enca){
        $this->id_venta_enca = $id_venta_enca;
    }

    public function getFecha_venta(){
        return $this->fecha_venta;
    }

    public function setFecha_venta($fecha_venta){
        $this->fecha_venta = $fecha_venta;
    }    
        
    public function getForma_pago(){
        return $this->forma_pago;
    }

    public function setForma_pago($forma_pago){
        $this->forma_pago = $forma_pago;
    }

    public function getDocumento(){
        return $this->documento;
    }

    public function setDocumento($documento){
        $this->documento = $documento;
    }

    public function getTotal_venta_enca(){
        return $this->total_venta_enca;
    }

    public function setTotal_venta_enca($total_venta_enca){
        $this->total_venta_enca = $total_venta_enca;
    }

    public function addVentaEnca(){
        try{
            $sql = 'INSERT INTO venta_encabezado (id_venta_enca, fecha_venta, id_forma_pago, documento, total_venta_enca) VALUES (?,?,?,?,?)';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_bind_param($query,'isiii',$this->id_venta_enca, $this->fecha_venta, $this->forma_pago, $this->documento, $this->total_venta_enca);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }
        catch(Throwable $except){
            echo $except;
            return false;
        }
    }

    public function getAllVentaEnca(){
        try{
            $VentaEnca = [];
            $sql = 'SELECT * FROM venta_encabezado';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_execute($query);
            $ok = mysqli_stmt_bind_result($query,$this->id_venta_enca, $this->fecha_venta, $this->forma_pago, $this->documento, $this->total_venta_enca);
            while(mysqli_stmt_fetch($query)){
                array_push($VentaEnca,['id_venta_enca'=>$this->id_venta_enca, 'fecha_venta' =>$this->fecha_venta, 'id_forma_pago' => $this->forma_pago, 'documento' => $this->documento, 'total_venta_enca' => $this->total_venta_enca]);
            }
            mysqli_stmt_close($query);
            return $VentaEnca;
        }
        catch(Throwable $exe){
            echo $exe;
            return false;
        }
    }

    public function getVentaEncA(){
        try {
            $VentaEnca = [];
            $sql = 'SELECT * FROM venta_encabezado WHERE id_venta_enca = ?';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_execute($query);
            $ok = mysqli_stmt_bind_result($query,$this->id_venta_enca, $this->fecha_venta, $this->forma_pago, $this->documento, $this->total_venta_enca);
            while(mysqli_stmt_fetch($query)){
                array_push($VentaEnca,['id_venta_enca'=>$this->id_venta_enca, 'fecha_venta' =>$this->fecha_venta, 'id_forma_pago' => $this->forma_pago, 'documento' => $this->documento, 'total_venta_enca' => $this->total_venta_enca]);
            }
            mysqli_stmt_close($query);
            return true;
        }catch (Throwable $th) {
            echo "El error esta en" . $th;
            return false;
        }
        return [];
    }

    public function updateVentaEnca(){
        try{
            $sql = "UPDATE venta_encabezado set  fecha_venta = ? , id_forma_pago = ?, documento = ?, total_venta_enca = ?  where venta_encabezado.id_venta_enca = ?";
            $query = mysqli_prepare($this->connection , $sql);
            $ok = mysqli_stmt_bind_param($query , 'siii', $this->fecha_venta , $this->forma_pago, $this->documento, $this->total_venta_enca);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $th){
            echo "El error esta en ". $th;
        }
    }

    public function deleteVentaEnca(){
        try{
            $sql = "DELETE from venta_encabezado where id_venta_enca = ?";
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_bind_param($query , 'i' , $this->id_venta_enca);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $th){
            echo "El error esta en: " . $th;
        }
    }
}  