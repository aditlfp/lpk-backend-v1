<?php

namespace App\Filament\Resources\SenseiResource\Pages;

use App\Filament\Resources\SenseiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSenseis extends ListRecords
{
    protected static string $resource = SenseiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    public function getSubheading(): ?string
    {
        return 'Use This To Displays the Best Sensei on asahikarimulya.co.id. ( Section : Kandidat Terbaik )';
    }
}
