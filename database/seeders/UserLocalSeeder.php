<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserLocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	$editorrole = Role::where('name', 'Editor')->first();

        $user1 = User::create(
            ['name' => "Hicham ENNOURE",'username' => "hicham",'email' => "H.ENNOURE@moov-africa.ga",'password' => bcrypt('hicham123'), 'status_id' => Status::active()->first()->id]);
	$user1->assignRole([$editorrole->id]);

	$user2 = User::create(
            ['name' => "Editeur 1",'username' => "editeur1",'email' => "editeur1@moov-africa.ga",'password' => bcrypt('editeur1123'), 'status_id' => Status::active()->first()->id]);
	$user2->assignRole([$editorrole->id]);

	$user3 = User::create(
            ['name' => "Editeur 2",'username' => "editeur2",'email' => "editeur2@moov-africa.ga",'password' => bcrypt('editeur2123'), 'status_id' => Status::active()->first()->id]);
        $user3->assignRole([$editorrole->id]);
    }
}
