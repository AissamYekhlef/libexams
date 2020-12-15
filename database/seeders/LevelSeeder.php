<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // table of the necesary Levels
    const LEVELS = [
        // Primary
        [
            'id' => '10',
            'name' => '0ap',
        ],
        [
            'id' => '11',
            'name' => '1ap',
        ],
        [
            'id' => '12',
            'name' => '2ap',
        ],
        [
            'id' => '13',
            'name' => '3ap',
        ],
        [
            'id' => '14',
            'name' => '4ap',
        ],
        [
            'id' => '15',
            'name' => '5ap',
        ],
        [
            'id' => '19',
            'name' => 'bep',
        ],
        // seconday
        [
            'id' => '21',
            'name' => '1am',
        ],
        [
            'id' => '22',
            'name' => '2am',
        ],
        [
            'id' => '23',
            'name' => '3am',
        ],
        [
            'id' => '24',
            'name' => '4am',
        ],
        [
            'id' => '29',
            'name' => 'bem',
        ],
        // Lucy
        [
            'id' => '31',
            'name' => '1as',
        ],
        [
            'id' => '32',
            'name' => '2as',
        ],
        [
            'id' => '33',
            'name' => '3as',
        ],
        [
            'id' => '39',
            'name' => 'bac',
        ]
    ];

    public function run()
    {
        Level::insert(
            LevelSeeder::LEVELS
        );
    }
}
