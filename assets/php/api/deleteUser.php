<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; chatset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/users.php';


//Declaramos el objeto de tipo Base de Datos
$database = new Database();

$db = $database->getConnection();


session_start();

if(!isset($_SESSION['username']) || !isset($_SESSION['email'])){
	header('Location: /');
}


//Declaramos el objeto de tipo Tarea
$item = new Users($db);

$item->setUsername($_SESSION['username']);
$data = $item->getUserByUsername();

$item->setId($data['id']);



if($item->deleteUser()){
	session_unset();
	session_destroy();
	echo json_encode(array('state'=>'success'));
}else{
	echo json_encode(array('state'=>'fail'));
}