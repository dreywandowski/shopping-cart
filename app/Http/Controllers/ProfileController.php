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



    /// handle paystack bills payment
     public function handlePaystk (Request $request)
     {



         // get current user to be updated
         $cust_email = $request->input('email');
         $amount = $request->input('amount');
         $cust_fname = $request->input('name');
         $cust_lname = '';

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

die;

         }
     }


}
