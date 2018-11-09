<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\PriceTag;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();
        $title = "All sales";
        return view("sales.all_sales")->with(['sales'=>$sales,'title'=>$title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("sales.add_sales");
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
            $this->save_sale($pricetag->name,$request->class_price,$request->data,$request->size,$pricetag);    
        }
    }


public function save_sale($name,$class_price,$data,$size,$pricetag)
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
    try {
        $save_sale->save();
        echo "Saved ".$save_sale->size." ".$save_sale->name."(s) = UGX: ".number_format($save_sale->amount);      
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
