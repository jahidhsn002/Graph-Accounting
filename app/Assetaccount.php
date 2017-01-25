<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assetaccount extends Model
{
    public $timestamps = false;

    public function payments(){
        return $this->hasMany('App\Payment');
    }
}
