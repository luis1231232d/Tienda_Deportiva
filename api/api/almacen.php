<?php 

require_once './../classes/class_almacen.php';
header('Content-Type: application/json');
switch($_SERVER['REQUEST_METHOD']){

    case 'GET':
        if(isset($_GET['id_almacen'])){
            // Nos traemos un Almacen
            $idAlmacen = $_GET['id_almacen'];
            $almacen = new Almacen($idAlmacen);
            $almacen = $almacen->getAlmacen();
            $res;
            if( count($almacen) != 0 && count($almacen) == 1 ){
                $res = array (
                    "err" => false,
                    "status" => http_response_code(200),
                    'statusText' => " Almacen encontrado con exito ",
                    "data" => $almacen
                );
            }else{
                $res = array(
                    "err" => true ,
                    'status' => http_response_code(200),
                    'statusText' => 'No se encontro Almacen con este Id',
                    'data' => []
                );
            }
            echo json_encode($res);
        }else{
            // Si no existe parametro en la url nos traemos todos
            $almacen = new Almacen();
            $almacen = $prenda->getAllsAlmacenes();
            $res;
            if( count($almacen) !== 0 ){
                $res = array(
                    "err" => false,
                    'status' => http_response_code(200),
                    'statusText' => 'Almacenes encontrados con exito',
                    'data' => $almacen
                );
            }else{
                $res = array(
                    'err' => true,
                    'status' => http_response_code(404),
                    'statusText' => 'No se encontraron Almacenes',
                    'data' => []
                );
            }
            echo json_encode($res);
        }
        break;

    case 'POST':
        // Para agregar Almacenes
        $_POST = json_decode( file_get_contents('php://input'), true );
        $prenda = new Almacen($_POST['id_almacen'] , $_POST['nombre_almacen'] , $_POST['direccion'] , $_POST['correo'] , $_POST['telefono']);
        $res;
        if($prenda->AddAlmacen()){
            // Funciona el agregar
            $res = array(
                'err' => false,
                'status' => http_response_code(201),
                'statusText' => "Almacen creado con exito"
            );
        }else{
            $res = array(
                'err' => false,
                'status' => http_response_code(500),
                'statusText' => 'No se pudo crear el almacen error inesperado :)'
            );
        }
        echo json_encode($res);
        break;

    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $prenda = new Almacen($_PUT['id_almacen'] , $_PUT['nombre_almacen'] , $_PUT['direccion'] , $_PUT['correo'] , $_PUT['telefono']);
        $res;
        if($prenda->updateAlmacen()){
            $res = array(
                'err' => false,
                'status' => http_response_code(200),
                'statustext' => 'Almacen Actualizado con exito',
            );
        }else{
            $res = array(
                'err' => true,
                'status' => http_response_code(500),
                'statusText' => 'Error no controlado al actualizar el almacen'
            );
        }
        echo json_encode($res);
        break;

    case 'DELETE':
        $_DELETE = json_decode( file_get_contents('php://input') , true);
        $prenda = new Almacen($_DELETE['id_almacen']); 
        $res;
        if($prenda->deleteAlmacen()){
            // Se elimino con exito
            $res = array(
                'err' => false,
                'status' => http_response_code(200),
                'statusText' => 'Almacen eliminado con exito'
            );
        }else{
            $res = array(
                'err' => true,
                'status' => http_response_code(500),
                'statusText' => 'No se pudo eliminar el Almacen'
            );
        }
        echo json_encode($res);
        break;
}