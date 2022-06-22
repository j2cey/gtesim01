<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\Esims\ClientEsim;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class NotifyProfileEsim extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $client;
    public $qrcode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ClientEsim $client)
    {
        $this->client = $client;
        $this->subject = "Nouvelle e-sim cree";
        $this->qrcode = QrCode::size(100)->generate($client->esim->ac);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->markdown('emails.clientesims.profileesim');
    }
}
