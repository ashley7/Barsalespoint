<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockLoss;
use App\WorkShift;

class StockLossController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock_loss = StockLoss::all();
        return view("sales.stockloss_list")->with(['stock_loss'=>$stock_loss]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record_check = WorkShift::where('user_id',\Auth::user()->id)->orderBy('id','DESC')->get();
        return view("sales.stock_loss")->with(['record_check'=>$record_check]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save_stock = new StockLoss($request->all());
        $save_stock->user_id = \Auth::user()->id;
        try {
            $save_stock->save();
            $status = "Stock loss saved successfuly";
            return redirect()->route("sales.create")->with(['status'=>$status]);
        } catch (\Exception $e) {
            return back()->with(['status'=>'Failed to save'.$e->getMessage()]);
        }

        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
