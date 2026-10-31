<?php
include "DB.php";
abstract class Entity {
    abstract public function getTable() : string;
    private $where = "";
    public $id;

    public function isInit() : bool{
        return isset($this->id) && intval($this->id) > 0;
    }

    public function set($obj){
        $obj = (array)$obj;
        foreach($this as $field => $value){
            if(isset($obj[$field])){
                $this->$field = $obj[$field];
            }
        }
    } 
 
    public function getBy() : bool{
        $result = DB::getInstance()->select($this->getTable(), "*", $this->getWhere());
        if($result && $row = $result->fetch_object()){
            $this->set($row);           
            return true;
        }
        return false;
    }

    public function getById($id) : bool{
        $this->where("id = " . intval($id));
        return $this->getBy();
    }


     public function getAll() : array{
        $result = DB::getInstance()->select($this->getTable());
        $data = [];
        if($result){
            while($row = $result->fetch_object(static::class)){
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getAllBy() : array{
        $result = DB::getInstance()->select($this->getTable(), "*", $this->getWhere());
        $data = [];
        if($result){
            while($row = $result->fetch_object(static::class)){
                $data[] = $row;
            }
        }
        return $data;
    }

    public function execute($sql){
        return DB::getInstance()->query($sql);
    }

    public function save() : bool{
        if(isset($this->id) && intval($this->id) > 0){
            return $this->update();
        }else{
            return $this->insert();
        }
    }

    private function insert() : bool{
        $campos = [];
        $valores = [];
        foreach($this as $field => $value){
            if($field != "id" && $field != "where"){
                $campos[] = $field;
                $valores[] = "'" . addslashes($value) . "'";
               
            }
        }
        $this->id = DB::getInstance()->insert($this->getTable(), implode(", ", $campos), implode(", ", $valores));
        return $this->id !== false;
    }

    private function update() : bool{
        $params = [];
        foreach($this as $field => $value){
            if($field != "id" && $field != "where"){
                $params[] = "$field = '" . addslashes($value) . "'";              
            }
        }
        $getParamsUpdate = implode(", ", $params);
        return DB::getInstance()->update($this->getTable(), $getParamsUpdate, "id = " . $this->id);
    } 

    public function remove() : bool{
        return DB::getInstance()->delete($this->getTable(), "id = " . $this->id);
    }

    public function removeBy() : bool{
        return DB::getInstance()->delete($this->getTable(), $this->getWhere());
    }

    public function where($where){
        $this->where .= " " . $where;
    }

    public function getWhere(){
        $where = $this->where;
        $this->where = "";
        return $where;
    }

}
