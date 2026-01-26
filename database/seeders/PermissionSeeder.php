<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Post permissions
        $permissions = [
            'posts.view',
            'posts.create',
            'posts.edit',
            'posts.delete',

            // Media library
            'media.view',
            'media.delete',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Roles
        $admin  = Role::firstOrCreate(['name' => 'admin']);
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $author = Role::firstOrCreate(['name' => 'author']);

        // Admin: all permissions
        $admin->syncPermissions($permissions);

        // Editor: can manage posts and view media, but not delete media (optional)
        $editor->syncPermissions([
            'posts.view', 'posts.create', 'posts.edit', 'posts.delete',
            'media.view',
        ]);

        // Author: can only view and create (cannot delete or edit others)
        $author->syncPermissions([
            'posts.view', 'posts.create',
        ]);
    }
}
