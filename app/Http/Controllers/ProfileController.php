<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class ProfileController extends Controller
{
    //// dashboard for registered users
  public function dashboard () {

  return view('shopping-cart/dashboard', ['page' => 'My Dashboard']);

}


 //// dashboard for new users
  public function success () {

  return view('shopping-cart/success');

}


    //// edit profile
    public function edit () {

        return view('shopping-cart/edit-profile');

    }

    //// edit profile success
    public function update (Request $request) {
        // get post variables

        // get current user to be updated
        $profile = \Auth::user();

        $profile->name = $request->input('name');
        $profile->address1 = $request->input('address1');
        $profile->address2 = $request->input('address2');
        $profile->state = $request->input('state');
        $profile->country = $request->input('country');
        $profile->email = $request->input('email');
        $profile->phone = $request->input('phone');
        $profile->save();

      //return view('shopping-cart/update_details');
       return redirect()->back()->with('status', '  Profile updated successfully');

    }

// Show orders for the current user
public function orders()
{
    $profile = \Auth::user();
    $profile->user = $profile->name;
    $order = Orders::where('user' , '=', $profile->user)->get()->toArray();

    /*echo "<pre>" . "Rep2";
    print_r($order);
    echo "</pre>";
    foreach ($order as $item) {
        $day = $item['updated_at'];

        $fin_date = date('l jS \of F Y h:i:s A', strtotime($day));
        foreach ($item['items'] as $items) {
            //echo $items[0]['file'];
        }
    }*/
    return view('shopping-cart/orders' , ['order' => $order]);
}


// redirect remita
    public function redirectRemita(Request $request)
    {
        $RRR = $request->session()->get('remita_code');
        $transID = $request->session()->get('transactionID');

        return view('shopping-cart/remita_pay', ['RRR' => $RRR, 'transID' => $transID]);
    }


    /// handle paystack bills payment
     public function handlePaystk (Request $request)
     {
         // get current user to be updated
         $cust_email = $request->input('email');
         $amount = $request->input('amount');
         $cust_fname = $request->input('name');
         $cust_lname = '';
         $phone  = $request->input('phone');
         $pay_type = $request->input('pay_type');
         $rand = rand();

         // save pay_type to the session
         $request->session()->put('pay_type', $pay_type);
         $request->session()->put('transactionId', $rand);
         //print_r($request->session()->all());die;


         // handle flutterwave payment option
         if($pay_type == "FLUTTERWAVE"){

             $curl = curl_init();

             $customer_email =  $cust_email;
             $amount = $amount;
             $currency = "NGN";
             $txref = "rave-".$rand; // ensure you generate unique references per transaction.
             $PBFPubKey = "FLWPUBK_TEST-636b39c5d49113be7c6181fd168b7b22-X"; // get your public key from the dashboard.
             $redirect_url = "shopping-cart/thankyou_flutter";
             //$payment_plan = "pass the plan id"; // this is only required for recurring payments.


             curl_setopt_array($curl, array(
                 CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_CUSTOMREQUEST => "POST",
                 CURLOPT_SSL_VERIFYPEER => false,
                 CURLOPT_SSL_VERIFYHOST => false,
                 CURLOPT_POSTFIELDS => json_encode([
                     'amount'=>$amount,
                     'customer_email'=>$customer_email,
                     'currency'=>$currency,
                     'txref'=>$txref,
                     'PBFPubKey'=>$PBFPubKey,
                     'redirect_url'=>$redirect_url,
                     //'payment_plan'=>$payment_plan
                 ]),
                 CURLOPT_HTTPHEADER => [
                     "content-type: application/json",
                     "cache-control: no-cache"
                 ],
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             if($err){
                 // there was an error contacting the rave API
                 die('Curl returned error: ' . $err);
             }

             $transaction = json_decode($response, true);

             if(!$transaction['data'] && !$transaction['data']['link']){
                 // there was an error from the API
                 print_r('API returned error: ' . $transaction['message']);
             }

// uncomment out this line if you want to redirect the user to the payment page
//print_r($transaction['data']['link']);
             //echo "here";die;

// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
             header('Location: ' . $transaction['data']['link']);
             die;
         }



         // handle paystack payment option
         elseif ($pay_type == "PAYSTACK"){


             $url = "https://api.paystack.co/transaction/initialize";
             $fields = [
                 'email' => $cust_email,
                 'amount' => $amount * 100,
                 'callback_url' => 'http://127.0.0.1:8000/shopping-cart/thankyou',
                 'first_name' => $cust_fname,
                 'last_name' => $cust_lname,
             ];
             $fields_string = http_build_query($fields);

//open connection
             $ch = curl_init();

//set the url, number of POST vars, POST data
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                 "Authorization: Bearer sk_test_83908abce2264dc4533d99b55eec6035d18c1ba8",

                 "Cache-Control: no-cache",
             ));
//So that curl_exec returns the contents of the cURL; rather than echoing it
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute post
             $result = curl_exec($ch);
             $res = json_decode($result, true);
//dd($res);

             if ($res['status']) {

                 $url = $res['data']['authorization_url'];


                 $ref = $res['data']['reference'];

                 $request->session()->put('ref', $ref);

                 header("Location: $url");

// at this point, for some mysterious reasons which I'm not ready to know, the API doesn't
//bring up the payment modal unless I die it here. Thanks Paystack :(
                 die;

             }

         }

         // handle remita payment option
         elseif ($pay_type == "REMITA"){
             $cur_date = time() * 1000;
             $hash = hash('sha512', '2547916'.'4430731'.$cur_date.$amount.'1946');
             //echo 'hash == '.$hash;
             //die;
            $curl = curl_init();

             $post_data = array("serviceTypeId" =>"4430731",
                 "amount" =>$amount,
                 "orderId" => $cur_date,
                 "payerName" => $cust_fname,
                 "payerEmail" => $cust_email,
                 "payerPhone" =>$phone,
                 "description" =>
                     "Order Payment");
            // echo "<pre>";
             //print_r($post_data);
             //echo "</pre>";die;
             $post_data = json_encode($post_data);
             //echo "post_data == $post_data";die;

             curl_setopt_array($curl, array(
                 CURLOPT_URL => 'https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => '',
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 0,
                 CURLOPT_FOLLOWLOCATION => true,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => 'POST',
                 CURLOPT_SSL_VERIFYPEER => false,
                 CURLOPT_SSL_VERIFYHOST => false,
                 CURLOPT_POSTFIELDS =>$post_data,
                 CURLOPT_HTTPHEADER => array(
                     "Content-Type: application/json",
                     "Authorization: remitaConsumerKey=2547916,remitaConsumerToken=$hash"
                 ),
             ));

             $response = curl_exec($curl);

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

             $remita_code = $result['RRR'];
             $request->session()->put('remita_code', $remita_code);

             $logdate = date('Y-m-d');

             header("Location: http://127.0.0.1:8000/shopping-cart/remita_pay");

             //  curl_close($curl);
             //echo $response;


         }
     }


}
