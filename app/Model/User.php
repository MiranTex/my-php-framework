<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;
use app\traits\Roles;

class User extends Model{

    use Roles;

    protected $fillable = ["nif","name","email","password","cache"];

    protected $table =  'users';

    protected $hidden = ['password',"id","api_key","userimage"];


    public static function findByToken($token){
        return User::where(["remember_token"=>$token])->get()->first();
    }

    public function apostas(){
        return $this->hasMany(Aposta::class,'id_user');
    }
    
}