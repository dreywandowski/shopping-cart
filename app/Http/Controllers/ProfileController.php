<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use Illuminate\Http\Request;

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

    /// handle bills payment
    public function handle (Request $request) {
        // get post variables

        // get current user to be updated
        $order = new Orders;

        $order->user = $request->input('user');
        $order->amount = $request->input('amount');
        $order->ref = $request->input('ref');
        $order->status = $request->input('status');
        $order->items = $request->input('items');
        $order->save();

        //return view('shopping-cart/update_details');
        return response()->json("order successfull.", 200);

    }

}
