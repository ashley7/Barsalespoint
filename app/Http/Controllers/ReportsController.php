<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseAccount;
use App\Expense;
use App\BankDeposit;
use App\Bank;
use App\Cheque;

class ReportsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
   
    }

    public function create()
    {
        return view("reports");
    }

    public function store(Request $request)
    {
        $reportrange=explode("-", $request->reportrange);
        $from=$reportrange[0];

        $reformed_date = explode("/",$from);
        $new_date = $reformed_date[1]."-".$reformed_date[0]."-".$reformed_date[2];

        $to=$reportrange[1];

        $reformedto_date = explode("/",$to);
        $new_to_date = $reformedto_date[1]."-".$reformedto_date[0]."-".$reformedto_date[2];
         
        $from_date = date_create($new_date);
        $from = date_timestamp_get($from_date);

        $to_date = date_create($to);
        $to = date_timestamp_get($to_date);

        $title="Expenses From: ".date("d M Y",$from)." To: ".date("d M Y",$to);

        return view("expense.list")->with(['expense'=>Expense::whereBetween('date', [$from,$to])->get(),'title'=>$title,'accounts'=>ExpenseAccount::all(),'from'=>$from,'to'=>$to]);  
    }

    public function show($id)
    {
        $data=explode("_", $id);
        $account=ExpenseAccount::find($data[0]);
        $title="All expenses in ".$account->name." From: ".date("d M Y",$data[1])." To: ".date("d M Y",$data[2]);;
        return view("expense.selected_list")->with(['expense'=>Expense::whereBetween('date', [$data[1],$data[2]])->where('expense_account_id',$id)->get(),'title'=>$title]);
    }

   
    public function edit($id)
    {
 
    }

  
    public function update(Request $request, $id)
    {
 
    }

    public function destroy($id)
    {
   
    }
    public function bank_report(Request $request)
    {
        $reportrange=explode("-", $request->reportrange);
        $from=$reportrange[0];

        $reformed_date = explode("/",$from);
        $new_date = $reformed_date[1]."-".$reformed_date[0]."-".$reformed_date[2];

        $to=$reportrange[1];

        $reformedto_date = explode("/",$to);
        $new_to_date = $reformedto_date[1]."-".$reformedto_date[0]."-".$reformedto_date[2];
         
        $from_date = date_create($new_date);
        $from = date_timestamp_get($from_date);

        $to_date = date_create($to);
        $to = date_timestamp_get($to_date);

        $title="Bank deposits From: ".date("d M Y",$from)." To: ".date("d M Y",$to);
 
         return view("bank.deposits")->with(["deposits"=>BankDeposit::whereBetween('date', [$from,$to])->get(),'banks'=>Bank::all(),"title"=>$title,"from"=>$from,"to"=>$to]);
    }

    public function chequereport(Request $request)
    {

        $reportrange=explode("-", $request->reportrange);
        $from=$reportrange[0];

        $reformed_date = explode("/",$from);
        $new_date = $reformed_date[1]."-".$reformed_date[0]."-".$reformed_date[2];

        $to=$reportrange[1];

        $reformedto_date = explode("/",$to);
        $new_to_date = $reformedto_date[1]."-".$reformedto_date[0]."-".$reformedto_date[2];
         
        $from_date = date_create($new_date);
        $from = date_timestamp_get($from_date);

        $to_date = date_create($to);
        $to = date_timestamp_get($to_date);

        $title="Cheques From: ".date("d M Y",$from)." To: ".date("d M Y",$to);
        return view("cheque.list")->with(["cheques"=>Cheque::whereBetween('date', [$from,$to])->get(),'title'=>$title]);

    }

    public function bankreport()
    {
          return view("bank.deposits_report");
    }

    public function cheque_report($value='')
    {
        return view("cheque.show_reports");
    }
}
