<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compliants extends Model
{
    protected $table = 'compliants';

    public function customUser()
    {
        return $this->belongsTo(CustomUser::class ,'custom_user_id' );
    }
    protected $fillable = [
        'custom_user_id',
        'content',
        'email',
        'date'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
