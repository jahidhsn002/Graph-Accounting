<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public $timestamps = false;

    public function expenseaccount(){
        return $this->belongsTo('App\Expenseaccount');
    }
}
