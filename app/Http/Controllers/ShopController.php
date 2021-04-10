<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class ShopController extends Controller
{
	// this is for the home page of the app
    public function index () {
       // all orders
    	$orders = Orders::all();
        
        //order by id
    	//$orders = Orders::findorFail($id);

  return view('shop');

    
}

// this is for the contact us page
    public function contact () {
  return view('shopping-cart/contact');

}

}
