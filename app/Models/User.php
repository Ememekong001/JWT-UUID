<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'age',
        'address',
        'phone',
        'password',
        // 'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts =
    [
        'email_verified_at' => 'datetime',
    ];
   public function getJWTIdentifier()
   {
       return $this ->getKey();
   }
   public function getJWTCustomClaims()
   {
    return[
        'email' => $this->email,
        'name' => $this->name,
        'user_id' => $this->user_id,
        'age' => $this->age,
        'phone' => $this->phone,
        'address' => $this->address,
        'joined_since'=> $this->created_at->toIso8601String()
    ];

    }
    protected $primaryKey = "user_id";


}
