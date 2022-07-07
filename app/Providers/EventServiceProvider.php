<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use App\Events\ClientEsimCreatedEvent;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendClientEsimNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ClientEsimCreatedEvent::class => [
            SendClientEsimNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
