<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Items;
use Illuminate\Support\Facades\DB;
use Response;
use Session;
use App\Events\FailedOrder;

class ShopController extends Controller
{


    // this is for the home page of the app
    public function index()
    {

        $data = session('details');
        $cant;

        if ($data != null) {

            $cant = count($data);
        } else {
            $cant = ' ';
        }


        return view('shop', ['show' => $cant]);

    }

// this is for the main products catalogue
    public function shop(Request $request, $req)
    {
        $data = session('details');
        if ($data != null) {

            $cant = count($data);
        } else {
            $cant = ' ';
        }


        $man = Items::where('type', '=', 'man')->get()->toArray();
        $woman = Items::where('type', '=', 'woman')->get()->toArray();
        $child = Items::where('type', '=', 'child')->get()->toArray();
        $numMan = count($man);
        $numWoman = count($woman);
        $numChild = count($child);
        $womanAsc = DB::table('items')->select('name', 'type', 'price')->orderBy('name', 'ASC');


        if ($request->ajax()) {
            $initial = $request->input('initial');
            $final = $request->input('final');

            $items = Items::where('type', '=', $req)->whereBetween('price', [$initial, $final])->get()->toArray();

            //dd($items);
            //$returnHTML = view('shopping-cart/shop', ['page' => 'Shop /'. $req. 'collection', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => $req.' collection', 'items' => $items, 'show' => $cant])->render();
            //return response()->json(array('success' => true, 'html' =>$returnHTML));
        }

        else {

            switch ($req) {
                // only with type man
                case 'man':
                    $items = Items::where('type', '=', 'man')->simplePaginate(9);

                    return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / Men collection', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'Men collection', 'items' => $items, 'show' => $cant]);
                    break;


                // only with type woman
                case 'woman':
                    $items = Items::where('type', '=', 'woman')->simplePaginate(9);

                    return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / Women collection', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'Women collection', 'items' => $items, 'womanAsc' => $womanAsc, 'show' => $cant]);
                    break;

                // only with type child
                case 'child':
                    $items = Items::where('type', '=', 'child')->simplePaginate(9);


                    return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / Children collection', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'Children collection', 'items' => $items, 'show' => $cant]);
                    break;

                case 'all':
                    $items = Items::simplePaginate(9);
                    return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / All categories', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);

                    break;

                case 'A':
                    $items = Items::orderBy('name', 'ASC')->simplePaginate(9);
                    return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / A-Z', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);

                    break;

                case 'Z':
                    $items = Items::orderBy('name', 'DESC')->simplePaginate(9);
                    return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / Z-A', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);

                    break;

                case 'low':
                    $items = Items::orderBy('price', 'ASC')->simplePaginate(9);
                    return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / Price: Low to High', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);

                    break;

                case 'high':
                    $items = Items::orderBy('price', 'DESC')->simplePaginate(9);
                    return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / Price: High to Low', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);

                    break;

                default:

            }
        }
    }

    // after applying price range
    public function apply(Request $request){
        $data = session('details');
        if ($data != null) {

            $cant = count($data);
        } else {
            $cant = ' ';
        }

        $man = Items::where('type', '=', 'man')->get()->toArray();
        $woman = Items::where('type', '=', 'woman')->get()->toArray();
        $child = Items::where('type', '=', 'child')->get()->toArray();
        $numMan = count($man);
        $numWoman = count($woman);
        $numChild = count($child);


            $initial = $request->input('first');
            $final = $request->input('second');
            $req =   $request->input('req');
            $req = strtoupper($req);

        if($req =="all"){
            $items = Items::simplePaginate(9);
            return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / All categories', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);
              }
        elseif($req =="A") {
            $items = Items::orderBy('name', 'ASC')->simplePaginate(9);
            return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / A-Z', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);
        }
        elseif($req =="Z") {
            $items = Items::orderBy('name', 'DESC')->simplePaginate(9);
            return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / Z-A', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);
        }
        elseif($req =="low") {
            $items = Items::orderBy('price', 'ASC')->simplePaginate(9);
            return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / Price: Low to High', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);
        }
        elseif($req =="high"){
        $items = Items::orderBy('price', 'DESC')->simplePaginate(9);
        return view('shopping-cart/shop', ['req' => $req, 'page' => 'Shop / Price: High to Low', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);
    }
        else{
            $items = Items::where('type', '=', $req)->whereBetween('price', [$initial, $final])->simplePaginate(9);
        }


       /* echo "<pre>" . "heeeere ";
        print_r($items);
        echo "</pre>";die;*/
                return view('shopping-cart/shop', ['req' => $req,'page' => 'Shop /'.' '. $req.' '. 'collection / Prices from NGN'.$initial.' '.' to NGN'.$final, 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => $req.' collection', 'items' => $items, 'show' => $cant]);


/*
            // only with type woman
            case 'woman':
                $items = Items::where('type', '=', 'woman')->simplePaginate(9);

                return view('shopping-cart/shop', ['page' => 'Shop / Women collection', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'Women collection', 'items' => $items, 'womanAsc' => $womanAsc, 'show' => $cant]);
                break;

            // only with type child
            case 'child':
                $items = Items::where('type', '=', 'child')->simplePaginate(9);


                return view('shopping-cart/shop', ['page' => 'Shop / Children collection', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'Children collection', 'items' => $items, 'show' => $cant]);
                break;
*/
        switch ($req){
            case 'all':
                $items = Items::simplePaginate(9);
                return view('shopping-cart/shop', ['page' => 'Shop / All categories', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);

                break;

            case 'A':
                $items = Items::orderBy('name', 'ASC')->simplePaginate(9);
                return view('shopping-cart/shop', ['page' => 'Shop / A-Z', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);

                break;

            case 'Z':
                $items = Items::orderBy('name', 'DESC')->simplePaginate(9);
                return view('shopping-cart/shop', ['page' => 'Shop / Z-A', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);

                break;

            case 'low':
                $items = Items::orderBy('price', 'ASC')->simplePaginate(9);
                return view('shopping-cart/shop', ['page' => 'Shop / Price: Low to High', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);

                break;

            case 'high':
                $items = Items::orderBy('price', 'DESC')->simplePaginate(9);
                return view('shopping-cart/shop', ['page' => 'Shop / Price: High to Low', 'man' => $numMan, 'woman' => $numWoman, 'child' => $numChild, 'title' => 'All categories', 'items' => $items, 'show' => $cant]);

                break;

            default:

        }
        }


// this is for the contact us page
    public function contact()
    {
        $data = session('details');
        $cant;
        $cant;

        if ($data != null) {

            $cant = count($data);
        } else {
            $cant = ' ';
        }

        return view('shopping-cart/contact', ['page' => 'Contact', 'show' => $cant]);

    }


// this returns the cart for us
    public function cart(Request $request)
    {
        $data = session('details');
        $cant;
        $finPrice = array();

        if ($data != null) {
            $cant = count($data);
        } else {
            $cant = ' ';
        }

        return view('shopping-cart/cart', ['page' => 'Cart', 'show' => $cant, 'data' => $data, 'price']);

    }


// this deletes cart items
    public function delete(Request $request, $req)
    {
        $cant;


        $name = $req;
        $data = session('details');

        //dd($data);
        if ($data != null) {

            $cant = count($data);

            $reqIndex = "";

            foreach ($data as $key => $value) {
                    if ($name == $value[0]['name']) {
                       // echo $value['name'] . "<br>";
                        $reqIndex = $key;
                       //$curr_key = array_search($name, $item);
                       //echo "current key==".$reqIndex;
                        $reqIndex = strval($reqIndex);
                       /*var_dump($reqIndex);
                        echo 'I want to delete the array that has this value in name: ' . ' ' . $name . ' this is the array of the item to be deleted.' . '<br>';
                        print_r($value);
                        echo "<pre>" . "this is the entire session from which I want to remove the session ";
                        print_r($data);
                        echo "</pre>";*/

                        $del = $request->session()->forget('details.'.$reqIndex);
                        if ($del) {
                                                    }
                                                     else {
                              //Session::flash('message', 'Error deleting the item');
                            //Session::flash('alert-class', 'alert-warning');

                        }

                    } else {

                    }
                             Session::flash('message', $req . ' ' . '  item has been deleted from the cart successfully, please refresh the page as your cart is now empty');
                             Session::flash('alert-class', 'alert-success');

            }
        } else {
            $cant = ' ';

 }

        /**foreach($data as $row) {
         * foreach($row as $item){
         *
         * }
         * }**/

        /**
         **/

         foreach ($data as $key => $value) {
                    if ($name != $value[0]['name']) {
                            Session::flash('message', $req . ' ' . '  item has been deleted from the cart successfully');
                            Session::flash('alert-class', 'alert-success');

                    }
                }

return view('shopping-cart/cart', ['page' => 'Cart', 'show' => $cant, 'data' => $data]);
       // return redirect()->back()->with('status', $req . ' ' . '  item has been deleted from the cart successfully');

    }


// this returns a single item to be added to the cart
    public function single(Request $request, $req)
    {
        $items = Items::where('name', '=', $req)->get();
        $data = session('details');
        $cant;

        if ($data != null) {

            $cant = count($data);
        } else {
            $cant = ' ';
        }


        if ($request->ajax()) {
            // we want to return ajax details

            $name = $request->input('name');
            $type = $request->input('type');
            $price = $request->input('price');
            $file = $request->input('file');
            $number = $request->input('number');
            $count = $request->input('count');
            $priceFin = $request->input('priceFin');
            $cust = \Auth::user();
            $cust_name = $cust->name;
            $cust_mail = $cust->email;

            $values = compact('name', 'type', 'price', 'file', 'number', 'count', 'priceFin','cust_name','cust_mail');

            //remove a session item
            //$request->session()->pull('cart_no', 'aduramimo');

            // add session items

            $sessionValues[] = $values;


            $request->session()->push('details', $sessionValues);

            return response()->json($number . ' ' . "items added to cart successfully", 200);
        } else {


            return view('shopping-cart/shop-single', ['page' => 'Cart / My product', 'items' => $items, 'show' => $cant]);
        }

    }

// checkout page -- unlogged
    public function checkout()
    {
        $data = session('details');
        $cant;

        if ($data != null) {

            $cant = count($data);
        } else {
            $cant = ' ';
        }


        return view('shopping-cart/checkout', ['page' => 'Checkout', 'show' => $cant, 'data' => $data]);

    }

// checkout page -- logged in
    public function checkout_logged()
    {
        $data = session('details');
        $cant;

        if ($data != null) {

            $cant = count($data);
        } else {
            $cant = ' ';
        }


        return view('shopping-cart/checkout_logged', ['page' => 'Checkout', 'show' => $cant, 'data' => $data]);

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


// thank you page after sucessful order and payment
    public function thanks(Request $request)
    {
        $data = session('details');
        $cant;

        if ($data != null) {

            $cant = count($data);
        } else {
            $cant = ' ';
        }


// verify paystack payment
        //print_r($request->session()->all());die;

            $pay_type = $request->session()->get('pay_type');
            $reff = $request->reference;

        $request->session()->put('trans_id', $reff);

            //api key
        $api_key = config('app.paystack_key');

            $curl = curl_init();
            $url = "https://api.paystack.co/transaction/verify/" . $reff;
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
                    "Authorization: Bearer $api_key",

                    "Cache-Control: no-cache",
                ),
            ));

            $response = curl_exec($curl);
            $res = json_decode($response, true);
       /* echo "<pre>";
        print_r($res);
        echo "</pre>";
        die;*/

            if ($res) {
                $ref = $res['data']['reference'];
                if ($res['status'] == 1 && $res['data']['status'] == 'success'){
                    // get current user to be updated
                    $profile = \Auth::user();

                $order = new Orders;
                $order->user = $profile->name;
                $order->amount = $res['data']['amount'] / 100;
                $order->ref = $res['data']['reference'];
                $order->status = $res['data']['gateway_response'];
                //$order->log_time = date('d-m-Y H:i:s', strtotime($res['data']['paid_at']));
                $order->channel = $res['data']['channel'];
                $order->items = $data;
                $order->pay_type = "PAYSTACK";
                $order->save();


                if ($order->save()) $page = 'ok';
                else $page = 'pending';

                // reset cart to zero
                $cant = $request->session()->forget('details');

                //return response()->json("order successfull.", 200);
                /*echo "<pre>" . "Rep2";
                print_r($res);
                echo "</pre>";*/
            }
            } else {
                $res['status'] = 'error';
                // fire a new event listener that stores every failed order to the database
                event(new FailedOrder($res['status']));

                $page = 'fail';
                $cant = $request->session()->forget('details');
                /*$err = curl_error($curl);
                 // reset cart to zero

                curl_close($curl);*/
            }
        return view('shopping-cart/thankyou', ['page' => $page, 'msg' => 'Order verification page', 'show' => $cant, 'pay' => $page, 'ref' => $ref]);
        }

    public function thanksRemita(Request $request, $remita){
        $data = session('details');
        $cant;

        if ($data != null) {

            $cant = count($data);
        } else {
            $cant = ' ';
        }

            $RRR = $remita;
//echo "RRR==".$RRR;
         $hash = hash('sha512', $RRR.'1946'.'2547916');
//echo "hash== ".$hash;
        // https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/{{merchantId}}/{{rrr}}/{{apiHash}}/status.reg
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/2547916/'.$RRR.'/'.$hash.'/status.reg',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: remitaConsumerKey=2547916,remitaConsumerToken=$hash'
                ),
            ));

            $response = curl_exec($curl);
           // if($response)echo "yeahh";
            //else echo "nope";

            $verifyPay = json_decode($response, true);
           // echo "<pre>".'Response';
            //print_r($verifyPay);
            //echo "</pre>";die;

           $responsecode = $verifyPay['status'];
            if($responsecode == '00'){
                // get current user to be updated
                $profile = \Auth::user();

                $order = new Orders;
                $order->user = $profile->name;
                $order->amount = $verifyPay['amount'];
                $order->ref = $verifyPay['RRR'];
                $order->status = $verifyPay['message'];
                //$order->log_time = date('d-m-Y H:i:s', strtotime($verifyPay['paymentDate']));
                $order->channel = "card";
                $order->items = $data;
                $order->pay_type = "REMITA";
                $order->save();


                if ($order->save()) $page = 'ok';
                else $page = 'pending';

                // reset cart to zero
                $cant =  $request->session()->forget('details');
                //return response()->json("order successfull.", 200);
                /*echo "<pre>" . "Rep2";
                print_r($res);
                echo "</pre>";*/
            }

            else{
                $page = 'fail';
            }

//curl_close($curl);
//echo $response;


        return view('shopping-cart/thankyou', ['page' => $page, 'msg' => 'Order verification page', 'show' => $cant, 'pay' => $page, 'ref' => $order->ref]);
    }

    public function thankFlutter(Request $request)
    {
        $data = session('details');
        $cant;

        if ($data != null) {

            $cant = count($data);
        } else {
            $cant = ' ';
        }

        //api key
        $api_key = config('app.flutterwave_key');
        $ref = $_GET['transaction_id'];
//echo $_GET['transaction_id'].''.$_GET['tx_ref'];
//print_r($data);
       // so that the event listener will have access to the transaction ID
        $request->session()->put('trans_id', $_GET['transaction_id']);
        $request->session()->put('pay_type', 'FLUTTERWAVE');
        //print_r($request->session()->all());die;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/".$ref."/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $api_key"
            ),
        ));

        $response = curl_exec($curl);
        $res = json_decode($response, true);

        if ($res['status'] == "error") {
            // fire a new event listener that stores every failed order to the database
            event(new FailedOrder($res['status']));

            // reset cart to zero
            $cant = $request->session()->forget('details');

            $page = 'fail';
            /*$err = curl_error($curl);
            curl_close($curl);*/
            return view('shopping-cart/thankyou', ['page' => $page, 'msg' => 'Order verification page', 'show' => $cant, 'pay' => $page, 'ref' => $_GET['transaction_id']]);

        } else {
            $ref = $res['data']['id'];
            if ($res) {
                // get current user to be updated
                $profile = \Auth::user();

                $order = new Orders;
                $order->user = $profile->name;
                $order->amount = $res['data']['amount'];
                $order->ref = $res['data']['id'];
                $order->status = $res['data']['status'];
                //$order->log_time = date('d-m-Y H:i:s', strtotime($res['data']['paid_at']));
                $order->channel = $res['data']['payment_type'];
                $order->items = $data;
                $order->pay_type = "FLUTTERWAVE";
                $order->save();


                if ($order->save()) $page = 'ok';
                else $page = 'pending';

                // reset cart to zero
                $cant = $request->session()->forget('details');

                //return response()->json("order successfull.", 200);
                /*echo "<pre>" . "Rep2";
                print_r($res);
                echo "</pre>";*/
            } else $page = 'fail';
            /*$err = curl_error($curl);
            curl_close($curl);*/
            return view('shopping-cart/thankyou', ['page' => $page, 'msg' => 'Order verification page', 'show' => $cant, 'pay' => $page, 'ref' => $ref]);

        }
    }

    public function admin(Request $request){
        return view('shopping-cart/admin', ['show' => '', 'page' => '']);
    }


}
