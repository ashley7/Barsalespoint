<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function user($value='')
    {
    	return $this->belongsTo('App\User');
    }
}
