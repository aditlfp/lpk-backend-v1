<?php

namespace App\Filament\Resources\LpkClassResource\Pages;

use App\Filament\Resources\LpkClassResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLpkClasses extends ListRecords
{
    protected static string $resource = LpkClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    /**
     * use this class to add SubHeading On Index Page
     *
     * @return string|null
     */
    public function getSubheading(): ?string
    {
        return 'Use This To Displays the 4 latest active LPK classes for the front page.';
    }

}
