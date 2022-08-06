<?php

namespace App\Console\Commands\Employe;

use App\Models\User;
use Illuminate\Console\Command;
use App\Models\Employes\Employe;

class EmployeSetUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employe:setuser';

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
        $employes = Employe::whereNull('user_id')->get();

        foreach ($employes as $employe) {
            $user = User::where('objectguid', $employe->objectguid)->first();
            if ($user) {
                $employe->user()->associate($user)
                    ->save();
            }
        }

        return 0;
    }
}
