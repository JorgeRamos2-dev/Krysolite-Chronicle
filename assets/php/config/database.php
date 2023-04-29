<?php

class Database {
    private $host = "127.0.0.1";
    private $database_name = "krysolite_db";
    private $username = "root";
    private $password = "root";

    public $conexion;

    public function getConnection(){
        $this->conexion = null;
        try{
            $this->conexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
            $this->conexion->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Database error al conectarse: " . $exception->getMessage();
        }
        return $this->conexion;
    }
}