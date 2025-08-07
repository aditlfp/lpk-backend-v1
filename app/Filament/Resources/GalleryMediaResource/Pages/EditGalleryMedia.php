<?php

namespace App\Filament\Resources\GalleryMediaResource\Pages;

use App\Filament\Resources\GalleryMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGalleryMedia extends EditRecord
{
    protected static string $resource = GalleryMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
