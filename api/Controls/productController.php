<?php
include_once "Entity/Producto.php";        

class productController{

    public function get(int $id){
        $producto = new Producto($id);
        if ($producto->isInit()) {
            lib::setResponse($producto);
        }else{
            lib::setResponse(["success"=>false, "message"=>"Producto no encontrado"], 404);
        }
    }

    public function getAll(){
        $producto = new Producto();
        $productos = $producto->getAll();
        lib::setResponse($productos);
    }

    public function post(){
        lib::is_method_post();        
        $obj = lib::getContentObject();

        $producto = new Producto();
        $producto->set($obj);
        $producto->save();

        lib::setResponse(["success"=>true, "data"=>$producto]);
    }

    public function getProveedor(int $id){
        $producto = new Producto($id);
        if ($producto->isInit()) {
            include_once "Entity/Proveedor.php";        
            $proveedor = new Proveedor($producto->proveedorid);
            lib::setResponse($proveedor);
        }else{
            lib::setResponse(["success"=>false, "message"=>"Producto no encontrado"], 404);
        }
    } 

}