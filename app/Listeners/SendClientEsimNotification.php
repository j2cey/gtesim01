<?php

namespace App\Listeners;

use App\Events\ClientEsimCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendClientEsimNotification
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
     * @param  \App\Events\ClientEsimCreatedEvent  $event
     * @return void
     */
    public function handle(ClientEsimCreatedEvent $event)
    {
        //\Log::info("event received SendClientEsimNotification : " . json_encode( $event ) );
        $client = $event->phonenum->hasphonenum;
        $client->sendmailprofile($event->phonenum);
    }
}
