<?php

class Entity{

    public $id;

    public function set($obj){
        foreach($this as $field => $value){
            if(isset($obj[$field])){
                $this->$field = $obj[$field];
            }
        }
    }

    public function save() : bool{
        if(isset($this->id) && intval($this->id) > 0){
            return true;
        }else{
            $this->id = rand(1, 1000); // Simulate generating a unique ID for the entity
        }
        //print "Insertando entidad con ID: " . $this->id . "\n";
        // Implement the logic to insert the entity into the database
        return true; // Return true if insertion is successful, false otherwise
    }

    public function update() : bool{
        // Implement the logic to update the entity in the database
        return true; // Return true if update is successful, false otherwise
    }

    public function delete() : bool{
        // Implement the logic to delete the entity from the database
        return true; // Return true if deletion is successful, false otherwise
    }

    public function get(){
        return "";
    }

}
