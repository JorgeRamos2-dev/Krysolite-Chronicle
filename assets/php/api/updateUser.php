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


//Declaramos el objeto de tipo Tarea
$item = new Users($db);


$item->setId($_POST['id']);
$item->setUserData();

if(!empty($_POST['name'])){
	$item->setName($_POST['name']);
}

if(!empty($_POST['email'])){
	$item->setEmail($_POST['email']);
}

if(!empty($_POST['password'])){
	$item->setPassword(password_hash(htmlspecialchars(strip_tags($_POST['password'])), PASSWORD_DEFAULT));
}

if(!empty($_POST['picture'])){
	$item->setPicture($_POST['picture']);
}

if($item->updateUser()){
	echo json_encode('Usuario actualizado con exito');
}else{
	echo json_encode('Error al actualizar');
}