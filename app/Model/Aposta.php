<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;


class Aposta extends Model{

    protected $table = "apostas";

    protected $fillable = ["totoloto","joker","id_jogo","id_user","points","nif","from_third","joker_win"];
}

