<?php
require_once '../classes/conexion.php';

class Prenda extends Conecction{
    private $id_prenda;
    private $almacen;
    private $tipo_prenda;
    private $categoria;
    private $talla;
    private $tipo_ropa;
    private $nombre_prenda;
    private $color;
    private $precio;

    public function __construct($id_prenda = null, $almacen = null, $tipo_prenda = null, $categoria = null, $talla = null, $tipo_ropa = null, $nombre_prenda = null, $color = null, $precio = null, $fecha_creacion = null)
    {
        parent::__construct();
        $this->id_prenda = $id_prenda;
        $this->almacen = $almacen;
        $this->tipo_prenda = $tipo_prenda;
        $this->categoria = $categoria;
        $this->talla = $talla;
        $this->tipo_ropa = $tipo_ropa;
        $this->nombre_prenda = $nombre_prenda;
        $this->color = $color;
        $this->precio = $precio;
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getId_prenda(){
        return $this->id_prenda;
    }

    public function setId_prenda($id_prenda){
        $this->id_prenda = $id_prenda;
    }

    public function getAlmacen(){
        return $this->almacen;
    }

    public function setAlmacen($almacen){
        $this->almacen = $almacen;
    }

    public function getTipo_prenda(){
        return $this->tipo_prenda;
    }

    public function setTipo_prenda($tipo_prenda){
        $this->tipo_prenda = $tipo_prenda;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function getTalla(){
        return $this->talla;
    }

    public function setTalla($talla){
        $this->talla = $talla;
    }

    public function getTipo_ropa(){
        return $this->tipo_ropa;
    }

    public function setTipo_ropa($tipo_ropa){
        $this->tipo_ropa = $tipo_ropa;
    }

    public function getNombre_prenda(){
        return $this->nombre_prenda;
    }

    public function setNombre_prenda($nombre_prenda){
        $this->nombre_prenda = $nombre_prenda;
    }

    public function getColor(){
        return $this->color;
    }

    public function setColor($color){
        $this->color = $color;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getFecha_creacion(){
        return $this->fecha_creacion;
    }

    public function setFecha_creacion($fecha_creacion){
        $this->fecha_creacion = $fecha_creacion;
    }

    public function addPrenda(){
        try{
            $sql = 'INSERT INTO prendas (id_prenda, id_almacen, id_tipo_prenda, id_categoria, id_talla, id_tipo_ropa, nom_prenda, precio, color, fecha_creacion) VALUES (?,?,?,?,?,?,?,?,?,?)';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_bind_param($query,'iiiiisiss',$this->almacen, $this->tipo_prenda, $this->categoria, $this->talla, $this->tipo_ropa, $this->nombre_prenda, $this->precio, $this->color, $this->fecha_creacion);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }
        catch(Throwable $except){
            echo $except;
            return false;
        }
    }

    public function getAllPrendas(){
        try{
            $prendas = [];
            $sql = 'SELECT * FROM Prendas';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_execute($query);
            $ok = mysqli_stmt_bind_result($query,$this->id_prenda, $this->almacen, $this->tipo_prenda, $this->categoria, $this->talla, $this->tipo_ropa, $this->nombre_prenda, $this->precio, $this->color, $this->fecha_creacion);
            while(mysqli_stmt_fetch($query)){
                array_push($prendas,['id_prenda'=>$this->id_prenda, 'id_almacen' =>$this->almacen, 'id_tipo_prenda' => $this->tipo_prenda, 'id_categoria' => $this->categoria, 'id_talla' => $this->talla, 'id_tipo_ropa' => $this->tipo_ropa, 'nom_prenda' => $this->nombre_prenda, 'color' => $this->color, 'precio' => $this->precio, 'fecha_creacion' => $this->fecha_creacion]);
            }
            mysqli_stmt_close($query);
            return $prendas;
        }
        catch(Throwable $exe){
            echo $exe;
            return false;
        }
    }

    public function getPrenda(){
        try{
            $prendas = [];
            $sql = 'SELECT * FROM Prendas WHERE id_prenda = ?';
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_execute($query);
            $ok = mysqli_stmt_bind_result($query,$this->id_prenda, $this->almacen, $this->tipo_prenda, $this->categoria, $this->talla, $this->tipo_ropa, $this->nombre_prenda, $this->precio, $this->color, $this->fecha_creacion);
            while(mysqli_stmt_fetch($query)){
                array_push($prendas,['id_prenda'=>$this->id_prenda, 'id_almacen' =>$this->almacen, 'id_tipo_prenda' => $this->tipo_prenda, 'id_categoria' => $this->categoria, 'id_talla' => $this->talla, 'id_tipo_ropa' => $this->tipo_ropa, 'nom_prenda' => $this->nombre_prenda, 'color' => $this->color, 'precio' => $this->precio, 'fecha_creacion' => $this->fecha_creacion]);
            }
            mysqli_stmt_close($query);
            return $prendas;
        }
        catch(Throwable $exe){
            echo $exe;
            return false;
        }
    }

    public function updatePrenda(){
        try{
            $sql = "UPDATE prendas set id_prenda = ? , id_almacen = ? , id_tipo_prenda = ?, id_categoria = ?, id_talla = ?, id_tipo_ropa = ?, nom_prenda = ?, color = ?, precio = ? , fecha_creacion = ?  where prendas.id_prenda = ?";
            $query = mysqli_prepare($this->connection , $sql);
            $ok = mysqli_stmt_bind_param($query , 'iiiiiissis', $this->id_prenda , $this->almacen, $this->tipo_prenda, $this->categoria, $this->talla, $this->tipo_ropa, $this->nombre_prenda, $this->color, $this->precio, $this->fecha_creacion);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $th){
            echo "El error esta en ". $th;
        }
    }

    public function deletePrenda(){
        try{
            $sql = "DELETE from prendas where id_prenda = ?";
            $query = mysqli_prepare($this->connection, $sql);
            $ok = mysqli_stmt_bind_param($query , 'i' , $this->id_prenda);
            $ok = mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            return true;
        }catch(Throwable $th){
            echo "El error esta en: " . $th;
        }
    }
}