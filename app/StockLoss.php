<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockLoss extends Model
{
    protected $fillable = ["name","size","description","workshift_id"];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
