<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Items;
use Illuminate\Support\Facades\DB;
use Response;

class ShopController extends Controller
{
	// this is for the home page of the app
    public function index () {
   return view('shop');
  
}

// this is for the main products catalogue
    public function shop (Request $request, $req) {
      $data = $request->session()->all();

      echo "<pre>";
      print_r($data);
      echo "</pre>";

      $man = Items::where('type' , '=', 'man')->get()->toArray();
      $woman = Items::where('type' , '=', 'woman')->get()->toArray();
      $child = Items::where('type' , '=', 'child')->get()->toArray();
      $numMan = count($man);
      $numWoman = count($woman);
      $numChild = count($child);
      
      // sort by type, ascending by name
    // $manAsc =  Items::where('type' , '=', 'man')->orderBy('name', 'ASC')->get();
     $womanAsc =  DB::table('items')->select('name', 'type', 'price')->orderBy('name', 'ASC');
    // $childAsc = Items::where('type' , '=', 'child')->orderBy('name', 'ASC')->get();
     //$allAsc =  Items::all()->orderBy('type', 'ASC')->get();

     // sort by type, descending by name
     //$manDesc =  Items::where('type' , '=', 'man')->orderBy('name', 'DESC')->get();
     //$womanDesc =  Items::where('type' , '=', 'woman')->orderBy('name', 'DESC')->get();
     //$childDesc = Items::where('type' , '=', 'child')->orderBy('name', 'DESC')->get();
     //$allDesc =  Items::all()->orderBy('name', 'DESC')->get();
     

      // sort by price, ascending
     //$manPriceAsc =  Items::where('type' , '=', 'woman')->orderBy('price', 'ASC')->get();
     //$womanPriceAsc =  Items::where('type' , '=', 'woman')->orderBy('price', 'ASC')->get();
     //$childPriceAsc =  Items::where('type' , '=', 'woman')->orderBy('price', 'ASC')->get();
     //$allPriceAsc =  Items::all()->orderBy('price', 'ASC')->get();

      // sort by price, descending
    // $manPriceDesc =  Items::where('type' , '=', 'woman')->orderBy('price', 'DESC')->get();
    // $womanPriceDesc =  Items::where('type' , '=', 'woman')->orderBy('price', 'DESC')->get();
    // $childPriceDesc =  Items::where('type' , '=', 'woman')->orderBy('price', 'DESC')->get();
    // $allPriceDesc =  Items::all()->orderBy('price', 'DESC')->get();

//'manAsc' => $manAsc, 'manDesc'=> $manDesc, 'manPriceAsc' => $manPriceAsc, 'manPriceDesc' => $manPriceDesc
//'womanAsc' => $womanAsc, 'womanDesc'=> $womanDesc, 'womanPriceAsc' => $womanPriceAsc, 'womanPriceDesc' => $womanPriceDesc 
//, 'childAsc' => $childAsc, 'childDesc'=> $childDesc, 'childPriceAsc' => $childPriceAsc, 'childPriceDesc' => $childPriceDesc
//,'items' => $items, 'allAsc' => $allAsc, 'allDesc'=> $allDesc, 'allPriceAsc' => $allPriceAsc, 'allPriceDesc' => $allPriceDesc

    switch($req){
//$request->session()->put('key', 'value');
 // only with type man
    	case 'man':
    	$items = Items::where('type' , '=', 'man')->simplePaginate(9);
     // foreach($items as $item ){
        //session(['key' => $item->name]);
     // $request->session()->put('key', $item->name);
      //}

     // print_r($_SESSION['item']);
      
    return view('shopping-cart/shop' , ['page' => 'Shop / Men collection','man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' =>'Men collection', 'items' => $items ]);
  break;


    	// only with type woman
      case 'woman':
       $items = Items::where('type' , '=', 'woman')->simplePaginate(9);
        
return view('shopping-cart/shop' , ['page' => 'Shop / Women collection', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild,'title' =>'Women collection', 'items' => $items, 'womanAsc' => $womanAsc]);
  break;

        // only with type child
  case 'child':
        $items = Items::where('type' , '=', 'child')->simplePaginate(9);
        

return view('shopping-cart/shop' , ['page' => 'Shop / Children collection', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' =>'Children collection', 'items' => $items ]);
  break;

  case 'all':
        $items = Items::simplePaginate(9);
        return view('shopping-cart/shop' , ['page' => 'Shop / All categories', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' =>'All categories', 'items' => $items]);

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
    public function single (Request $request, $req) {
    $items = Items::where('name' , '=', $req)->get();
    //echo "show".$item;

    // we want to return ajax details
    $data = $request;
    $rep = Response::json("Okay");
    $resArr = (array)$rep;    
      echo "<pre>";
      print_r($resArr);
      echo "</pre>";

    $request->session()->put('cart_no', 'aduramimo');

  return view('shopping-cart/shop-single', ['page' => 'Cart / My product', 'items' => $items]);

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
