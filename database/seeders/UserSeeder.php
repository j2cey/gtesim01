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
            ['name' => "admin",'username' => "admin",'email' => "admin@gtesim.com",'is_local' => 1,'password' => bcrypt('admin123'), 'status_id' => Status::active()->first()->id]);

        $adminrole = Role::where('name', 'Admin')->first();

        $permissions = Permission::pluck('id','id')->all();

        $adminrole->syncPermissions($permissions);

        $user->assignRole([$adminrole->id]);

        

        $user1 = User::create(
            ['name' => "User 1",'username' => "user1",'email' => "user1@gtesim.com",'is_local' => 1,'password' => bcrypt('user123'), 'status_id' => Status::active()->first()->id]);

        $editorrole = Role::where('name', 'Editor')->first();

        $editorrole->syncPermissions([
            'clientesim-list','clientesim-show','clientesim-create','clientesim-print',
            'esim-list','esim-show','esim-create','esim-attach'
        ]);

        $user1->assignRole([$editorrole->id]);
    }
}
