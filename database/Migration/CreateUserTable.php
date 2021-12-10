<?php

namespace db\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUserTable{

    public function up(){
        Capsule::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('userimage')->nullable();
            $table->string('api_key')->nullable()->unique();
            $table->string("cash");
            $table->rememberToken();
            $table->timestamps();
        });
    }
}

