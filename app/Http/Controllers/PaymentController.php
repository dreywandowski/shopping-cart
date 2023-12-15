<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;
use App\Models\Orders;

use Illuminate\Support\Facades\DB;
use Response;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function verify_paystack(Request $request){
        $reff = $request->reference;
        return view('shopping-cart/verify_paystack');
        die;
        $curl = curl_init();
        $url = config('app.paystack_verify') . $reff;
//echo "$url";
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".config('app.paystack_verify'),

                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $res = json_decode($result, true);

        if($res){
            echo "<pre>" . "Rep2";
            print_r($res);
            echo "</pre>";
        }


        $err = curl_error($curl);
        curl_close($curl);

// get current user to be updated
        /*$order = new Orders;
            $order->user = $request->input('user');
            $order->amount = $request->input('amount');
            $order->ref = $request->input('ref');
            $order->status = $request->input('status');
            $order->items = $request->input('items');
    */



        //return response()->json("order successfull.", 200);

    }
}
