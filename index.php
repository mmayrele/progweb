<?php
include "config.php";
include "Entity/Producto.php";

define('STARTAPP', true);
session_start();

if (isset($_GET["action"])) {
    header("Content-Type: application/json");
    switch ($_GET["action"]) {
        case "getProduct":
            $id = isset($_GET["id"]) ? $_GET["id"] : null;
            $producto = new Producto($id);
            if ($producto->isInit()) {
                setResponse($producto);
            }else{
                setResponse(["success"=>false, "message"=>"Producto no encontrado"], 404);
            }
            break;

        case "getProducts":            
            $producto = new Producto();
            $productos = $producto->getAll();
            print json_encode($productos);
            break;

        case "saveProduct": //add or update
            
            $obj = getBody();
            $producto = new Producto();
            $producto->set($obj);
            $producto->save();
            setResponse(["success"=>true, "data"=>$producto]);
            break;

        case "deleteProduct":
            $producto = array();
            $id = isset($_GET["id"]) ? $_GET["id"] : null;
            $producto = new Producto($id);
            if ($producto->isInit()) {
                $producto->remove();
                setResponse(["success"=>true, "message"=>"Producto eliminado"]);
            }else{
                setResponse(["success"=>false, "message"=>"Producto no encontrado"], 404);
            }
            break; 
    }
}

function setResponse($data, $statusCode = 200): void {
    http_response_code($statusCode);
    header("Content-Type: application/json");
    print json_encode($data);
}

function getBody(): array {    
    $productoData = file_get_contents("php://input");
    $_POST = json_decode($productoData, true);
    return $_POST;
}