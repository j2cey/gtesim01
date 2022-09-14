<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            ['role-list', 2],
            ['role-create', 1],
            ['role-edit', 1],
            ['role-delete', 1],

            ['statutesim-list', 4],
            ['statutesim-create', 3],
            ['statutesim-edit', 3],
            ['statutesim-delete', 3],

            ['technologieesim-list', 4],
            ['technologieesim-create', 3],
            ['technologieesim-edit', 3],
            ['technologieesim-delete', 3],

            ['clientesim-list', 4],
            ['clientesim-show', 4],
            ['clientesim-create', 3],
            ['clientesim-edit', 3],
            ['clientesim-delete', 3],
            ['clientesim-print', 4],
            ['clientesim-esim-attach', 3],
            ['clientesim-esim-dettach', 3],
            ['clientesim-addphone', 3],

            ['esim-list', 4],
            ['esim-show', 4],
            ['esim-create', 3],
            ['esim-edit', 3],
            ['esim-delete', 3],
            ['esim-attach', 3],
            ['esim-import', 3],

            ['esimqrcode-list', 4],
            ['esimqrcode-create', 3],
            ['esimqrcode-edit', 3],
            ['esimqrcode-delete', 3],

            ['howto-list', 4],
            ['howto-create', 3],
            ['howto-edit', 3],
            ['howto-delete', 3],
            ['howto-update-code', 1],
            ['howto-edithtml', 1],

            ['howtothread-list', 4],
            ['howtothread-create', 3],
            ['howtothread-edit', 3],
            ['howtothread-delete', 3],
            ['howtothread-update-code', 1],

            ['stats-list', 4],
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission[0], 'level' => $permission[1]]);
        }
    }
}
