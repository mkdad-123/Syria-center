<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    public $timestamps = false; // تعطيل الطوابع الزمنية
    protected $table = 'password_reset_code' ;
    protected $fillable = [
        'email',
        'code',
        'expires_at',
        'reset_token',
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];}
