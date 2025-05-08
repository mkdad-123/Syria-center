<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compliants extends Model
{
    protected $table = 'compliants';

    public function customUser()
    {
        $this->belongsTo(CustomUser::class );
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
