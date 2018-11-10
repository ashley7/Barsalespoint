<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkShift extends Model
{
    protected $fillable = ['name','description'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
