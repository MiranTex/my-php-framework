<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;


class Jogo extends Model{

    protected $table = "jogos";

    protected $fillable = ["totoloto","premio_totoloto","joker","premio_joker","start","end"];

    public function apostas(){
        return $this->hasMany(Aposta::class,"id_jogo");
    }

}