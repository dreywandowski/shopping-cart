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
use App\Models\FailedOrders;

class FailedOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $failed;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($failed)
    {

        $this->failed = $failed;
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
