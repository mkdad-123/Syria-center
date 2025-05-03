<?php

namespace App\Filament\Resources\CompliantResource\Pages;

use App\Filament\Resources\CompliantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompliant extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = CompliantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make()
        ];
    }
}
