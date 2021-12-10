<?php

namespace app\Middleware;

use app\classes\Request;
use app\model\User;
use Exception;

class Token{

    public function handle(Request $request){
        if(!$request->has("token") || User::where("remember_token",getPostToken())->get()->count() == 0)
            throw new Exception("Valid token is required", 1);
            
    }
}