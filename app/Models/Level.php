<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public const LEVELS = [
        '0' => 'pre_primary',
        '1' => [
            '1ap',
            '2ap',
            '3ap',
            '4ap',
            '5ap',
        ],
        '2' => [
            '1am',
            '2am',
            '3am',
            '4am',
        ],
        '3' => [
            '1as',
            '2as',
            '3as',
        ],
        '4' => 'univercity',
    ];
}
