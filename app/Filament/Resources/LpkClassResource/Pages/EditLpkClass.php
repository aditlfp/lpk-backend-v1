<?php

namespace App\Filament\Resources\LpkClassResource\Pages;

use App\Filament\Resources\LpkClassResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLpkClass extends EditRecord
{
    protected static string $resource = LpkClassResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
