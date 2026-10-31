<?php
include_once "Entity.php";

class Proveedor extends Entity{
    public $id;    
    public $nombre;
    public $codigo;
    public $tipo;

    public function getTable() : string{
        return "proveedor";
    }

    function __construct($id = null){
        if($id !== null){
            $this->getById($id);
        }
    }
}