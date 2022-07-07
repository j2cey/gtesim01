<?php

namespace App\Events;

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

    public $clientesim;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ClientEsim $clientesim)
    {
        \Log::info("clientesim received ClientEsimCreatedEvent : " . json_encode( $clientesim ) );
        $this->clientesim = $clientesim;
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
