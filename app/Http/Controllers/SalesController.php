<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::where('user_id',\Auth::user()->id)->orderBy('id','desc')->get();
        $title = "All sales by ".\Auth::user()->name;
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
        $save_sale = new Sale();
        // name=price 
        $data = explode("=",$request->data);
        if (count($data) != 2) {
            // echo "Invalid data, Operation failed";
            return;
        }

        $fetach_amount = explode("-",$data[1]);
        $save_sale->name = $data[0];
        $date = strtotime(date("Y-m-d"));
        $save_sale->date_sold = $date;
        $save_sale->amount = $fetach_amount[0];
        $save_sale->user_id = \Auth::user()->id;
        try {
            if ($fetach_amount[1] == "H") {
                $save_sale->save();
                echo "Saved ".$data[0]." = UGX ".number_format($fetach_amount[0]);
            }

        } catch (\Exception $e) {
            // echo $e->getMessage()." Operation failed";
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
