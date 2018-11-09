<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Category;

class BarcodeController extends Controller
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
       return view("sales.get_barcodes")->with(['category'=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $barcodes = array();

        $time = time();


        for ($i=0; $i < $request->number; $i++) { 
            $barcode = new BarcodeGenerator();
            $barcode->setText($time."-H");
            $barcode->setType(BarcodeGenerator::Code128);
            $barcode->setScale(0);
            $barcode->setThickness(25);
            $barcode->setFontSize(10);
            $code = $barcode->generate();
            $barcodes[] = '<img src="data:image/png;base64,'.$code.'" /> <br>';
        }

        return view('sales.printbc')->with(['barcodes'=>$barcodes]);       
        

       
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
