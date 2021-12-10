<?php

namespace app\controllers;

use app\classes\Request;
use app\classes\Response;
use app\model\User;
use Exception;

class UserController extends Controller{

    public function __construct() {
        middleware(['Token']);
    }

    public function index(Request $request){
        echo(join("-",explode(",","1,3,10,20,14,18")));
        
    }

    public function getRole(){
        try{
            return Response::end(200,User::findByToken(getPostToken())->roles()->first());
        }catch(Exception $ex){
            Response::end("error",$ex->getMessage());
        }
    }
}