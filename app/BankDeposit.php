<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDeposit extends Model
{
    protected $fillable=["bank_id","amount","deposited_by"];

    public function user($value='')
    {
    	return $this->belongsTo('App\User');
    }

    public function bank($value='')
    {
    	return $this->belongsTo('App\Bank');
    }
 
}
