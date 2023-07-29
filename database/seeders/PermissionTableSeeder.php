<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'admins',
            'list admins',
            'create admins',
            'update admins',
            'delete admins',
            'roles',
            'create roles',
            'update roles',
            'delete roles',
            'vendors',
            'create vendor',
            'update vendor',
            'delete vendor',
            'users',
            'create user',
            'update user',
            'delete user',
            'orders',
            'order table',
            'receive',
            'delivery',
            'send requests receive',
            'send requests delivery',
            'order show user',
            'order show vendor',
            'order show product',
            'categories',
            'create category',
            'update category',
            'delete category',
            'slider',
            'create slider',
            'update slider',
            'delete slider',
            'setting',
            'update setting',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }
    }
}
