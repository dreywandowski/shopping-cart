<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResources;
use App\Models\Orders;
use App\Models\FailedOrders;

use Illuminate\Http\Request;

class ProfileControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOrders()
    {
        $profile = \Auth::user();
        $profile->user = $profile->name;
        $order = Orders::where('user' , '=', $profile->user)->get()->toArray();
    
        // bring the failed orders too and merge as part of the array to be returned
        $failed = FailedOrders::where('customer_name', '=', $profile->user)->get()->toArray();
    
       $order = array_merge($order, $failed);
       $order = Orders::where('user' , '=', $profile->user)->get()->toArray();

       // bring the failed orders too and merge as part of the array to be returned
       $failed = FailedOrders::where('customer_name', '=', $profile->user)->get()->toArray();

        $order = array_merge($order, $failed);
    
        return response()->json(['orders' => ShopResources::collection($order), 'message' => 'Orders Retrieved successfully'], 200);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
