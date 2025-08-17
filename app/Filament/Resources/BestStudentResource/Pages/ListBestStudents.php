<?php

namespace App\Filament\Resources\BestStudentResource\Pages;

use App\Filament\Resources\BestStudentResource;
use App\Jobs\SyncApiDataJob;
use App\Models\BestStudent as CalonSiswa; // Sesuaikan dengan model yang Anda gunakan
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class ListBestStudents extends ListRecords
{
    protected static string $resource = BestStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('syncData')
                ->label('Sync with API')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->requiresConfirmation()
                ->action(function () {
                    SyncApiDataJob::dispatch(auth()->id());
                }),
        ];
    }
}
