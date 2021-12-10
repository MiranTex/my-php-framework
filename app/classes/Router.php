<?php

namespace app\classes;

use Exception;

class Router{

    public $routes;

    public function init(){
        $this->routes = array();
    }
    
    
    public function get($url,$action){
        $this->routes['GET'][$url] = $action;
    }

    public function post($url,$action){
        $this->routes['POST'][$url] = $action;
    }

    public function startRouting($url,$method){
        if($method == "POST"){
            if(isset($this->routes[$method][$url])){
                if((isset($_POST['app_key']) && $_POST['app_key'] == app_key))
                    $this->runControllerFunction($this->routes[$method][$url]);
                else 
                    (new Response("308","Não autorizado"))->send();

            }else{
                (new Response("404","Pagina nao encontrada"))->send();
            }
        }else{
        
            if(isset($this->routes[$method][$url])){

                $this->runControllerFunction($this->routes[$method][$url]);

            }else{
                (new Response("404","Pagina nao encontrada"))->send();
            }
        }
    }

    private function runControllerFunction($action){

        try{
            $controller = explode("@",$action)[0];
            $function = explode("@",$action)[1];

            $class = 'app\\controllers\\'.$controller;

            $instance = new $class();

            if($instance != null)
                $instance->$function(new Request());

            else
                (new Response("308","Controller não encontrado"))->send();

        }catch(Exception $ex){
            (new Response("308",$ex->getMessage()))->send();
        }
        

    }
}