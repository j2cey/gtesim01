<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Howtos\HowToType;

class HowToTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HowToType::createNew("default","the default how to type")
            ->setDefault();
    }
}
