<?php

namespace App\Jobs;

use App\Models\Employes\PhoneNum;
use Illuminate\Bus\Queueable;
use App\Models\Esims\ClientEsim;
use App\Events\ClientEsimCreatedEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ClientEsimSendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $phonenum;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PhoneNum $phonenum)
    {
        $this->phonenum = $phonenum;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$this->clientesim->sendmailprofile();
        event( new ClientEsimCreatedEvent( $this->phonenum ));
    }
}
