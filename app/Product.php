<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    public function stock(){
        return $this->belongsTo('App\Stock');
    }

    public function items(){
        return $this->hasMany('App\Item');
    }
}
