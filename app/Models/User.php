<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\product;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    protected $fillable = [
        'owner_id',
        'name',
        'email',
        'betting_rate',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'carts')
        ->withPivot(['id', 'quantity']);
    }
}
