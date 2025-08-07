<?php

namespace App\Filament\Resources\GalleryMediaResource\Pages;

use App\Filament\Resources\GalleryMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGalleryMedia extends CreateRecord
{
    protected static string $resource = GalleryMediaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
