<?php

namespace App\Filament\Resources\MainHeroResource\Pages;

use App\Filament\Resources\MainHeroResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMainHero extends ViewRecord
{
    protected static string $resource = MainHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
