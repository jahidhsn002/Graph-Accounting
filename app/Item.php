<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    public function service(){
        return $this->belongsTo('App\Service');
    }

    public function estimate(){
        return $this->belongsTo('App\Estimate');
    }

    public function perchase(){
        return $this->belongsTo('App\Perchase');
    }

    public function invoice(){
        return $this->belongsTo('App\Invoice');
    }

    public function sale(){
        return $this->belongsTo('App\Sale');
    }
}
