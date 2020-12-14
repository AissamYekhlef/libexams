<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_drive_id',
        'confirmed',
        'created_by',
        'description',
        'year',
        'language',
    ];

    public function level(){
        return $this->belongTo(Level::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by', 'id');
    }
}
