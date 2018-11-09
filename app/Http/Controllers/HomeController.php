<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PriceTag;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
	   	return redirect()->route('sales.create');
    }

    public function price_tags(Request $request)
    {
    	$pricetag = PriceTag::all()->where('barcode',$request->data)->last();
    	if (empty($pricetag)) {
    		echo "The barcode you scanned is not in the system.";
    		return;
    	}else{
    		echo "
    		<table class='table'>
    		<tr> <td> Name</td> <td> $pricetag->name</td></tr>".
    		 "<tr> <td> Normal Price</td> <td>UGX ".number_format((double)$pricetag->normal_price)."</td></tr>
    		 <tr> <td> VIP Price:</td> <td> UGX ". number_format((double)$pricetag->vip_price)."</td></tr>
    		 </table>
    		";
    	}
    }
}