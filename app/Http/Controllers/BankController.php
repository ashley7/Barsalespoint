<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankDeposit;
use App\Bank;

class BankController extends Controller
{
    
    public function index()
    {
          return view("bank.list")->with(["bank"=>Bank::all()]);
    }

 
    public function create()
    {
        return view("bank.create");
    }

   
    public function store(Request $request)
    {
        $this->validate($request,["name"=>"required"]);
        $save_bank=new Bank();
        try {
           $save_bank->name=$request->name;
           $save_bank->save();
           $status="Operation Successifull";
        } catch (\Exception $e) {
            $status=$e->getMessage();
        }

        return redirect()->back()->with(["status"=>$status]);
        
    }


    public function show($id)
    {
        $bank=Bank::find($id);
        $title="All Bank transactions with ".$bank->name;
        return view("bank.deposits")->with(['title'=>$title,'deposits'=>BankDeposit::where('bank_id',$id)->get(),'banks'=>Bank::all()]);
    }


    public function edit($id)
    {

        $data=explode("_", $id);
        $bank=Bank::find($data[0]);
        $title="All ".$bank->name." from ".date("d-M-Y",$data[1])." to ".date("d-M-Y",$data[2]);
        return view("bank.deposits")->with(['title'=>$title,'deposits'=>BankDeposit::where('bank_id',$id)->whereBetween('date', [$data[1],$data[2]])->get(),'banks'=>Bank::all()]);

    }

   
    public function update(Request $request, $id)
    {
     
    }


    public function destroy($id)
    {
      
    }
}
