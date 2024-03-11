<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
   
    public function run(): void
    {
        DB::table('roles')->truncate();


        $permissions = Permission::all()->pluck('id')->toArray();

        $roles = [
            'admin',
            'orgonizer',
            'client',
            
        ];

        foreach ($roles as $roleName) {
            $role = Role::Create(['name' => $roleName]);
            $role->permissions()->sync($permissions);
        }
    }
}
