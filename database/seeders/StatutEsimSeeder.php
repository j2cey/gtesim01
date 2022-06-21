<?php

namespace Database\Seeders;

use App\Models\Esims\StatutEsim;
use Illuminate\Database\Seeder;

class StatutEsimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatutEsim::createNew("Nouveau", "nouveau", "nouveau")->setDefault();
        StatutEsim::createNew("Attribution", "attribution", "attribution");
        StatutEsim::createNew("Attribue", "attribue", "attribue");
    }
}
