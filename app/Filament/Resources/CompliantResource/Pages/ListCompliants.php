<?php

namespace App\Filament\Resources\CompliantResource\Pages;

use App\Filament\Resources\CompliantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompliants extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CompliantResource::class;

    protected function getHeaderActions(): array
    {
        return [
           // Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make()
        ];
    }
}
