<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['content' , 'service_id'];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
