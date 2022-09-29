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
        //$this->redirect_url= 'http://idumota.tk/shopping-cart/api/thankyou';
        $this->redirect_url= 'http://idumota.dreywandowski.xyz/shopping-cart/api/thankyou';
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

            return response()->json(['message' => 'Payment Initialized', 'result' => $responseBody ], 200);
            //echo "in the handling method... $ref";
        }

    }

    public function verifyPaystack(Request $request)
    {
        // pass the reference gotten from the reference field in initialize payment endpoint
        $ref = $request->req;
        $api_key = config('app.paystack_key');
        $response = Http::withToken($api_key)
            ->get('https://api.paystack.co/transaction/verify/' . $ref,
                [
                    'verify' => false
                ]);

        $responseBody = json_decode($response->getBody());
        //print_r($responseBody);

        return response()->json(['message' => 'Payment Initialized and charging attempted', 'result' => $responseBody], 200);
    }

    public function flutterwave(Request $request)
    {
        // $api_key = env('FLW_SECRET_KEY');
        $redirect_url = "http://idumota.dreywandowski.xyz/shopping-cart/api/thankyou_flutter";
        $customer = ['email' => $request->email, 'phonenumber' => $request->phone, 'name' => $request->full_name];
        $api_key = config('app.flutterwave_key');
        $rand = rand();
        $txref = "rave-".$rand;

        $response = Http::withToken($api_key)
            ->post('https://api.flutterwave.com/v3/payments', [
                'amount'=>$request->amount,
                'customer'=>$customer,
                'currency'=>'NGN',
                'tx_ref'=>$txref,
                'redirect_url'=>$redirect_url,
            ],
                [
                    'verify' => false
                ]);

        $responseBody = json_decode($response->getBody(), true);

        if ($responseBody['data']) {

            $url = $responseBody['data']['link'];
            //$ref = $responseBody['data']['reference'];

            return response()->json(['message' => 'Payment Initialized', 'result' => $responseBody ], 200);
            //echo "in the handling method... $ref";
        }

    }

    public function verifyFlutterwave(Request $request)
    {
        // pass the reference gotten from the front-end url, the value from the transaction_id field
        $ref = $request->ref;
        $api_key = config('app.flutterwave_key');
        $response = Http::withToken($api_key)
            ->get('https://api.flutterwave.com/v3/transactions/'.$ref.'/verify',
                [
                    'verify' => false
                ]);

        $responseBody = json_decode($response->getBody());
        //print_r($responseBody);

        return response()->json(['message' => 'Charging attempted', 'result' => $responseBody], 200);
    }


    public function remita(Request $request)
    {
        $cur_date = time() * 1000;

        //$hash = hash('sha512', {{merchantId}}.{{serviceTypeID}}.{{orderID}}.{{amount}}.{{apikey}});

        $hash = hash('sha512', '2547916'.'4430731'.$cur_date. $request->amount.'1946');
        // handles remita payments
       // $this->redirect_url= 'http://idumota.tk/shopping-cart/api/thankyou';
        $this->redirect_url= 'http://idumota.dreywandowski.xyz/shopping-cart/api/thankyou';
       

        $api_key = "remitaConsumerKey=2547916,remitaConsumerToken=$hash";

        $response = Http::withHeaders([
            "Authorization: $api_key"
        ])
            ->post('https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit', [
                'amount'=>$request->amount,
                "serviceTypeId" =>"4430731",
                'payerName'=>$request->full_name,
                'payerEmail'=>$request->email,
                'payerPhone'=>$request->phone,
                'description'=>"Payment Made",
                "orderId" => $cur_date,
            ],
                [
                    'verify' => false
                ]);

        $response = json_decode($response->getBody(), false);
       /* echo "<pre>" . "Rep2";
       print_r($response);
       echo "</pre>"; die;
       */
        // function to decode jsonp to a php std object
        function jsonp_decode($response, $assoc = false) {
            if($response[0] !== '[' && $response[0] !== '{') { // we have JSONP
                $response = substr($response, strpos($response, '('));
            }
            return json_decode(trim($response,'();'), $assoc);
        }

        $data_new = jsonp_decode($response);

        // cast the std object to an array
        $result = json_decode(json_encode($data_new), true);
        /*echo "<pre>" . "Rep2";
        print_r($result);
        echo "</pre>"; die;*/

        $remita_code = $result['RRR'];


        if ($result['RRR']) {
            return response()->json(['message' => 'Payment Initialized', 'result' => $result ], 200);
        }

    }

    // redirect remita
    public function redirectRemita(Request $request, $remita_code)
    {
        //echo "hereee";die;
        $RRR = $remita_code;
        //$RRR = $request->session()->get('remita_code');
        $transID = $request->session()->get('transactionID');

        return view('shopping-cart/remita_pay', ['RRR' => $RRR, 'transID' => $transID]);
    }

}
