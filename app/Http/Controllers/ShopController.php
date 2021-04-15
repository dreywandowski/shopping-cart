<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Items;


class ShopController extends Controller
{
	// this is for the home page of the app
    public function index () {
   return view('shop');
  
}

// this is for the main products catalogue
    public function shop ($req) {
    switch($req){

 // only with type man
    	case 'man':
    	$items = Items::where('type' , '=', 'man')->simplePaginate(9);

    return view('shopping-cart/shop' , ['page' => 'Shop / Men collection', 'title' =>'Men collection', 'items' => $items]);
  break;


    	// only with type woman
      case 'woman':
       $items = Items::where('type' , '=', 'woman')->simplePaginate(9);
return view('shopping-cart/shop' , ['page' => 'Shop / Women collection', 'title' =>'Women collection', 'items' => $items]);
  break;

        // only with type child
  case 'child':
        $items = Items::where('type' , '=', 'child')->simplePaginate(9);
return view('shopping-cart/shop' , ['page' => 'Shop / Children collection','title' =>'Children collection', 'items' => $items]);
  break;

  case 'all':
        $items = Items::simplePaginate(9);
        return view('shopping-cart/shop' , ['page' => 'Shop / All categories', 'title' =>'All categories','items' => $items]);

        break;

  default:

    }
    	

}


// this is for the contact us page
    public function contact () {
  return view('shopping-cart/contact', ['page' => 'Contact']);

}

// this returns the cart for us
    public function cart () {
  return view('shopping-cart/cart', ['page' => 'Cart']);

}

// this returns a single item to be added to the cart
    public function single () {
  return view('shopping-cart/shop-single', ['page' => 'Cart / My product']);

}

// this returns a single item to be added to the cart
    public function checkout () {
  return view('shopping-cart/checkout', ['page' => 'Checkout']);

}



// thank you page after sucessful order and payment
    public function thanks () {
  return view('shopping-cart/thankyou', ['page' => 'Thanks for your order']);

}
}
