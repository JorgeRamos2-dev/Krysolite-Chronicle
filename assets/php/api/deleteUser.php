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

if($item->deleteUser()){
	echo json_encode('Usuario eliminado con exito');
}else{
	echo json_encode('Error al eliminar');
}