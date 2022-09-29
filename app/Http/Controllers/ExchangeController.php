<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fx_rates;
use App\Mail\ExchangeRates;

class ExchangeController extends Controller
{
    public function showRates(){
        $data = session('details');
        $cant;

        if ($data != null) $cant = count($data);
        else $cant = ' ';


        $today = date("Y-m-d");
        $yesterday = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $today) ) ));

        // $rates = Fx_rates::where('updated_at', '=', $today)->orderBy('desc','desc')->get()->toArray();
        $rates = Fx_rates::latest()->take(5)->get()->toArray();
       /*echo "<pre>";
        print_r($rates);
        echo "</pre>";*/
        //dump();

        $today = date('Y-m-d');
        $today = date("jS F, Y", strtotime($today));

       // \Mail::to('aduramimo@gmail.com','Dreywandowski')->send(new ExchangeRates($rates));


        // show exchange rates for today only
        if($rates != null)return view('/shopping-cart/rates', ['exchange' => $rates, 'show' => $cant, 'today' => $today]);

        // go back and pick yesterday's rates
      /*  else{
            $rates = Fx_rates::where('updated_at', '=', $yesterday)->orderBy('desc','desc')->get()->toArray();

            $today = date('Y-m-d');
            $today = date("jS F, Y", strtotime($today));

            // send the rates to my email
            $mailData = $rates;
            //\Mail::to('aduramimo@gmail.com','Dreywandowski')->send(new ExchangeRates($mailData));

            if($rates != null)return view('/shopping-cart/rates', ['exchange' => $rates, 'show' => $cant, 'today' => $today]);
        }
      */

    }
}
