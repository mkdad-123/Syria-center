<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomUser extends Authenticatable
{
    use HasApiTokens , Notifiable;

    protected $table = 'customusers';
    protected $guard = 'custom'; // تحديد الـ guard المخصص

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
