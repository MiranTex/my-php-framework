<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;


class Role extends Model{

    protected $table = "Roles";


    public function permissions(){
        return $this->belongsToMany(Permission::class,"role_has_permissions");
    }
}