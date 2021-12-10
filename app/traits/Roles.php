<?php

namespace app\traits;

use app\model\Permission;
use app\model\Role;

trait Roles{

    public function roles(){
        return $this->morphToMany(Role::class,'model','model_has_roles');
    }

    public function hasRole($role_){
        $hasRole = false;
        foreach($this->roles as $role){
            if($role->name == $role_)
                $hasRole = true;
        }

        return $hasRole;
    }

    public function assingRole($role){
        $this->roles()->sync($role);
    }

    public function can($permission_){
        $can = false;

        foreach ($this->roles()->first()->permissions as $key => $permission) {
            if($permission->name == $permission_)
                $can = true;
        }

        foreach ($this->permissions as $key => $permission) {
            if($permission->name == $permission_)
                $can = true;
        }

        return $can;
    }

    public function permissions(){
        return $this->morphToMany(Permission::class,'model','model_has_permissions');
    }
}