<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\UserResource::factory(10)->create();
        $this->call(SettingSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(TypeDepartementSeeder::class);

        $this->call(StatutEsimSeeder::class);
        $this->call(TechnologieEsimSeeder::class);
        $this->call(ImportModelFieldTypeSeeder::class);

        $this->call(HowtoStepTypeSeeder::class);
        $this->call(HowtoStepSeeder::class);
    }
}
