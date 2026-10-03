<?php
include "Entity/Producto.php";

define('STARTAPP', true);
session_start();

if (isset($_GET["action"])) {
    header("Content-Type: application/json");
    switch ($_GET["action"]) {
        case "getProduct":
            $producto = array();
            $id = isset($_GET["id"]) ? $_GET["id"] : null;
            if (isset($_SESSION["productos"]) && isset($_SESSION["productos"][$id])) {
                $producto = $_SESSION["productos"][$id];
                setResponse($producto);
            }else{
                setResponse(["success"=>false, "message"=>"Producto no encontrado"], 404);
            }
            break;

        case "getProducts":
            $productos = array();
            if (isset($_SESSION["productos"])) {
                $productos = $_SESSION["productos"];
            }
            print json_encode(array_values($productos));
            break;

        case "saveProduct": //add or update
            
            $obj = getBody();
            $producto = new Producto();
            $producto->set($obj);
            $producto->save();

            if (!(isset($_SESSION["productos"]))) {
                $_SESSION["productos"] = array();
            }
            $_SESSION["productos"][$producto->id] = $producto;

            setResponse(["success"=>true, "data"=>$producto]);
            //header("Location: http://127.0.0.1/uasd/prog/public/portafolio.html");
            break;

        case "deleteProduct":
            $producto = array();
            $id = isset($_GET["id"]) ? $_GET["id"] : null;
            if (isset($_SESSION["productos"]) && isset($_SESSION["productos"][$id])) {
                $producto = $_SESSION["productos"][$id];
                unset($_SESSION["productos"][$id]);
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


//print json_encode(["status"=>"ok", "data"=>$producto]);
//exit;


/*
include "Entity/Persona.php";

$fechaNacimiento = isset($_POST['fechaNacimiento']) ? (int)$_POST['fechaNacimiento'] : 0; // Default year if not provided
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : ""; // Default name if not provided

$persona = new Persona($nombre, Persona::calcularEdad($fechaNacimiento));
$persona->insert();

//print json_encode($persona);
include "respuesta.php";
*/
