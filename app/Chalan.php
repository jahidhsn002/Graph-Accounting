<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chalan extends Model
{
    public $timestamps = false;

    public function items(){
        return $this->hasMany('App\Item');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
