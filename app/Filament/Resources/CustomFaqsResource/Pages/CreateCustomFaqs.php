<?php

namespace App\Filament\Resources\CustomFaqsResource\Pages;

use App\Filament\Resources\CustomFaqsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomFaqs extends CreateRecord
{
    protected static string $resource = CustomFaqsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
