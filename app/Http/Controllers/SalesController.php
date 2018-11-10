<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\PriceTag;
use App\WorkShift;
use App\ShiftStock;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $last_shift = WorkShift::all()->where('user_id',\Auth::user()->id)->last();
        $title = "Sales";
        $sales = array();
        if (!empty($last_shift)) {
            $sales = Sale::all()->where('workshift_id',$last_shift->id);
            $title = "All sales for ".$last_shift->name." by ".$last_shift->description." on ".$last_shift->date;
        }
        
        return view("sales.all_sales")->with(['sales'=>$sales,'title'=>$title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shift = WorkShift::where('user_id',\Auth::user()->id)->orderBy('id','DESC')->get();
        return view("sales.add_sales")->with(['shift'=>$shift]);
    }

    /**
     * Store a newly created Sale in storage.
     *
     * @param  \Illuminate\Http\Request  $array of data in the form Nile special=5000
     * @return \Illuminate\Http\Response  A string
     */
    public function store(Request $request)
    {       
        $pricetag = PriceTag::all()->where('barcode',$request->data)->last();
        if (empty($pricetag)) {
            echo "The barcode does not exist in the system";
            return;
        }else{
            $this->save_sale($pricetag->name,$request->class_price,$request->data,$request->size,$pricetag,$request->workshift_id);    
        }
    }


public function save_sale($name,$class_price,$data,$size,$pricetag,$workshift_id)
{
    $save_sale = new Sale();
    $save_sale->name = $name;
    $price = 0;
    $save_sale->date_sold = strtotime(date("Y-m-d"));
    $save_sale->size = $size;

    if ($class_price == "VIP") {
        $save_sale->amount = $pricetag->vip_price*$size;
     }

    if ($class_price == "Normal") {
        $save_sale->amount = $pricetag->normal_price*$size;
                      
    }    
    $save_sale->user_id = \Auth::user()->id;
    $save_sale->number = $data;
    $save_sale->workshift_id = $workshift_id;
    try {
        $save_sale->save();

        // reduce stock

        $record_check = ShiftStock::all()->where('number',$data)->where('workshift_id',$workshift_id)->last();

        if (!empty($record_check)) {

            $total_sold = Sale::all()->where('workshift_id',$workshift_id)->where('number',$data)->sum('size');

            $record_check->stock_left = ($record_check->old_stock + $record_check->new_stock) - $total_sold;
            $record_check->save();
        }

        echo "Saved ".$save_sale->size." ".$save_sale->name."(s) = UGX: ".number_format($save_sale->amount)." <br>".$record_check->stock_left." bottles left";

    } catch (\Exception $e) {}
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
