<?php

namespace app\controllers;

use app\classes\Response;
use app\model\Jogo;
use app\model\User;
use Carbon\Carbon;
use Exception;

class JogoController{

    private $user;

    public function __construct() {

        middleware(["token"]);

        if(!checkToken())
            throw new Exception("Token esperado");
        else{
            $this->user = User::findByToken(getPostToken());
        }
    }

    public function index(){

        try{
            $user = User::findByToken(getPostToken());

            if($user && $user->can("view all game"))
                Response::end(200,Jogo::where("active",1)->get());
            else{
                Response::end("308","Não autorizado");
            }

        }catch(Exception $ex){
            Response::end("500","Ocorreu algum erro");

        }
    }


    public function store(){
        if($this->user && $this->user->can("create game")){
            $fieldsValidate = validate([
                "start"=>"required",
                "end"=> "required",
                "premio_totoloto" => "required",
                "premio_joker" => "required",
            ]);

            if($fieldsValidate['success']){
                $jogo = new Jogo([
                    "start" => $fieldsValidate["start"][1],
                    "end" => $fieldsValidate["end"][1],
                    "premio_totoloto" => $fieldsValidate["premio_totoloto"][1],
                    "premio_joker" => $fieldsValidate["premio_joker"][1],
                ]);

                if($jogo->save()){
                    Response::end(200,$jogo); 
                }
            }else{
                Response::end(500,$fieldsValidate);
            }
            
        }else{
            throw new Exception("User sem permissão", 1);
        }
    }

    public function getJogoAtivo(){
        try{
            if($this->user->can("bet")){
                Response::end(200,Jogo::where("active",true)->first());
            }else{
                Response::end(200,"cant");
            }
        }catch(Exception $ex){
            Response::end("error",$ex->getMessage());
        }
    }

    public function getJogoLast(){
        try{
            if($this->user->hasRole("Admin")){
                Response::end(200,Jogo::orderBy('id','desc')->first());
            }else{
                Response::end(200,"cant");
            }
        }catch(Exception $ex){
            Response::end("error",$ex->getMessage());
        }
    }

    public function generateNums(){
        if($this->user->hasRole("Admin")){

            try{
                $nums = array();
                for($i=0;$i<6;$i++){
                    $nums[] = rand(1,49);
                }

                $jogo = Jogo::where("active",true)->first();

                $joker = rand(0,99999999);

                $jogo->joker = $joker;
                $jogo->totoloto = implode("-",$nums);

                $jogo->active = false;

                $jogo->save();

                $this->searchWinner($jogo);

                Response::end(200,$jogo);
            }catch(Exception $ex){

            }

        }
    }

    private function searchWinner($jogo){
        $apostas = $jogo->apostas;

        $totoloto = explode("-",$jogo->totoloto);
        $joker = $jogo->joker;
        
        foreach ($apostas as $key => $aposta) {
            $aposta->points = count(array_intersect($totoloto,explode("-",$aposta->totoloto)));
            $aposta->joker_win = $joker == $aposta->joker;
            $aposta->save();
        }
    }

    public function get(){

    }
}