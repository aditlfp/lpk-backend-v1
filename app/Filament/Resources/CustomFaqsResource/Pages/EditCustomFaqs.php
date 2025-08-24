<?php

namespace App\Filament\Resources\CustomFaqsResource\Pages;

use App\Filament\Resources\CustomFaqsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomFaqs extends EditRecord
{
    protected static string $resource = CustomFaqsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
