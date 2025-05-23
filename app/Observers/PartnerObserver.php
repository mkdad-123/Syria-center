<?php

namespace App\Observers;

use App\Models\Partner;
use Illuminate\Support\Facades\Cache;

class PartnerObserver
{
    public function saved(Partner $partner)
    {
        $this->clearHomePageCache();
    }

    public function deleted(Partner $partner)
    {
        $this->clearHomePageCache();
    }

    protected function clearHomePageCache()
    {
        Cache::flush(); // أو الطريقة الأكثر دقة الموضحة لاحقًا
    }
}