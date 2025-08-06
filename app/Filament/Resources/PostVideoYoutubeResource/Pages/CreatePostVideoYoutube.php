<?php

namespace App\Filament\Resources\PostVideoYoutubeResource\Pages;

use App\Filament\Resources\PostVideoYoutubeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePostVideoYoutube extends CreateRecord
{
    protected static string $resource = PostVideoYoutubeResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
