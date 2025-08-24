<?php

namespace App\Filament\Resources\PetugasLapanganResource\Pages;

use App\Filament\Resources\PetugasLapanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPetugasLapangans extends ListRecords
{
    protected static string $resource = PetugasLapanganResource::class;

    public function getSubheading(): ?string
    {
        return 'Use This To Displays the Best PL on asahikarimulya.co.id. ( Section : Kandidat Terbaik )';
    }
}
