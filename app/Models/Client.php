<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        "name",
        "lastname",
        "email",
        "password",
        "role",
        "account",
        "balance",
        "isActive"
    ];

    protected $hidden = [
        "password",
    ];

}
