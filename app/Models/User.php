<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        "password",
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public static function serve(){
        return self::leftjoin("roles", "users.role_id", "roles.id")
            ->select("users.*", "roles.name as role")
            ->get();
    }
}
