<?php

namespace Modules\Users\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Items\Models\Item;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // The attributes that should be hidden for serialization
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Get the attributes that should be cast.
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
