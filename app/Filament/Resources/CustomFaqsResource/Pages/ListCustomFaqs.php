<?php

namespace App\Filament\Resources\CustomFaqsResource\Pages;

use App\Filament\Resources\CustomFaqsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomFaqs extends ListRecords
{
    protected static string $resource = CustomFaqsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Custom FAQ'),
        ];
    }
     /**
     * use this class to add SubHeading On Index Page
     *
     * @return string|null
     */
    public function getSubheading(): ?string
    {
        return 'Use This To Displays the FAQs ( Frequent Questions Or Concerns ) on asahikarimulya.co.id.';
    }
}
