<?php

namespace App\Filament\Resources\PostVideoYoutubeResource\Pages;

use App\Filament\Resources\PostVideoYoutubeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostVideoYoutube extends EditRecord
{
    protected static string $resource = PostVideoYoutubeResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
