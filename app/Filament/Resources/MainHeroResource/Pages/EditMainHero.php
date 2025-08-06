<?php

namespace App\Filament\Resources\MainHeroResource\Pages;

use App\Filament\Resources\MainHeroResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMainHero extends EditRecord
{
    protected static string $resource = MainHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
