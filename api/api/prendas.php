<?php 

require_once './../classes/class_prendas.php';
header('Content-Type: application/json');
switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['id_prenda'])){
            // Nos traemos una prenda 
            $idPrenda = $_GET['id_prenda'];
            $prenda = new Prenda($idPrenda);
            $prenda = $prenda->getPrenda();
            $res;
            if( count($prenda) != 0 && count($prenda) == 1 ){
                $res = array (
                    "err" => false,
                    "status" => http_response_code(200),
                    'statusText' => "Prenda encontrada con exito ",
                    "data" => $prenda
                );
            }else{
                $res = array(
                    "err" => true ,
                    'status' => http_response_code(200),
                    'statusText' => 'No se encontro prendas con este id',
                    'data' => []
                );
            }
            echo json_encode($res);
        }else{
            // Si no existe parametro en la url nos traemos todos
            $prenda = new Prenda();
            $prendas = $prenda->getAllPrendas();
            $res;
            if( count($prendas) !== 0 ){
                $res = array(
                    "err" => false,
                    'status' => http_response_code(200),
                    'statusText' => 'Prendas encontradas con exito',
                    'data' => $prendas
                );
            }else{
                $res = array(
                    'err' => true,
                    'status' => http_response_code(404),
                    'statusText' => 'No se encontraron prendas',
                    'data' => []
                );
            }
            echo json_encode($res);
        }
        break;
    case 'POST':
        // Para agregar prendas
        $_POST = json_decode( file_get_contents('php://input'), true );
        $prenda = new Prenda($_POST['id_prenda'] , $_POST['almacen'] , $_POST['tipo_prenda'] , $_POST['categoria'] , $_POST['talla'] , $_POST['tip_ropa'] , $_POST['nom_prenda'] , $_POST['color'] , $_POST['precio']);
        $res;
        if($prenda->addPrenda()){
            // Funciono el agregar
            $res = array(
                'err' => false,
                'status' => http_response_code(201),
                'statusText' => "Prenda creada con exito"
            );
        }else{
            $res = array(
                'err' => false,
                'status' => http_response_code(500),
                'statusText' => 'No se pudo crear la prenda erro inexperado :)'
            );
        }
        echo json_encode($res);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $prenda = new Prenda($_PUT['id_prenda'] , $_PUT['almacen'] , $_PUT['tip_pren'] , $_PUT['categoria'] , $_PUT['talla'] , $_PUT['tip_ropa'] , $_PUT['nom_prenda'] , $_PUT['color'] , $_PUT['precio']);
        $res;
        if($prenda->updatePrenda()){
            $res = array(
                'err' => false,
                'status' => http_response_code(200),
                'statustext' => 'Prenda actualizada con exito',
            );
        }else{
            $res = array(
                'err' => true,
                'status' => http_response_code(500),
                'statusText' => 'Error no controlado al actualizar la prenda'
            );
        }
        echo json_encode($res);
        break;
    case 'DELETE':
        $_DELETE = json_decode( file_get_contents('php://input') , true);
        $prenda = new Prenda($_DELETE['id_prenda']); 
        $res;
        if($prenda->deletePrenda()){
            // Se elimino con exito
            $res = array(
                'err' => false,
                'status' => http_response_code(200),
                'statusText' => 'Prenda eliminada con exito'
            );
        }else{
            $res = array(
                'err' => true,
                'status' => http_response_code(500),
                'statusText' => 'No se pudo eliminar esta prenda :)'
            );
        }
        echo json_encode($res);
        break;
}