<?php
include_once "Entity.php";

class Persona extends Entity{
    
    public string $nombre;
    public int $edad;
    private bool $iniciada = false;

    public function __construct(string $nombre,int $edad){        
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->iniciada = !empty($nombre);
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getEdad(){
        return $this->edad;
    }

    public function isIniciada(){
        return $this->iniciada;
    }

    public static function calcularEdad(int $fechaNacimiento){
        $edad = date("Y") - $fechaNacimiento;
        return $edad;
    }
}
