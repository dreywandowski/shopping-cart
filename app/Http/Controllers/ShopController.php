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
  return view('shopping-cart/shop' , ['page' => 'Shop']);

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
