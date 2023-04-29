<?php

class Users{

    private $conexion;
    private $db_table = "krysolite_users";
    private $id;
    private $username;
    private $email;
    private $password;
    private $date;
    private $picture='/assets/img/profile/default.png';
    private $firstname = "";
    private $lastname = "";

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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }


    //Metodo para crear un nuevo usuario
    public function insertUser()
    {
        //consulta para insertar un registro en la tabla
        $sqlQuery = "INSERT INTO ". $this->db_table ." SET
                        username = :username, 
                        email = :email,
                        password = :password, 
                        date = :date,
                        picture = :picture,
                        firstname = :firstname,
                        lastname = :lastname";

        $query = $this->conexion->prepare($sqlQuery);

        //limpiar datos
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->date=date('Y-m-d');
        $this->picture=htmlspecialchars(strip_tags($this->picture));
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));


        //bind data(agregar los datos a la consulta)
        $query->bindParam(":username", $this->username);
        $query->bindParam(":email", $this->email);
        $query->bindParam(":password", $this->password);
        $query->bindParam(":date", $this->date);
        $query->bindParam(":picture", $this->picture);
        $query->bindParam(":firstname", $this->firstname);
        $query->bindParam(":lastname", $this->lastname);

        if($query->execute()){
            return true;
        }
        return false;
    }


    
    public function getUserByUsername()
    {
        $sqlQuery = "SELECT id, username, email, password, date, picture, firstname, lastname FROM " . $this->db_table . " WHERE username = ?;";
        $query = $this->conexion->prepare($sqlQuery);

        $this->username=htmlspecialchars(strip_tags($this->username));
        $query->bindParam(1, $this->username);

        if($query->execute()){
            if($query->rowCount() > 0){
                return $query->fetch(PDO::FETCH_ASSOC);
            }else{
                return false;
            }
            
        }else{
            return false;
        }
    }

    public function getUserByEmail()
    {
        $sqlQuery = "SELECT id, username, email, password, date, picture, firstname, lastname FROM " . $this->db_table . " WHERE email = ?;";
        $query = $this->conexion->prepare($sqlQuery);

        $this->email=htmlspecialchars(strip_tags($this->email));
        $query->bindParam(1, $this->email);

        if($query->execute()){
            if($query->rowCount() > 0){
                return $query->fetch(PDO::FETCH_ASSOC);
            }else{
                return false;
            }
            
        }else{
            return false;
        }
    }


    public function setUserData()
    {

        if(!empty($this->username)){
            $data = $this->getUserByUsername();
        }elseif(!empty($this->email)){
            $data = $this->getUserByEmail();
        }

        if(!$data){
            return false;
        }

        extract($data);

        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->date = $date;
        $this->picture = $picture;
        $this->firstname = $firstname;
        $this->lastname = $lastname;

        return true;
        
    }


    //Metodo para actualizar informacion de un usuario
    public function updateUser()
    {
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        username = :username, 
                        email = :email,
                        password = :password, 
                        picture = :picture,
                        firstname = :firstname,
                        lastname = :lastname 
                    WHERE 
                        id = :id";

        $query = $this->conexion->prepare($sqlQuery);

        //limpiar datos
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->picture=htmlspecialchars(strip_tags($this->picture));
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->id=htmlspecialchars(strip_tags($this->id));

        

        //bind data(agregar los datos a la consulta)
        $query->bindParam(":username", $this->username);
        $query->bindParam(":email", $this->email);
        $query->bindParam(":password", $this->password);
        $query->bindParam(":picture", $this->picture);
        $query->bindParam(":firstname", $this->firstname);
        $query->bindParam(":lastname", $this->lastname);

        $query->bindParam(":id", $this->id);

        if($query->execute()){
            return true;
        }
        return false;
    }

    public function verifyUser($password){
        if($this->setUserData()){
            if(password_verify($password, $this->password)){
                return true;
            }
        }
        
        return false;
    }


    //Metodo para eliminar una tarea
    public function deleteUser()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $query = $this->conexion->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $query->bindParam(1, $this->id);

        if($query->execute()){
            return true;
        }
        return false;
    }

}