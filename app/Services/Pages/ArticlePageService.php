<?php

namespace App\Services\Pages;

use App\Models\Article;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;
use App\Services\Cache\CacheService;
use App\Services\Cache\CacheKeyService;

class ArticlePageService implements PageSectionService
{
    private CacheService $cache;
    private CacheKeyService $keys;

    public function __construct(
        private SettingReader $reader,
        ?CacheService $cache = null,
        ?CacheKeyService $keys = null
    ) {
        // fallback لو ما تم حقنهم
        $this->cache = $cache ?? app(CacheService::class);
        $this->keys  = $keys  ?? app(CacheKeyService::class);
    }

    public function render(string $locale, array $params = []): string
    {
        // لا نضبط اللغة هنا؛ الميدلوير مسؤول عنها
        $locale    = $locale ?: app()->getLocale();
        $articleId = (int)($params['article_id'] ?? 0);
        $force     = (bool)($params['refresh'] ?? false);

        abort_if($articleId <= 0, 404);

        // كاش للمقال الخام فقط (بدون لغة) — المفتاح عندك لا يتضمن اللغة
        $key = $this->keys->article($articleId);

        $article = $this->cache->remember(
            $key,
            now()->addHours(24),
            fn () => Article::with('service')->findOrFail($articleId),
            $force
        );

        // تطبيق الترجمة حسب $locale في كل طلب (خفيف بعد ما كاشّينا الموديل)
        $translatedArticle = [
            'id'         => $article->id,
            'title'      => $article->getTranslatedAttribute('title', $locale) ?? $article->title,
            'content'    => $article->getTranslatedContent($locale),
            'service_id' => $article->service_id,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at,
            'image'      => $article->image,
            'service'    => $article->service ? [
                'id'   => $article->service->id,
                'name' => $article->service->getTranslatedAttribute('name', $locale) ?? $article->service->name,
            ] : null,
        ];

        return view('article', [
            'article'     => $translatedArticle,
            'locale'      => $locale,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact(),
        ])->render();
    }
}
