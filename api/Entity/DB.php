<?php

class DB {

    private static $instance = null;
    private $connection;
    
    //singleton pattern to ensure only one instance of the DB class is created
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    private function __construct() {        
        $this->connection = new mysqli(config::$dbHost, config::$dbUser, config::$dbPass, config::$dbName);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function __destruct() {
        if ($this->connection) {
            $this->connection->close();
        }
    }

    public function query($sql) {
        $result = $this->connection->query($sql);
        if ($result === false) {
            die("Query failed: " . $this->connection->error);
        }
        return $result;
    }

    public function select($tabla, $campos = "*", $where = "") {
        $result = false;    
        $sql = "SELECT " . $campos . " FROM " . $tabla;
        if(!(empty($where))){
            $sql .= " WHERE " . $where;
        }
        return $result = $this->query($sql);
    }
    
    public function insert($tabla, $campos, $valores) {
        $result = false;    
        $sql = "INSERT INTO " . $tabla . " (" . $campos . ") VALUES (" . $valores . ")";
        if($this->query($sql)){
            return $this->connection->insert_id;
        }
        return false;
    }   

    public function update($tabla,$params, $where) {
        $result = false;    
        if(!(empty($where))){
            $sql = "UPDATE " . $tabla . " SET " . $params . " WHERE " . $where;
            return $result = $this->query($sql);            
        }
        return $result;
    }   

    public function delete($tabla, $where) {
        $result = false;    
        if(!(empty($where))){
            $sql = "DELETE FROM " . $tabla . " WHERE " . $where;
            return $result = $this->query($sql);
        }
        return $result;
    }   
}