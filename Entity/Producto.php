<?php
include_once "Entity.php";

class Producto extends Entity{
    public $id;    
    public $nombre;
    public $codigo;
    public $tipo;
    public $costo;
    public $precio;
    public $pagaItbis;
    public $itbis;
}