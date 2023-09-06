<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            [
                'name' => 'add-users',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit-users',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete-users',
                'guard_name' => 'web',
            ],
            [
                'name' => 'view-users',
                'guard_name' => 'web',
            ],
            [
                'name' => 'add-roles',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit-roles',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete-roles',
                'guard_name' => 'web',
            ],
            [
                'name' => 'view-roles',
                'guard_name' => 'web',
            ],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

    }
}
