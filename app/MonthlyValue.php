<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyValue extends Model
{
    public function station()
    {
        return $this->hasOne('App\Station');
    }
}
