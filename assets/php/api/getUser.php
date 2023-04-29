<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../class/users.php';


//Declaramos el objeto de tipo Base de Datos
$database = new Database();

$db = $database->getConnection();

//Declaramos el objeto de tipo Usuario
$items = new Users($db);

if(empty($_POST['username']) && empty($_POST['email'])){
    session_start();

    if(isset($_SESSION['username']) && isset($_SESSION['email'])){
        $items->setUsername($_SESSION['username']);
        $items->setEmail($_SESSION['email']);

        $user = $items->getUserByUsername();
    }else{
        return false;
    }
}else{
    if($_POST['username']){
        $items->setUsername($_POST['username']);
        $user = $items->getUserByUsername();  
    }else if($_POST['email']){
        $items->setUsername($_POST['email']);
        $user = $items->getUserByEmail();
    }
}



echo json_encode($user);