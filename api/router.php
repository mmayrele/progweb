<?php

class router{

    public function start(){
        
        $request = (isset($_GET['request'])) ? $_GET['request'] : false;       
        if($request){
            $request = explode("/", $request);
            $control = isset($request[0]) ? $request[0] : false;
            $method = isset($request[1]) ? $request[1] : false;
            $var1 = isset($request[2]) ? $request[2] : false;
            $var2 = isset($request[3]) ? $request[3] : false;
            $var3 = isset($request[4]) ? $request[4] : false;

            if(file_exists("Controls/{$control}Controller.php")){
                //validar la existencia del controlador
                include_once "Controls/{$control}Controller.php";
                if(class_exists("{$control}Controller")){
                    $controller = "{$control}Controller";
                    $control = new $controller();
                    //validar el method
                    if($method && !(is_numeric($method))){
                        if(method_exists($control, $method)){
                            $control->$method($var1,$var2,$var3);
                            return;
                        }
                    }else{
                        if(!(empty($var1)) && !(is_numeric($var1))){
                            if(method_exists($control, $var1)){
                                $control->$var1($method,$var2,$var3);
                                return;
                            }
                        }else{
                            $methodType = $_SERVER["REQUEST_METHOD"];
                            if(method_exists($control, $methodType)){
                                $control->$methodType($method,$var1,$var2);
                                return;
                            }
                        }
                    }
                }
            }
            print "Acceso inválido!";
            exit;
        }
    }

}