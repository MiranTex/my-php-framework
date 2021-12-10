<?php

    include '../app/classes/Router.php';

    use app\classes\Router;

    $router = new Router;

    //Auth routes

    $router->post('/login',"AuthController@login");

    $router->post('/tokenlogin',"AuthController@tokenLogin");

    $router->post("/registar", "AuthController@registar");


    //Game routes
    $router->post("/jogo", "JogoController@index");

    $router->post("/jogo/create", "JogoController@store");

    $router->post("/jogo/jogoativo","JogoController@getJogoAtivo");

    $router->post("/jogo/ultimojogo","JogoController@getJogoLast");


    $router->post("/jogo/sortear","JogoController@generateNums");


    //Apost Routes
    $router->post("/aposta/create","ApostaController@store");

    $router->post("/aposta/terceiro","ApostaController@apostaTerceiro");


    //User Routes
    $router->post('/users','UserController@index');

    $router->post("/user/role","UserController@getRole");

