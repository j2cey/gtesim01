<?php

namespace App\Console\Commands\Esim;

use App\Models\Esims\Esim;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Models\Esims\StatutEsim;

class EsimSetAttributor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'esim:setattributor';

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
        $statutesim_attribue = StatutEsim::attribue()->first();
        $esims = Esim::with(['phonenum','phonenum.creator'])
            ->doesntHave('attributor')
            ->whereHas('phonenum')
            ->whereHas('statutesim', function ($query) use ($statutesim_attribue) {
                $query->where('id', $statutesim_attribue->id);
            })
            ->get();

        foreach ($esims as $esim) {
            if ($esim->phonenum) {
                $user = $esim->phonenum->creator;
                $attribution_date = new Carbon($esim->phonenum->created_at);//Carbon::createFromFormat("Y-m-d h:i",$esim->phonenum->created_at);
                $esim->setAttributor($user, $attribution_date)->save();
            }
        }

        return 0;
    }
}
