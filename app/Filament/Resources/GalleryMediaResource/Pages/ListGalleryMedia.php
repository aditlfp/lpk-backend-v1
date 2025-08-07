<?php

namespace App\Filament\Resources\GalleryMediaResource\Pages;

use App\Filament\Resources\GalleryMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleryMedia extends ListRecords
{
    protected static string $resource = GalleryMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
