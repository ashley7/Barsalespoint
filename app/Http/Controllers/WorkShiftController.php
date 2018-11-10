<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkShift;
use App\Sale;
use App\PriceTag;
use App\StockLoss;
use App\ShiftStock;

class WorkShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work_shift = WorkShift::all();
        return view("sales.shift_list")->with(['work_shift'=>$work_shift]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("sales.shifts");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $previous_shift = WorkShift::all()->last();
        $save_shift = new WorkShift($request->all());
        $save_shift->user_id = \Auth::user()->id;
        $save_shift->date = date("Y-M-d");
        try {
            $save_shift->save();

            // update the old stock
            $price_tags = PriceTag::all();
            foreach ($price_tags as $price_tag) {
                if (!empty($previous_shift)) {
                    $record_check = ShiftStock::all()->where('number',$price_tag->barcode)->where('workshift_id',$previous_shift->id)->last();
                    if (!empty($record_check)) {

                        $total_sold = Sale::all()->where('workshift_id',$previous_shift->id)->where('number',$price_tag->barcode)->sum('size');
                        $old_stock = ($record_check->old_stock + $record_check->new_stock) - $total_sold;
                        $save_stock = new ShiftStock();
                        $save_stock->old_stock = $old_stock;
                        $save_stock->workshift_id = $save_shift->id;
                        $save_stock->number = $price_tag->barcode;
                        $save_stock->user_id = \Auth::user()->id;
                        try {
                            $save_stock->save();
                        } catch (\Exception $e) {}

                    }
                }
                
            }


            $status = "Work shift created successfully";
        } catch (\Exception $e) {
            $status = "Work shift was not created";
        }

        return redirect()->route('work_shifts.index')->with(['status'=>$status]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $work_shifts = WorkShift::find($id);
        $sales = Sale::all()->where('workshift_id',$id);
        $brands = PriceTag::all();
        $stock_loss = StockLoss::all()->where('workshift_id',$id);
        $data = ['work_shifts'=>$work_shifts,'sales'=>$sales,'brands'=>$brands,'stock_loss'=>$stock_loss];
        return view('sales.shift_details')->with($data);
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
