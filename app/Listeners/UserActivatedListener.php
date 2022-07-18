<?php

namespace App\Listeners;

use App\Events\UserActivatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserActivatedListener
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
     * @param  \App\Events\UserActivatedEvent  $event
     * @return void
     */
    public function handle(UserActivatedEvent $event)
    {
        //\Log::info("event listened UserActivatedEvent : " . json_encode( $event ) );
        $event->user->sendMailAccountInfos();
    }
}
