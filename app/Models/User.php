<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar', // Thêm avatar nếu có
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Quan hệ: 1 user có nhiều comment
    public function comments()
    {
        return $this->hasMany(ProductComment::class);
    }
}
