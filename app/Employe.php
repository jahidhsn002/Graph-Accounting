<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    public $timestamps = false;

    public function items(){
        return $this->hasMany('App\Item');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function transections(){
        return $this->hasMany('App\Transection');
    }
}
