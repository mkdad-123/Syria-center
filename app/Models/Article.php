<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use HasTranslations;

    protected $table = 'articles';
    protected $fillable = ['content' , 'service_id' , 'title'];
    public $translatable = ['content' , 'title'];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
