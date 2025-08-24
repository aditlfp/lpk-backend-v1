<?php

namespace App\Filament\Resources\SswFieldResource\Pages;

use App\Filament\Resources\SswFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSswFields extends ListRecords
{
    protected static string $resource = SswFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New SSW'),
        ];
    }


    /**
     * use this class to add SubHeading On Index Page
     *
     * @return string|null
     */
    public function getSubheading(): ?string
    {
        return 'Use This To Displays the SSW ( Bidang Pekerjaan ) on asahikarimulya.co.id.';
    }
}
