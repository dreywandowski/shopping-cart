<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class ShopController extends Controller
{
	// this is for the home page of the app
    public function index () {
   return view('shop');
  
}

// this is for the main products catalogue
    public function shop () {
  return view('shopping-cart/shop');

}


// this is for the contact us page
    public function contact () {
  return view('shopping-cart/contact');

}

// this returns the cart for us
    public function cart () {
  return view('shopping-cart/cart');

}

// this returns a single item to be added to the cart
    public function single () {
  return view('shopping-cart/shop-single');

}

// this returns a single item to be added to the cart
    public function checkout () {
  return view('shopping-cart/checkout');

}

// thank you page after sucessful order and payment
    public function thanks () {
  return view('shopping-cart/thankyou');

}
}
