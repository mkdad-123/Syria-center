<?php

namespace App\Filament\Resources\CompliantResource\Pages;

use App\Filament\Resources\CompliantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompliants extends ListRecords
{
    protected static string $resource = CompliantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
