<?php

namespace App\Events;

use IlluminateQueueSerializesModels;
use IlluminateFoundationEventsDispatchable;
use IlluminateBroadcastingInteractsWithSockets;
use IlluminateContractsBroadcastingShouldBroadcast;

class MyEvent implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $message;

  public function __construct($message)
  {
      $this->message = $message;
  }

  public function broadcastOn()
  {
      return ['my-channel'];
  }

  public function broadcastAs()
  {
      return 'my-event';
  }
}