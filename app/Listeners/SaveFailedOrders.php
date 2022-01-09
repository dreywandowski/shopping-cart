<?php

namespace App\Listeners;

use App\Events\FailedOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Failed_Orders;
use Session;
use Illuminate\Http\Request;

class SaveFailedOrders
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FailedOrder  $event
     * @return void
     */
    public function handle(FailedOrder $event, Request $request)
    {
        $data = session('details');

        $failed = new Failed_Orders();
        $failed->customer_name = $request->session()->get('cust_fname');
        $failed->amount = $request->session()->get('amount');
        $failed->ref = $request->session()->get('trans_id');
        $failed->cust_email = $request->session()->get('transactionID');
        $failed->items = $data;
        $failed->pay_type = $request->session()->get('pay_type');
        $failed->save();

        $event->failed_order;
    }
}
