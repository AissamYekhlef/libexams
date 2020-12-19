<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    public $timestemp = false;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function files(){
        return $this->hasMany(File::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

}
