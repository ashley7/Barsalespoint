<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseAccount;
use App\Expense;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      // return view("expense.list")->with(['expense'=>Expense::all(),'title'=>'All the expenses','accounts'=>ExpenseAccount::all()]);
    	return redirect()->route('sales.create');
    }
}