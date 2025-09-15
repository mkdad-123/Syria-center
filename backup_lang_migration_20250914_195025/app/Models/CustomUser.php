<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomUser extends Authenticatable
{
    use HasFactory, HasApiTokens , Notifiable;
    use SoftDeletes;

    protected $table = 'customusers';
    protected $guard = 'custom'; // تحديد الـ guard المخصص

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function compliants()
    {
        return $this->hasMany(Compliants::class );
    }


    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
