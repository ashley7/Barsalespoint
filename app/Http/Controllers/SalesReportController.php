<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;

class SalesReportController extends Controller
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
        return view("sales.get_sales_report");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $title="Sales Between: ".date("d M Y",$from)." To: ".date("d M Y",$to);

        $sales = Sale::where('user_id',\Auth::user()->id)->whereBetween('date_sold', [$from,$to])->get();

        $sales_count = Sale::where('user_id',\Auth::user()->id)->whereBetween('date_sold', [$from,$to])->orderBy('name')->get();

  

        $data = ['sales'=>$sales,'counts'=>$sales_count,'title'=>$title];

        return view("sales.sales_report")->with($data);
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
