<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
    public $timestamps = false;

    public function owner(){
        return $this->belongsTo('App\Owner');
    }
}
