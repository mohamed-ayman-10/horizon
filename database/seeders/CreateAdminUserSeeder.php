<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role_name' => ['admin'],
            'password' => bcrypt('password')
        ]);
        $role = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $permissions = Permission::query()->where('name', '!=','receive')->where('name', '!=','delivery')->pluck('id', 'id');
        $role->syncPermissions($permissions);
        $admin->assignRole([$role->id]);
    }
}
