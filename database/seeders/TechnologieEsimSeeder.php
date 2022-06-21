<?php

namespace Database\Seeders;

use App\Models\Esims\TechnologieEsim;
use Illuminate\Database\Seeder;

class TechnologieEsimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TechnologieEsim::createNew("tech1", "tech1", "tech1")->setDefault();
        TechnologieEsim::createNew("tech2", "tech2", "tech2");
        TechnologieEsim::createNew("tech3", "tech3", "tech3");
    }
}
