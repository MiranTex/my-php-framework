<?php

function validate(array $validation){
    $result = [];
    $result["success"] = true;
    
    foreach ($validation as $field => $validate) {
        if($validate != ""){

            if(!strpos($validate,'|')){
                
                $result[$field] = $validate ==! "" ? $validate($field) : filter_input(INPUT_POST,$field,FILTER_SANITIZE_STRIPPED);


                if(in_array(false,$result[$field]))
                    $result["success"] = false;
            }else{
                $explodePipeValidadte = explode("|",$validate);

                foreach ($explodePipeValidadte as $validate) {

                    if(!strpos($validate,":")){
                        $result[$field] = $validate($field);
                    }else{
                        [$function,$param] = explode(":",$validate);
                        $result[$field] = $function($field,$param);
                    }

                    
                    if(in_array(false,$result[$field]))
                        $result["success"] = false;
                }
            }
        }else{
            if(isset($_POST[$field]))
                $result[$field] = [true,filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING)];
        }

    }

    return $result;
}


function required($field){
    if(!isset($_POST[$field]) || $_POST[$field] === ''){
        return [false,"$field is required"];
    }

    return [true,filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING)];
}




function email($field){
    $emailIsValid = filter_input(INPUT_POST,$field,FILTER_VALIDATE_EMAIL);

    if(!$emailIsValid){
        return [false, "$field tem que preencher o formato de um email"];
    }

    return [true,$emailIsValid];
}

function unique($field,$table){
    $unique = filter_input(INPUT_POST,$field,FILTER_SANITIZE_STRING);

    if(("\app\model\\".$table)::where($field,$unique)->count() > 0){
        return [false, "$field já existe"];
    }

    return [true,$unique];
}

function getPost($field){
    if(!isset($_POST[$field]) || $_POST[$field] === ''){
        return [false,"$field is required"];
    }

    return [true,filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING)];
}


function filter(){
    $filter = [
        "name" => FILTER_SANITIZE_STRIPPED,
        "email" => FILTER_VALIDATE_EMAIL,
        "endereco" => FILTER_SANITIZE_STRIPPED,
        "tel" => FILTER_SANITIZE_STRIPPED
    ];

    $data = filter_input_array(INPUT_POST,$filter);

    return in_array(false,$data) ? false : $data;
}