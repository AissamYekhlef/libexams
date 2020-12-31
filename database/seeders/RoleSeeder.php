<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin_role = Role::firstOrCreate(['name' => 'super-admin']);
        $super_admin_role->givePermissionTo(Permission::all());

        $admin_role = Role::firstOrCreate(['name' => 'admin']);
        $permissions = Permission::where('name' , 'like' , 'files.%')->get();
        $admin_role->givePermissionTo($permissions);

        $editor_role = Role::firstOrCreate(['name' => 'editor']);
        $editor_role->givePermissionTo('files.view', 'files.edit');


        $viwer_role = Role::firstOrCreate(['name' => 'viewer']);
        $viwer_role->givePermissionTo('files.view');
    }
}
