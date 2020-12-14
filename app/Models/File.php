<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public $year;
    public $language;

    public function level(){
        return $this->belongTo(Level::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
