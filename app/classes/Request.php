<?php

namespace app\classes;

use stdClass;

class Request{

    public function __construct() {
        // $this->request = new stdClass();

        $this->headers = $this->getHeaders();

        $this->body = $this->getBody();
    }

    private function getBody(){
        $body = new stdClass();
        foreach ($_POST as $key => $value) {
            $body->$key = $value;
        }

        return $body;
    }

    private function getHeaders(){
        $headers = new stdClass();

        foreach($_SERVER as $key => $value){
            $headers->$key = $value;
        }

        return $headers;
    }

    public function all(){
        return $this->body;
    }

    public function has($index){
        return isset($this->body->$index);
    }

}