<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; chatset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/contactus.php';


//Declaramos el objeto de tipo Base de Datos
$database = new Database();

$db = $database->getConnection();

//Declaramos el objeto de tipo Users
$item = new Contactus($db);

$item->setName($_POST['name']);
$item->setEmail($_POST['email']);
$item->setPhone($_POST['phone']);
$item->setMessage($_POST['message']);

if($item->insertMessage()){
	echo json_encode(array('state'=>'success'));

}else{
	echo json_encode(array('state'=>'fail', 'reason'=>'Ha ocurrido un error, intentelo mas tarde'));
}