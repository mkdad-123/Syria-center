<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name','description'];

    protected $fillable = ['name', 'image', 'description'];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
