<?php

namespace App\Console\Commands;

use App\Http\Requests\ClientEsim\ClientEsimRequest;
use App\Models\Esims\ClientEsim;
use Illuminate\Console\Command;

class CorrectDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:correctdb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $clients = ClientEsim::whereNull('pin')->get();

        foreach ($clients as $client) {
            $previous_client = ClientEsim::where('nom_raison_sociale','LIKE', '%' . $client->nom_raison_sociale . '%')
                ->where('prenom', 'LIKE', '%' . $client->prenom . '%')
                ->where('pin', "0000")
                ->first();
            if ($previous_client) {
                $this->setClientAttrs($previous_client, $client->numero_telephone, $client->email, $client->esim_id);
                $client->delete();
            } else {
                $this->setClientAttrs($client, $client->numero_telephone, $client->email, $client->esim_id);
                $client->update([
                   'pin' => "0000",
                    'esim_id' => null,
                ]);
            }
        }

        return 0;
    }

    private function setClientAttrs($client, $phone, $email, $esim_id) {
        // creer l addresse email
        $client->addNewEmailAddress($email);
        // creer le phone num
        $client->addNewPhoneNum($phone,true, $esim_id);
    }
}
