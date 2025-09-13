<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\ShowController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;

class Partner extends Model
{
    use HasApiTokens , Notifiable;
    use HasTranslations , HasFactory;

    protected $table = 'partners';
    public $translatable = ['name','description'];

    protected $fillable = ['name', 'image', 'description'];

    public function getTranslatedContent($locale, $default = null)
    {
        try {
            return $this->getTranslation('content', $locale, false)
                   ?? $this->content
                   ?? $default
                   ?? __('No content available');
        } catch (\Exception $e) {
            return $this->content ?? $default ?? __('No content available');
        }
    }

}
