<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ItemSelected implements ShouldBroadcast
{
    /**
     * Information about the item selected update.
     *
     * @var string
     */
    public $update;

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\PrivateChannel
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('order.'.$this->update->order_id);
        // Very fake channel name.
        // Relevant broadcast rules take into account that this will actually be public
        return new PrivateChannel('item.selected');
        
    }

}