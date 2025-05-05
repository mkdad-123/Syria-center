<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;

class Compliants extends Model
{
    use HasApiTokens , Notifiable , HasTranslations;

    protected $table = 'compliants';

    protected $fillable = ['custom_user_id','content', 'email', 'date'];

    public function customUser()
    {
        $this->belongsTo(CustomUser::class );
    }
}
