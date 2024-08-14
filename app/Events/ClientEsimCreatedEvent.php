<?php

namespace App\Events;

use App\Models\Employes\PhoneNum;
use App\Models\Esims\ClientEsim;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ClientEsimCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $phonenum;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PhoneNum $phonenum)
    {
        //\Log::info("clientesim received ClientEsimCreatedEvent : " . json_encode( $phonenum ) );
        $this->phonenum = $phonenum;
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
