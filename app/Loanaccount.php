<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loanaccount extends Model
{
    public $timestamps = false;

    public function payments(){
        return $this->hasMany('App\Payment');
    }
}
