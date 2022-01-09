<?php

namespace App\Events;

use App\Request;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Failed_Orders;

class FailedOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $failed_order;
    public $request;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($failed_order, Request $request)
    {
        $this->failed_order = $failed_order;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
