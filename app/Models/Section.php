<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    public $translatable = ['name','description'];

    protected $fillable = ['name', 'image', 'description'];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
