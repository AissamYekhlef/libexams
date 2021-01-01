<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Files Permissions
        Permission::firstOrCreate(['name' => 'files.view']);
        Permission::firstOrCreate(['name' => 'files.edit']);
        Permission::firstOrCreate(['name' => 'files.delete']);
        Permission::firstOrCreate(['name' => 'files.upload']);
        Permission::firstOrCreate(['name' => 'files.export']);
        Permission::firstOrCreate(['name' => 'files.import']);
        Permission::firstOrCreate(['name' => 'files.*']);

        // Users Permissions
        Permission::firstOrCreate(['name' => 'users.view']);
        Permission::firstOrCreate(['name' => 'users.edit']);
        Permission::firstOrCreate(['name' => 'users.delete']);
        Permission::firstOrCreate(['name' => 'users.export']);
        Permission::firstOrCreate(['name' => 'users.import']);
        Permission::firstOrCreate(['name' => 'users.*']);
    }
}
