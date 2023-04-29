<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; chatset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/users.php';


//Declaramos el objeto de tipo Base de Datos
$database = new Database();

$db = $database->getConnection();


//Declaramos el objeto de tipo Tarea
$item = new Users($db);


session_start();

if(!isset($_SESSION['username']) || !isset($_SESSION['email'])){
	header('Location: /');
}


$item->setUsername($_SESSION['username']);
$item->setUserData();


if(!empty($_POST['username']) && $_SESSION['username'] != $_POST['username']){

	$item->setUsername($_POST['username']);
	if($item->getUserByUsername()){
		echo json_encode(array('state'=>'fail','reason'=>'El nombre de usuario ya esta registado'));
		return false;
	}


	$_SESSION['username'] = $_POST['username'];
}

if(!empty($_POST['email']) && $_SESSION['email'] != $_POST['email']){

	$item->setEmail($_POST['email']);
	if($item->getUserByEmail()){
		echo json_encode(array('state'=>'fail','reason'=>'El correo ya esta registado'));
		return false;
	}

	$_SESSION['email'] = $_POST['email'];
}

if(!empty($_POST['password'])){
	$item->setPassword(password_hash(htmlspecialchars(strip_tags($_POST['password'])), PASSWORD_DEFAULT));
}

if(!empty($_POST['picture'])){
	$item->setPicture($_POST['picture']);
}

if(!empty($_POST['firstname'])){
	$item->setFirstname($_POST['firstname']);
}

if(!empty($_POST['lastname'])){
	$item->setLastname($_POST['lastname']);
}



if($item->updateUser()){
	echo json_encode(array('state'=>'success'));
	return true;
}else{
	echo json_encode(array('state'=>'fail'));
	return false;
}