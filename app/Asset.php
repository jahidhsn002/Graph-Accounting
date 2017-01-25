<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public $timestamps = false;

    public function assetaccount(){
        return $this->belongsTo('App\Assetaccount');
    }
}
