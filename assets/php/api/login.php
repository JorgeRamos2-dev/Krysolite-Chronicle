<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../class/users.php';


//Declaramos el objeto de tipo Base de Datos
$database = new Database();

$db = $database->getConnection();

//Declaramos el objeto de tipo Tarea
$items = new Users($db);

if(empty($_POST['username']) && empty($_POST['email'])){
    return false;
}

if(!empty($_POST['username'])){
    $items->setUsername($_POST['username']);

}else{
    $items->setEmail($_POST['email']);
}



if($items->verifyUser($_POST['password'])){

    session_start();

    $_SESSION['username'] = $items->getUsername();
    $_SESSION['email'] = $items->getEmail();

    echo json_encode(array('state'=>'success'));
    return true;
}else{
    echo json_encode(array(
        'state' => 'fail',
        'message'=>'Usuario no encontrado'));

    return false;
}