<?php 

require_once './../classes/class_venta_enca.php';
header('Content-Type: application/json');
switch($_SERVER['REQUEST_METHOD']){

    case 'GET':
        if(isset($_GET['id_venta_enca'])){
            // Nos traemos un encabezado de venta
            $id_venta_enca = $_GET['id_venta_enca'];
            $venta_enca = new VentaEnca($id_venta_enca);
            $venta_enca = $venta_enca->getVentaEncA();
            $res;
            if( count($venta_enca) != 0 && count($venta_enca) == 1 ){
                $res = array (
                    "err" => false,
                    "status" => http_response_code(200),
                    'statusText' => " Venta encontrada con exito ",
                    "data" => $venta_enca
                );
            }else{
                $res = array(
                    "err" => true ,
                    'status' => http_response_code(200),
                    'statusText' => 'No se encontro ninguna venta con este Id',
                    'data' => []
                );
            }
            echo json_encode($res);
        }else{
            // Si no existe parametro en la url nos traemos todos
            $venta_enca = new VentaEnca();
            $venta_enca = $venta_enca->getAllVentaEnca();
            $res;
            if( count($venta_enca) !== 0 ){
                $res = array(
                    "err" => false,
                    'status' => http_response_code(200),
                    'statusText' => 'Ventas encontradas con exito',
                    'data' => $venta_enca
                );
            }else{
                $res = array(
                    'err' => true,
                    'status' => http_response_code(404),
                    'statusText' => 'No se encontro Ninguna venta',
                    'data' => []
                );
            }
            echo json_encode($res);
        }
        break;

    case 'POST':
        // Para agregar Encabezado de la venta
        $_POST = json_decode( file_get_contents('php://input'), true );
        $venta_enca = new VentaEnca($_POST['id_venta_enca'] , $_POST['fecha_venta'] , $_POST['forma_pago'] , $_POST['documento'] , $_POST['total_venta_enca']);
        $res;
        if($venta_enca->addVentaEnca()){
            // Funciona el agregar
            $res = array(
                'err' => false,
                'status' => http_response_code(201),
                'statusText' => "Venta creada con exito"
            );
        }else{
            $res = array(
                'err' => false,
                'status' => http_response_code(500),
                'statusText' => 'No se pudo crear la venta, error inesperado'
            );
        }
        echo json_encode($res);
        break;

    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $venta_enca = new VentaEnca($_PUT['id_venta_enca'] , $_PUT['fecha_venta'] , $_PUT['forma_pago'] , $_PUT['documento'] , $_PUT['total_venta_enca']);
        $res;
        if($venta_enca->updateVentaEnca()){
            $res = array(
                'err' => false,
                'status' => http_response_code(200),
                'statustext' => 'Venta Actualizada con exito',
            );
        }else{
            $res = array(
                'err' => true,
                'status' => http_response_code(500),
                'statusText' => 'Error no se logro actualizar la venta'
            );
        }
        echo json_encode($res);
        break;

    case 'DELETE':
        $_DELETE = json_decode( file_get_contents('php://input') , true);
        $venta_enca = new VentaEnca($_DELETE['id_venta_enca']); 
        $res;
        if($venta_enca->deleteVentaEnca()){
            // Se elimino con exito
            $res = array(
                'err' => false,
                'status' => http_response_code(200),
                'statusText' => 'Venta eliminada con exito'
            );
        }else{
            $res = array(
                'err' => true,
                'status' => http_response_code(500),
                'statusText' => 'No se pudo eliminar la venta'
            );
        }
        echo json_encode($res);
        break;
}