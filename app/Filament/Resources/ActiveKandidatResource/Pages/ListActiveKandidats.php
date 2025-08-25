<?php

namespace App\Filament\Resources\ActiveKandidatResource\Pages;

use App\Filament\Resources\ActiveKandidatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActiveKandidats extends ListRecords
{
    protected static string $resource = ActiveKandidatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
