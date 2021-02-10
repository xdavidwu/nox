<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyValue extends Model
{
    public function station()
    {
        return $this->belongsTo('App\Models\Station');
    }
}
