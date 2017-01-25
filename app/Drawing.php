<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drawing extends Model
{
    public $timestamps = false;

    public function owner(){
        return $this->belongsTo('App\Owner');
    }
}
