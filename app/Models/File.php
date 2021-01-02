<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_drive_id',
        'confirmed',
        'created_by',
        'level_id',
        'description',
        'year',
        'language',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by', 'id');
    }

    public function getLink(){
        $host = $_SERVER['HTTP_HOST'];
        if ($host == 'localhost') {
            $link = 'http://localhost/public/libexams/files/read/' . $this->id;
        }else {
            $link = 'http://' . $host . '/files/read/' . $this->id;
        }

        return $link;
    }
}
