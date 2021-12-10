<?php

namespace db\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateJogoTable{

    public function up(){
        Capsule::schema()->create('jogos', function ($table) {
            $table->increments('id');
            $table->string('totoloto');
            $table->string('joker');
            $table->date('start');
            $table->date('end');
            $table->string('premio_joker');
            $table->string('premio_totoloto');
            $table->timestamps();
        });
    }
}

