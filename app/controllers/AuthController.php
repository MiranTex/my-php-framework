<?php

namespace app\controllers;

use app\classes\Response;
use app\model\Role;
use app\model\User;
use Exception;

class AuthController{

    public function __construct() {
        
    }

    public function Login(){
       
        $validateFields = validate([
                "email" => "required|email",
                "password" => "required"
        ]);


        if($validateFields["success"]){
            try{
                $user = User::where(["email"=>$validateFields["email"][1],"password"=>sha1($validateFields["password"][1])])->get()->first();
                
                if($user != null){

                    $user->remember_token = generateToken();
                    
                    $user->save();
                    Response::end("200",$user);

                }else{
                    Response::end("308","Credenciais incorretos");
                }
                
            }catch(Exception $ex){
               
            }

        }else{
            Response::end("error",$validateFields);
        }

        
    }

    public function registar(){
        $validateFields = validate([
            "nif" => "required|unique:user",
            "name" => "required",
            "email" => "required|email|unique:user",
            "password" => "required"
        ]);

        if($validateFields["success"]){

            try{
                
                $user = new User(["name" => $validateFields["name"][1],
                                    "email" =>  $validateFields["email"][1],
                                    "password" => sha1($validateFields["password"][1]),
                                    "nif" => $validateFields["nif"][1]
                                ]);

                
                if($user->save()){
                    $user->remember_token = generateToken();
                    $user->save();

                    $user->assingRole(Role::where("name","player")->first());

                    Response::end("200",$user);
                }
            

            }catch(Exception $ex){
                throw new Exception($ex->getMessage(), 1);
                
            }
        }else{
            Response::end("error",$validateFields);
        }
    }


    public function tokenLogin(){
        if(checkToken()){
            $user = User::where("remember_token",getPostToken())->first();

            if($user){
                $user->remember_token = generateToken();
                $user->save();
                Response::end(200,$user);
            }
            else {
                throw new Exception("User session was expired", 1);
            }

        }else {
            throw new Exception("Token is required", 1);
        }

    }
}