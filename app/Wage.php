<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    public $timestamps = false;

    public function dbwages(){
        return $this->hasMany('App\Dbwage');
    }

    public function transections(){
        return $this->hasMany('App\Transection');
    }
    
}
