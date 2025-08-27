<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActiveKandidatResource\Pages;
use App\Filament\Resources\ActiveKandidatResource\RelationManagers;
use App\Models\ActiveKandidat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Rupadana\ApiService\ApiService;
use Rupadana\ApiService\Http\Handlers;

class ActiveKandidatResource extends Resource
{
    protected static ?string $model = ActiveKandidat::class;

    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';

    protected static ?string $navigationLabel = 'Current Show Kandidat';

    protected static ?string $navigationGroup = 'Manage Student/PL/Sensei';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('BestStudent.nama_lengkap')
                    ->label('Nama Siswa Terbaik')
                    ->sortable(true)
                    ->searchable(true)
                    ->placeholder('Data Tidak Ditemukan'),
                Tables\Columns\TextColumn::make('PetugasLap.nama_lengkap')
                    ->label('Nama PL Terbaik')
                    ->sortable(true)
                    ->searchable(true)
                    ->placeholder('Data Tidak Ditemukan'),
                Tables\Columns\TextColumn::make('Sensei.nama_lengkap')
                    ->label('Nama Sensei Terbaik')
                    ->sortable(true)
                    ->searchable(true)
                    ->placeholder('Data Tidak Ditemukan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->sortable(true)
                    ->searchable(false)
                    ->placeholder('Data Tidak Ditemukan'),
            ])
            ->filters([
                //
            ])
            ->actions([
               //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getApiService(): ?ApiService
    {
        return ApiService::make()
            ->handlers([
                Handlers\IndexHandler::make()->with([
                    'BestStudent', // Must match public function BestStudent()
                    'PetugasLap',  // Must match public function PetugasLap()
                    'Sensei',
                    'PetugasLap.document'      // Must match public function Sensei()
                ]),
                Handlers\ShowHandler::make()->with([
                    'BestStudent',
                    'PetugasLap',
                    'Sensei',
                    'PetugasLap.document'
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActiveKandidats::route('/'),
        ];
    }
}
