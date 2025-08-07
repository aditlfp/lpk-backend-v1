<?php

namespace App\Filament\Resources\GalleryMediaResource\Pages;

use App\Filament\Resources\GalleryMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGalleryMedia extends ViewRecord
{
    protected static string $resource = GalleryMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
