<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::findOrCreate('edit articles');
        Permission::findOrCreate('delete articles');
        Permission::findOrCreate('publish articles');
        Permission::findOrCreate('unpublish articles');

        // Create roles and assign created permissions
        $role = Role::findOrCreate('writer');
        $role->givePermissionTo('edit articles');

        $role = Role::findOrCreate('moderator');
        $role->givePermissionTo(['publish articles', 'unpublish articles']);

        $role = Role::findOrCreate('super-admin');
        $role->givePermissionTo(Permission::all());
    }
}
