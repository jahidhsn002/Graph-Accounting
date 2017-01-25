<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perchase extends Model
{
    public $timestamps = false;

    public function items(){
        return $this->hasMany('App\Item');
    }

    public function conditions(){
        return $this->hasMany('App\Condition');
    }

    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function transections(){
        return $this->hasMany('App\Transection');
    }
}
