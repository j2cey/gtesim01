<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Howtos\HowtoStep;
use App\Models\Howtos\HowtoStepType;

class HowtoStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var HowtoStepType $howtosteptype_default */
        $howtosteptype_default = HowtoStepType::default()->first();
        HowtoStep::createNew($howtosteptype_default,"Tout","tout","Tous les Trucs & Astuces","tout");
    }
}
