<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseAccount;
use App\Expense;

class ExpenseaccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $expense_title="List of all account expenses";
        $item_title="Account summery";
        return view("account.list")->with(["accounts"=>ExpenseAccount::all(),"expense_title"=>$expense_title,"item_title"=>$item_title]);
    }

    public function create()
    {
        return view("account.create");
    }

    public function store(Request $request)
    {
        $save_expenseaccount = new ExpenseAccount($request->all());
        try {
            $save_expenseaccount->save();
        } catch (\Exception $e) {}
        return redirect("account");
    }
 
    public function show($id)
    {
        $account=ExpenseAccount::find($id);
        $title="All expenses in ".$account->name;
        return view("expense.list")->with(['expense'=>Expense::all()->where('expense_account_id',$id),'title'=>$title,'account_title'=>'',"accounts"=>ExpenseAccount::all()]);
    }
 
    public function edit($id){
        return view("account.edit_account")->with(['expense_account'=>ExpenseAccount::find($id)]);
    }
  
    public function update(Request $request, $id){
        $expense_account = ExpenseAccount::find($id);
        $expense_account->name = $request->name;
        $expense_account->description = $request->description;
        $expense_account->save();
        return redirect()->route('account.index')->with(['status'=>'Updated successfully']);
    }
 
    public function destroy($id){}
}