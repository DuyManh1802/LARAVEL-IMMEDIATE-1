<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\HttpFoundation\Request;

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

    public function scopeSearchEmail($query, Request $request)
    {
        if (isset($request->email)){
            $query->where('email', 'LIKE', "%$request->email%");
        }

        return $query;
    }

    public function scopeSearchName($query, Request $request)
    {
        if (isset($request->name)){
            $query->where('name', 'LIKE', "%$request->name%");
        }

        return $query;
    }

    public function scopeSearchAddress($query, Request $request)
    {
        if (isset($request->address)){
            $query->where('address', 'LIKE', "%$request->address%");
        }

        return $query;
    }

    public function scopeSearchPhone($query, Request $request)
    {
        if (isset($request->phone)){
            $query->where('phone', $request->phone);
        }

        return $query;
    }
}