<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->hasAnyRole('super-admin', 'admin') || $this->is_admin;
    }

    public function files(){
        return $this->hasMany(File::class, 'created_by', 'id');
    }

    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function adminlte_image()
    {
        if (Auth::user()->avatar == '') {
            return 'https://ui-avatars.com/api/?background=random&name=' . Auth::user()->name;
        }
        return  Auth::user()->avatar;
    }

    
    public function avatar()
    {
        return $this->adminlte_image();
    }

    public function adminlte_desc()
    {
        return 'That\'s a nice guy';
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }
}
