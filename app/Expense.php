<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['voucher_number','amount','particular','expense_account_id','phone_number','person_name'];

    public function expenseaccount()
    {
    	return $this->belongsTo('App\ExpenseAccount','expense_account_id');
    }
}
