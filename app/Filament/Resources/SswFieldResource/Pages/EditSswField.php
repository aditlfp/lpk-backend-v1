<?php

namespace App\Filament\Resources\SswFieldResource\Pages;

use App\Filament\Resources\SswFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSswField extends EditRecord
{
    protected static string $resource = SswFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
