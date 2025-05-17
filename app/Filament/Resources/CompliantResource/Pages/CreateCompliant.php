<?php

namespace App\Filament\Resources\CompliantResource\Pages;

use App\Filament\Resources\CompliantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompliant extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = CompliantResource::class;


}
