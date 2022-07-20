<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HowTo\HowtoStepType;

class HowtoStepTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HowtoStepType::createNew("default","the default how to type")
            ->setDefault();
    }
}
