<?php

namespace App\Services\Contracts;

interface PageSectionService
{
    /**
     * تُعيد HTML النهائي (نفس view(...)->render()).
     */
    public function render(string $locale, array $params = []): string;
}
