<?php
    class Conecction{
        public $connection;
        public function __construct()
        {
            return $this->connection = $this->connect();
        }

        private function connect(){
            try{
                $connections = new mysqli("localhost", "root","", "tienda_depor");
                if($connections ->connect_errno)
                {
                    die("fallo la conexion con la base de datos" . mysqli_connect_errno());                    
                }

                return $connections;
            }

            catch(Throwable $ex){
                echo $ex;
            }
        }
    }

    $con = new Conecction();
    var_dump($con);
?>