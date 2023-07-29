<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateReceiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Receive',
            'email' => 'receive@receive.com',
            'role_name' => ['receive'],
            'password' => bcrypt('password')
        ]);
        $role = Role::create(['name' => 'receive', 'guard_name' => 'admin']);
        $permissions = Permission::query()
            ->where('name', 'receive')
            ->orWhere('name', 'orders')
            ->orWhere('name', 'order show vendor')
            ->orWhere('name', 'order show product')
            ->pluck('id', 'id');
        $role->syncPermissions($permissions);
        $admin->assignRole([$role->id]);
    }
}
