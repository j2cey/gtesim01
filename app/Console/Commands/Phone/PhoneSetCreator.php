<?php

namespace App\Console\Commands\Phone;

use App\Models\User;
use Illuminate\Console\Command;
use App\Models\Employes\PhoneNum;
use OwenIt\Auditing\Models\Audit;

class PhoneSetCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phone:setcreator';

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
        $phonenumaudits = Audit::with('user')
            ->where('auditable_type',"App\Models\Employes\PhoneNum")
            ->where('event', "created")
            ->orderBy('created_at', 'desc')->get();

        foreach ($phonenumaudits as $audit) {
            $user = User::where('id', $audit->user_id)->first();
            $phonenum = PhoneNum::with('creator')->where('id', $audit->auditable_id)->first();

            if ( is_null($phonenum->created_by ) ) {
                $phonenum->creator()->associate($user)->save();
            }
        }

        return 0;
    }
}
