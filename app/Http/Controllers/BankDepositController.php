<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankDeposit;
use App\Bank;

class BankDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("bank.deposits")->with(["deposits"=>BankDeposit::all(),'banks'=>Bank::all(),'title'=>'List of All Banks Deposits']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("bank.add_deposite");
    }


    public function store(Request $request)
    {

        $this->validate($request,["bank_id"=>"required","amount"=>"required","date"=>"required","deposited_by"=>"required"]);

        $save_bankdeposit = new BankDeposit($request->all());
        $save_bankdeposit->user_id=\Auth::user()->id;
        $to_date = date_create(str_replace("/", "-", $request->date));
        $save_bankdeposit->date=date_timestamp_get($to_date);
        $save_bankdeposit->amount=(double)str_replace(",", "", $request->amount);
        $save_bankdeposit->voucher_number = $request->voucher_number;
        try {
            $save_bankdeposit->save();
            $status="Operation successful.";

             // return redirect("bank_deposite")->with(["status"=>$status]);
        } catch (\Exception $e) {
            $status=$e->getMessage();
             // return back()->with(["status"=>$status]);
        }
        echo $status;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $read_bankdeposit=BankDeposit::find($id);
        return view("bank.edit_deposite")->with(['read_bankdeposit'=>$read_bankdeposit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
 
        $read_bankdeposit=BankDeposit::find($id);
        if (!empty($request->bank_id)) {
         $read_bankdeposit->bank_id=$request->bank_id;    
        }

        if (!empty($request->deposited_by)) {
           $read_bankdeposit->deposited_by=$request->deposited_by;
        }

        if (!empty($request->voucher_number)) {
           $read_bankdeposit->voucher_number=$request->voucher_number;
        }

        if (!empty($request->amount)) {
            $read_bankdeposit->amount = (double)str_replace(",", "", $request->amount);
        }

              
        try {
            $read_bankdeposit->save();
        } catch (\Exception $e) {
            echo $e->getMessage();exit();
        }

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            BankDeposit::destroy($id);
        } catch (\Exception $e) {
            
        }

        return back()->with(["status"=>"Operation successfull"]);
    }
}
