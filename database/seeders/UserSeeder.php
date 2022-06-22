<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            ['name' => "admin",'username' => "admin",'email' => "admin@gtesim.com",'password' => bcrypt('admin123'), 'status_id' => Status::active()->first()->id]);

        $adminrole = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $adminrole->syncPermissions($permissions);

        $user->assignRole([$adminrole->id]);

        

        $user1 = User::create(
            ['name' => "User 1",'username' => "user1",'email' => "user1@gtesim.com",'password' => bcrypt('user123'), 'status_id' => Status::active()->first()->id]);

        $editorrole = Role::create(['name' => 'Editor']);

        $permissions = Permission::pluck('id','id')->all();

        $editorrole->syncPermissions($permissions);

        $user1->assignRole([$editorrole->id]);
    }
}
