<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateDelevirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Delivery',
            'email' => 'delivery@delivery.com',
            'role_name' => ['delivery'],
            'password' => bcrypt('password')
        ]);
        $role = Role::create(['name' => 'delivery', 'guard_name' => 'admin']);
        $permissions = Permission::query()
            ->where('name', 'delivery')
            ->orWhere('name', 'orders')
            ->orWhere('name', 'order show user')
            ->orWhere('name', 'order show product')
            ->pluck('id', 'id');
        $role->syncPermissions($permissions);
        $admin->assignRole([$role->id]);
    }
}
