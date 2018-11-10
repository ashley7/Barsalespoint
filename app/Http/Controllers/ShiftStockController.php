<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShiftStock;

class ShiftStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = explode("*",$request->information);
        $number = $data[0];
        $stock_step = $data[1];

        $stock_value = $request->stock_value;
        $workshift_id = $request->shift;

        $save_stock = new ShiftStock();

        if ($stock_step == "old_stock") {
            $save_stock->old_stock = $stock_value;
        }

        if ($stock_step == "new_stock") {
            $save_stock->new_stock = $stock_value;
        }        
        
        $save_stock->workshift_id = $workshift_id;
        $save_stock->number = $number;
        $save_stock->user_id = \Auth::user()->id;

        $record_check = ShiftStock::all()->where('number',$number)->where('workshift_id',$workshift_id);

        if ($record_check->count() == 0) {
            $save_stock->save();
        }else{
            $last_record = $record_check->last();
        

            if ($stock_step == "old_stock") {
                $last_record->old_stock = $stock_value;
            }

            if ($stock_step == "new_stock") {
                $last_record->new_stock = $stock_value;
            }

            try {
              $last_record->save();
              echo "Saved";  
            } catch (\Exception $e) {
               echo $e->getMessage(); 
            }

            
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
