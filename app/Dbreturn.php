<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dbreturn extends Model
{
    public $timestamps = false;
	
	protected $table = 'returns';

    public function items(){
        return $this->hasMany('App\Item','return_id');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }
}
