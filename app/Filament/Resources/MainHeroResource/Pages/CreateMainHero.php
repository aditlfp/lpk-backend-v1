<?php

namespace App\Filament\Resources\MainHeroResource\Pages;

use App\Filament\Resources\MainHeroResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMainHero extends CreateRecord
{
    protected static string $resource = MainHeroResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
