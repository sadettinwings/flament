<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list bugits']);
        Permission::create(['name' => 'view bugits']);
        Permission::create(['name' => 'create bugits']);
        Permission::create(['name' => 'update bugits']);
        Permission::create(['name' => 'delete bugits']);

        Permission::create(['name' => 'list alldestinations']);
        Permission::create(['name' => 'view alldestinations']);
        Permission::create(['name' => 'create alldestinations']);
        Permission::create(['name' => 'update alldestinations']);
        Permission::create(['name' => 'delete alldestinations']);

        Permission::create(['name' => 'list owners']);
        Permission::create(['name' => 'view owners']);
        Permission::create(['name' => 'create owners']);
        Permission::create(['name' => 'update owners']);
        Permission::create(['name' => 'delete owners']);

        Permission::create(['name' => 'list properties']);
        Permission::create(['name' => 'view properties']);
        Permission::create(['name' => 'create properties']);
        Permission::create(['name' => 'update properties']);
        Permission::create(['name' => 'delete properties']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
