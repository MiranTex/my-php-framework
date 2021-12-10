<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;


class Permission extends Model{

    protected $table = "permissions";


    public function roles(){
        return $this->belongsToMany(Role::class,"roles_has_permissions");
    }

    
}