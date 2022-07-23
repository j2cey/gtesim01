<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Howtos\HowTo;
use App\Models\Howtos\HowToType;

class HowToSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var HowtoStepType $howtosteptype_default */
        //$howtotype_default = HowToType::default()->first();
        //HowTo::createNew($howtosteptype_default,"Tout","tout","Tous les Trucs & Astuces","tout");
    }
}
