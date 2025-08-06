<?php

namespace App\Filament\Resources\PostVideoYoutubeResource\Pages;

use App\Filament\Resources\PostVideoYoutubeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostVideoYoutubes extends ListRecords
{
    protected static string $resource = PostVideoYoutubeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
