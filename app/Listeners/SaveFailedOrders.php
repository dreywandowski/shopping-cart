<?php

namespace App\Listeners;

use App\Events\FailedOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\FailedOrders;
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
    public function handle($event)
    {
        $data = session('details');
        foreach ($data as $dat) {
            foreach ($dat as $dt) {
               /* echo "<pre>";
                print_r($dt);
                echo "</pre>";*/
                if($event->failed){
                    $failed_order = new FailedOrders();
                    $failed_order->customer_name = $dt['cust_name'];
                    $failed_order->amount = $dt['priceFin'];
                    $failed_order->ref = session('trans_id');
                    $failed_order->cust_email = $dt['cust_mail'];
                    $failed_order->items = $data;
                    $failed_order->pay_type = session('pay_type');
                    $failed_order->save();
                }
            }
        }
//die;



        //$event->failed_order;
    }
}
