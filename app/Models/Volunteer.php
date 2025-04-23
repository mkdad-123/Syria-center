<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'national_id',
        'birth_date',
        'gender',
        'profession',
        'skills',
        'availability',
        'join_date',
        'is_active',
        'profile_photo',
        'CV',
        'notes'
    ];

}
