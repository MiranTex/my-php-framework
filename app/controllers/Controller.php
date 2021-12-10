<?php

namespace app\controllers;

use Exception;

class Controller{
    public function __construct() {
        if(!checkAppKey()){
            throw new Exception("AppKey required");
        }
    }
}