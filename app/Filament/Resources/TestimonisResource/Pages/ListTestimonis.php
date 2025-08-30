<?php

namespace App\Filament\Resources\TestimonisResource\Pages;

use App\Filament\Resources\TestimonisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestimonis extends ListRecords
{
    protected static string $resource = TestimonisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Testimoni'),
        ];
    }

     /**
     * use this class to add SubHeading On Index Page
     *
     * @return string|null
     */
    public function getSubheading(): ?string
    {
        return 'Use This To Displays the Comment / Testimoni on asahikarimulya.co.id.';
    }
}
