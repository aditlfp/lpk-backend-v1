<?php

namespace App\Filament\Resources\BestStudentResource\Pages;

use App\Filament\Resources\BestStudentResource;
use App\Jobs\SyncApiDataJob;
use App\Models\BestStudent;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class ListBestStudents extends ListRecords
{
    protected static string $resource = BestStudentResource::class;
    // In app/Filament/Resources/BestStudentResource/Pages/ListBestStudents.php

protected function getEloquentQuery(): Builder
{
    // For debugging, let's try a simple, direct query.
    return BestStudent::query()->where('status_progress', 'Penempatan');
}
    protected function getHeaderActions(): array
    {
        return [
           //
        ];
    }
}
