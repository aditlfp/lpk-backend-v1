<?php

namespace App\Filament\Resources\TestimonisResource\Pages;

use App\Filament\Resources\TestimonisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestimonis extends EditRecord
{
    protected static string $resource = TestimonisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
