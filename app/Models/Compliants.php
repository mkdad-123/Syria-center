<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Compliants extends Model
{
    use HasApiTokens , Notifiable;

    protected $table = 'compliants';
    protected $fillable = ['content', 'email', 'date'];
}
