<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectPermissions = ['view_project',
        'view_any_project',
        'create_project',
        'update_project',
        'restore_project',
        'restore_any_project',
        'replicate_project',
        'reorder_project',
        'delete_project',
        'delete_any_project',
        'force_delete_project',
        'force_delete_any_project',];

    foreach ($projectPermissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    $adminPermissions = [
        'view_project',
        'view_any_project',
        'create_project',
        'update_project',
        'restore_project',
        'restore_any_project',
        'replicate_project',
        'reorder_project',
        'delete_project',
        'delete_any_project',
        'force_delete_project',
        'force_delete_any_project',
        'view_role',
        'view_any_role',
        'create_role',
        'update_role',
        'delete_role',
        'delete_any_role',
    ];

    foreach ($adminPermissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    // Create roles
    $adminRole = Role::firstOrCreate(['name' => \App\Enums\User\Role::SUPER_ADMIN]);
    $vendorRole = Role::firstOrCreate(['name' => \App\Enums\User\Role::ORGANIZATION]);
    $managerRole = Role::firstOrCreate(['name' => \App\Enums\User\Role::MANAGER]);

    $adminRole->syncPermissions(Permission::all());
    $vendorRole->syncPermissions($projectPermissions);


    $user = User::create([
        'name' => 'Admin',
        'email' => 'admin@ov.com',
        'password' => bcrypt('asdasdasd'),
    ]);

    $user->assignRole(\App\Enums\User\Role::SUPER_ADMIN);
    }
}
