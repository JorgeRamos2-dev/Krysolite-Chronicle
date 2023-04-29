<?php

class Contactus{

    private $conexion;
    private $db_table = "krysolite_contactus";
    private $id;
    private $name;
    private $email;
    private $phone;
    private $message;

    public function __construct($db){
        $this->conexion = $db;
    }

    //SETTER Y GETTER
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    //Metodo para crear un nuevo usuario
    public function insertMessage()
    {
        //consulta para insertar un registro en la tabla
        $sqlQuery = "INSERT INTO ". $this->db_table ." SET
                        name = :name, 
                        email = :email,
                        phone = :phone, 
                        message = :message,
                        date = :date";

        $query = $this->conexion->prepare($sqlQuery);

        //limpiar datos
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->message=htmlspecialchars(strip_tags($this->message));
        $this->date=date('Y-m-d');

        //bind data(agregar los datos a la consulta)
        $query->bindParam(":name", $this->name);
        $query->bindParam(":email", $this->email);
        $query->bindParam(":phone", $this->phone);
        $query->bindParam(":message", $this->message);
        $query->bindParam(":date", $this->date);


        if($query->execute()){
            return true;
        }
        return false;
    }


}