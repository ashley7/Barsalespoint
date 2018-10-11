<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cheque;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("cheque.list")->with(["cheques"=>Cheque::all(),'title'=>'List of cheque dispatch']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cheque.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save_cheque=new Cheque($request->all());
        $save_cheque->user_id=\Auth::user()->id;
        $to_date = date_create(str_replace("/", "-", $request->date));
        $save_cheque->date=date_timestamp_get($to_date);
        $save_cheque->amount=(double)str_replace(",", "", $request->amount);
        try {
         $save_cheque->save(); 
         echo "Cheque saved successfully";
         // return back()->with(["status"=>"Cheque saved successfully."]);  
        } catch (\Exception $e) {
             // return back();
            echo $e->getMessage();
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
      $read_cheque = Cheque::find($id);
      return view("cheque.edit_cheque")->with(compact('read_cheque'));
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
        $read_cheque = Cheque::find($id);
        if (!empty($request->cheque_number)) {
           $read_cheque->cheque_number=$request->cheque_number;
        }

        if (!empty($request->amount)) {
          $read_cheque->amount = (double)str_replace(",", "", $request->amount);
        }
        
        if (!empty($request->particular)) {
            $read_cheque->particular = $request->particular;
        }

        if (!empty($request->date)) {
            $read_cheque->date = $request->date;
        }

        if (!empty($request->bank_id)) {
            $read_cheque->bank_id=$request->bank_id;
        }

        try {
            $read_cheque->save();
        } catch (\Exception $e) {}
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
            Cheque::destroy($id);
        } catch (\Exception $e) {
            
        }
        return back()->with(["status"=>"Operation successfull"]);
    }



    
}
