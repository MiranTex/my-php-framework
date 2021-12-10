<?php

namespace db\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;


class CreateApostaTable{

    public function up(){
        Capsule::schema()->create('apostas', function ($table) {
            $table->increments('id');
            $table->string('totoloto');
            $table->string('joker');
            $table->bigInteger('id_jogo');
            $table->bigInteger('id_user');
            $table->string('points');
            $table->timestamps();

            $table->foreign('id_jogo')->references('id')->on('jogos');
            $table->foreign('id_juser')->references('id')->on('users');

        });
    }
}