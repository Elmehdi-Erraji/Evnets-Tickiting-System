<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('permissions')->truncate();

        $permissions = [
            [
                'name' => 'user_create',
            ],
            [
                'name' => 'user_delete',
            ],
            [
                'name' => 'user_update',
            ],
            [
                'name' => 'user_access',
            ],


            //profile 
            [
                'name' => 'profile_delete',
            ],
            [
                'name' => 'profile_access',
            ],
            [
                'name' => 'profile_create',
            ],
            [
                'name' => 'profile_update',
            ],


        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
