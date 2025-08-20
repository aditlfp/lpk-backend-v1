<?php

namespace App\Filament\Resources\LpkClassResource\Pages;

use App\Filament\Resources\LpkClassResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLpkClass extends CreateRecord
{
    protected static string $resource = LpkClassResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
