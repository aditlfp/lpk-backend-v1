<?php

namespace App\Filament\Resources\PostVideoYoutubeResource\Pages;

use App\Filament\Resources\PostVideoYoutubeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPostVideoYoutube extends ViewRecord
{
    protected static string $resource = PostVideoYoutubeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
