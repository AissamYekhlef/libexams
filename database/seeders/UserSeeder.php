<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! User::where( ['email' => 'super@admin.com'])->count() > 0){
            $super_admin = User::factory()->create([
                'name' => 'Super Admin',
                'email' => 'super@admin.com', // as Admin
                'is_admin' => true,
            ]);
            $super_admin->assignRole('super-admin');
        }

        if (! User::where( ['email' => 'admin@admin.com'])->count() > 0){
            $admin = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com', // as User
            ]);
            $admin->assignRole('admin');
        }

        if (! User::where( ['email' => 'editor@gmail.com'])->count() > 0){
            $editor = User::factory()->create([
                'name' => 'Editor',
                'email' => 'editor@gmail.com', // as Editor
            ]);
            $editor->assignRole('editor');
        }
        
        if (! User::where( ['email' => 'viewer@gmail.com'])->count() > 0){
            $editor = User::factory()->create([
                'name' => 'Viewer',
                'email' => 'viewer@gmail.com', // as Viewer
            ]);
            $editor->assignRole('viewer');
        }
        
        // User::factory()
        //         ->count(10)
        //         ->create();
    }
}
