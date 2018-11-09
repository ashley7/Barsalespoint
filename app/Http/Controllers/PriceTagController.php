<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PriceTag;

class PriceTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $price_tags = PriceTag::all();
        $title = "List of price tags";
        return view('sales.pricetag_list')->with(['price_tags'=>$price_tags,'title'=>$title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.price_tags');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save_tags = new PriceTag($request->all());

        $save_tags->normal_price = str_replace(",", "", $request->normal_price);
        $save_tags->vip_price = str_replace(",", "", $request->vip_price);
        try {
            $save_tags->save();
            $status="Saved successfully";
        } catch (\Exception $e) {
            $status="The product with tag ".$save_tags->barcode." Already exists, operation failed";
        }
        return back()->with(['status'=>$status]);
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
        $read_tags = PriceTag::find($id);
        return view('sales.pricetag_edit')->with(['read_tags'=>$read_tags]);
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
        
        try {
            $save_tags = PriceTag::find($id);
            $save_tags->name = $request->name;
            $save_tags->price = str_replace(",", "", $request->price);
            $save_tags->save();
            $status="Saved successfully";
        } catch (\Exception $e) {
            $status="The product with tag".$save_tags->barcode."Already exists, operation failed";
        }
        return redirect()->route('price_tag.index')->with(['status'=>$status]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PriceTag::destroy($id);
        return back();
    }
}
