<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dbwage extends Model
{
    public $timestamps = false;

    public function employe(){
        return $this->belongsTo('App\Employe');
    }

    public function transections(){
        return $this->hasMany('App\Transection');
    }
}
