<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    protected $fillable = ["cheque_number","amount","particular","bank_id"];

    public function user($value='')
    {
    	return $this->belongsTo('App\User');
    }

    public function bank($value='')
    {
    	return $this->belongsTo('App\Bank');
    }
}
