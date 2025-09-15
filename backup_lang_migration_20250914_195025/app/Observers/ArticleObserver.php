<?php
namespace App\Observers;

use App\Models\Service;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;


class ArticleObserver
{
    public function saved(Article $article)
    {
        $this->clearArticleCache($article->id);
        $this->clearServiceDetailsCache($article->service_id);
    }

    public function deleted(Article $article)
    {
        $this->clearArticleCache($article->id);
        $this->clearServiceDetailsCache($article->service_id);
    }

    public function updated(Article $article)
    {
        if ($article->isDirty('service_id')) {
            $this->clearArticleCache($article->id);
            $this->clearServiceDetailsCache($article->getOriginal('service_id'));
            $this->clearServiceDetailsCache($article->service_id);
        }
    }

    protected function clearArticleCache($articleId)
    {
        $locales = ['ar', 'en']; // اللغات المتاحة
        
        foreach ($locales as $locale) {
            $pattern = "article_{$articleId}_{$locale}_*";
            
            if (config('cache.default') === 'redis') {
                $keys = Cache::getRedis()->keys("*{$pattern}*");
                foreach ($keys as $key) {
                    Cache::forget(str_replace(config('cache.prefix'), '', $key));
                }
            } else {
                Cache::forget("article_{$articleId}_{$locale}");
            }
        }
    }
    function clearServiceDetailsCache($serviceId)
{
    $locales = ['ar', 'en']; // اللغات المتاحة
    
    foreach ($locales as $locale) {
        $pattern = "service_details_{$serviceId}_{$locale}_*";
        
        if (config('cache.default') === 'redis') {
            $keys = Cache::getRedis()->keys("*{$pattern}*");
            foreach ($keys as $key) {
                Cache::forget(str_replace(config('cache.prefix'), '', $key));
            }
        } else {
            Cache::forget("service_details_{$serviceId}_{$locale}");
        }
    }
}
}