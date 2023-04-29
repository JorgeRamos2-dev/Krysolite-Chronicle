<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../class/users.php';


session_start();

if(isset($_SESSION['username']) && isset($_SESSION['email'])){
    echo json_encode(array('username'=>$_SESSION['username'], 'email'=>$_SESSION['email']));
}else{
    return false;
}