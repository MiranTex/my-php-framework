<?php

use app\classes\Request;

function ddd($var){
    var_dump($var);
    die();
}


function checkAppKey(){
    return isset($_POST['app_key']) && $_POST['app_key'] == app_key;
}

function generateToken(){

    return bin2hex(random_bytes(16));
}

function checkToken(){

    $check_token = validate([
        "token" => "required"
    ]);

    return $check_token["success"];
}

function getPostToken(){
    return validate([
        "token" => "required"
    ])["token"][1];
}


function middleware($middleware){

    foreach($middleware as $middle){
        $middle = "app\middleware\\".$middle;

        (new $middle)->handle(new Request());
    }

}