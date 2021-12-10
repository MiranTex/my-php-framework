<?php

namespace app\controllers;

use app\classes\Request;
use app\classes\Response;
use app\model\Aposta;
use app\model\User;
use Exception;

class ApostaController{

    public function __construct() {
        middleware(['Token']);
    }


    public function index(){

    }


    public function store(){

        $validateFields = validate([
            "totoloto"=> "",
            "joker" => "",
            "id_jogo" => "required",
            "token" => "required"
        ]);

        if($validateFields["success"]){
            try{
                $user = User::findByToken(getPostToken());
                if($user->can("bet")){
                    $aposta = new Aposta([
                        "id_jogo" => $validateFields["id_jogo"][1],
                        "totoloto" => $validateFields["totoloto"][1],
                        "joker" => $validateFields["joker"][1],
                        "id_user" => $user->id
                    ]);

                    if($aposta->save()){
                        Response::end(200,"Success");
                    }

                }else{
                    Response::end(308,"User sem permissao");
                }
                
            }catch(Exception $ex){
                throw new Exception("Erro ao registar a aposta", 1);
            }
        }else{
            Response::end(500,$validateFields);
        }
    }


    public function apostaTerceiro(Request $request){


        try{

            $user = User::findByToken(getPostToken());

            if($user->can("third play")){
                if($request->has("totoloto") || $request->has("joker")){
                    $validateFields = validate([
                        "totoloto"=> "",
                        "joker" => "",
                        "id_jogo" => "required",
                        "token" => "required",
                        "name"  => "required",
                        "nif"   => "required"
                    ]);
                    
                    if($validateFields["success"]){
                        $aposta = new Aposta([
                            "id_jogo" => $validateFields["id_jogo"][1],
                            "totoloto" => isset($validateFields["totoloto"][1]) ? $validateFields["totoloto"][1] : "",
                            "joker" => isset($validateFields["joker"][1]) ? $validateFields["joker"][1] : "" ,
                            "id_user" => $user->id,
                            "from_third" => true
                        ]);

                        if($aposta->save()){
                            Response::end(200,$aposta);
                        }else{
                            throw new Exception("Ocorreu algum erro", 1);
                            
                        }
                        
                    }else{
                        Response::end(500,$validateFields);
                    }
                }else{
                    Response::end(500,"Selecione pelo menos um jogo");
                }
                
            }else{
                Response::end(308,"Sem autorização");
            }
        }catch(Exception $ex){
            throw new Exception("Error Processing Request", 1); 
        }        
    }


}