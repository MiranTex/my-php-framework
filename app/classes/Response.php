<?php

namespace app\classes;


class Response{
    private $status;
    private $data;


    public function __construct($status,$data) {
        $this->status = $status;
        $this->data = $data;
        
        header( 'Content-Type:application/json;charset=utf-8');
    }


    public function send(){
        echo json_encode(array("data"=>$this->data, "status"=>$this->status));
    }

    public static function end($status = 200,$data){
        (new Response($status,$data))->send();
    }
}