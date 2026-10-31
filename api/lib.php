<?php

class lib{

    public static function is_method_get(){
        ($_SERVER["REQUEST_METHOD"] == "GET")  || die("Acceso inválido!");
    }

    public static function is_method_post(){
        ($_SERVER["REQUEST_METHOD"] == "POST")  || die("Acceso inválido!");
    }

    public static function is_method_put(){
        ($_SERVER["REQUEST_METHOD"] == "PUT")  || die("Acceso inválido!");
    }

    public static function is_method_delete(){
        ($_SERVER["REQUEST_METHOD"] == "DELETE")  || die("Acceso inválido!");
    }

    public static function getContentObject(){
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);    
        return $data; 
    }

    public static function setResponse($data, $statusCode = 200): void {
        http_response_code($statusCode);
        header("Content-Type: application/json");
        print json_encode($data);
    }
}
