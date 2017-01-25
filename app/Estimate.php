<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    public $timestamps = false;

    public function items(){
        return $this->hasMany('App\Item');
    }

    public function jobs(){
        return $this->hasMany('App\Job');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function transections(){
        return $this->hasMany('App\Transection');
    }

    public function conditions(){
        return $this->hasMany('App\Condition');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
