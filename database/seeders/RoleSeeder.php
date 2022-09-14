<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$defaultrole = Role::create(['name' => 'Simple UserResource']);
        $adminrole = Role::create(['name' => 'Admin']);
	$editorrole = Role::create(['name' => 'Editor']);*/
	$editorrole = Role::create(['name' => 'AdminFunc']);
    }
}
