<?php

include '../bootstrap/bootstrap.php';

// header( 'Content-Type:application/json');
// header("Access-Control-Allow-Methods: post");
// header('Access-Control-Allow-Origin: *');


// header( 'Content-Type:application/json;charset=utf-8');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');



$router->startRouting($_SERVER["REQUEST_URI"],$_SERVER['REQUEST_METHOD']);


