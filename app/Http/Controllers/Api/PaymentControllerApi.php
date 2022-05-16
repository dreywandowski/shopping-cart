<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function paystack(Request $request)
    {
        // initializes paystack payments
        $this->redirect_url= 'http://idumota.tk/shopping-cart/thankyou';
        $api_key = config('app.paystack_key');

       /* echo "<pre>";
       print_r($request->all());
       echo "</pre>";*/

        $response = Http::withToken($api_key)
        ->post('https://api.paystack.co/transaction/initialize', [
            'amount'=>$request->amount * 100,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'callback_url'=>$this->redirect_url,
        ],
        [
            'verify' => false
        ]);

        $responseBody = json_decode($response->getBody(), true);

        if ($responseBody['status']) {

            $url = $responseBody['data']['authorization_url'];
            $ref = $responseBody['data']['reference'];

            //echo "in the handling method... $ref";
            // verifies paystack payments
            $api_key = config('app.paystack_key');

            $response = Http::withToken($api_key)
                ->get('https://api.paystack.co/transaction/verify/' . $ref,
                    [
                        'verify' => false
                    ]);

            $responseBody = json_decode($response->getBody());
            //print_r($responseBody);

            return response()->json(['message' => 'Payment Initialized and charging attempted', 'result' => $responseBody ], 200);
        }

    }


    public function flutterwave()
    {
        // handles flutterwave payments
    }
    public function remita()
    {
        // handles remita payments
    }


}
