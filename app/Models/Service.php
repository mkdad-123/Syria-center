<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Service extends Model
{
    protected $fillable = [
        'name' ,
        'description' ,
        'section_id'
    ];
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function article(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
