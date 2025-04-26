<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = ['name', 'image', 'description'];
    
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
