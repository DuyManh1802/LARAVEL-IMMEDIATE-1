<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'address',
        'phone',
        'role',
        'classroom_id'
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function classroom(){
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    public function scopeSearchEmail($query, $param)
    {
        return $query->where('email', 'LIKE', "%$param%");
    }

    public function scopeSearchName($query, $param)
    {
        return $query->where('name', 'LIKE', "%$param%");
    }

    public function scopeSearchAddress($query, $param)
    {
        return $query->where('address', 'LIKE', "%$param%");
    }

    public function scopeSearchPhone($query, $param)
    {
        return $query->where('phone', $param);
    }
}
