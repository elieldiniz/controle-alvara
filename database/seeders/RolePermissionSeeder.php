<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage-users', 'add-company', 'manage-alvaras',
            'create-alvara', 'edit-alvara', 'delete-alvara',
            'view-all-alvaras', 'export-pdf'
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }

        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super-admin']);
        
        $owner = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'owner']);
        $owner->syncPermissions(\Spatie\Permission\Models\Permission::all());

        $admin = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(['manage-users', 'add-company', 'manage-alvaras', 'create-alvara', 'edit-alvara', 'delete-alvara', 'view-all-alvaras']);

        $member = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'member']);
        $member->syncPermissions(['manage-alvaras', 'create-alvara', 'edit-alvara']);
    }
}
