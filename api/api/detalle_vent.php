<?php 

require_once './../classes/class_detalle_vent.php';
header('Content-Type: application/json');
switch($_SERVER['REQUEST_METHOD']){

    case 'GET':
        if(isset($_GET['id_detalle_venta'])){
            // Nos traemos un detalle de la venta
            $id_detalle_venta = $_GET['id_detalle_venta'];
            $venta_deta = new VentaDeta($id_detalle_venta);
            $venta_deta = $venta_deta->getVentaDeta();
            $res;
            if( count($venta_deta) != 0 && count($venta_deta) == 1 ){
                $res = array (
                    "err" => false,
                    "status" => http_response_code(200),
                    'statusText' => " Venta encontrada con exito ",
                    "data" => $venta_deta
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
            $venta_deta = new VentaDeta();
            $venta_deta = $venta_deta->getAllVentaDeta();
            $res;
            if( count($venta_deta) !== 0 ){
                $res = array(
                    "err" => false,
                    'status' => http_response_code(200),
                    'statusText' => 'Ventas encontradas con exito',
                    'data' => $venta_deta
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
        // Para agregar Detalle de la venta
        $_POST = json_decode( file_get_contents('php://input'), true );
        $venta_deta = new VentaDeta($_POST['id_detalle_venta'] , $_POST['id_venta_enca'] , $_POST['id_prenda'] , $_POST['cantidad'] , $_POST['valor_total_venta']);
        $res;
        if($venta_deta->addVentaDeta()){
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
        $venta_deta = new VentaDeta($_PUT['id_detalle_venta'] , $_PUT['id_venta_enca'] , $_PUT['id_prenda'] , $_PUT['cantidad'] , $_PUT['valor_total_venta']);
        $res;
        if($venta_deta->updateVentaDeta()){
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
        $venta_deta = new VentaDeta($_DELETE['id_detalle_venta']); 
        $res;
        if($venta_deta->deleteVentaDeta()){
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