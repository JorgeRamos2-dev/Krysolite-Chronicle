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

//Declaramos el objeto de tipo Users
$item = new Users($db);

$item->setUsername($_POST['username']);
$item->setEmail($_POST['email']);
$item->setPassword(password_hash(htmlspecialchars(strip_tags($_POST['password'])), PASSWORD_DEFAULT));

if($item->insertUser()){
	echo json_encode('Usuario creado con exito');

	session_start();
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['email'] = $_POST['email'];

}else{
	echo json_encode('Error al agregar usuario');
}