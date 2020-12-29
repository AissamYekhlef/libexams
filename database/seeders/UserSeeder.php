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
        if (! User::where( ['email' => 'admin@admin.com'])->count() > 0){
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com', // as Admin
                'is_admin' => true,
            ]);
        }
        if (! User::where( ['email' => 'aissam@swissdidata.com'])->count() > 0){
            User::factory()->create([
                'name' => 'Aissam',
                'email' => 'aissam@swissdidata.com', // as User
            ]);
        }
        
        // User::factory()
        //         ->count(10)
        //         ->create();
    }
}
