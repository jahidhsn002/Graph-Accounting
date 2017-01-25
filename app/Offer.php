<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public $timestamps = false;

    public function items(){
        return $this->hasMany('App\Item');
    }

    public function conditions(){
        return $this->hasMany('App\Condition');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
