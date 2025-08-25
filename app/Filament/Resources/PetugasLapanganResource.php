<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetugasLapanganResource\Pages;
use App\Filament\Resources\PetugasLapanganResource\RelationManagers;
use App\Models\PetugasLapangan;
use App\Models\ActiveKandidat;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class PetugasLapanganResource extends Resource
{
    protected static ?string $model = PetugasLapangan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Petugas Lapangan ( PL )';

    protected static ?string $navigationGroup = 'Manage Student/PL/Sensei';

    protected static ?string $pluralModelLabel = 'Petugas Lapangan ( PL )';

    public static function getEloquentQuery(): EloquentBuilder
    {
        $query = parent::getEloquentQuery();
        return $query->inActiveProgress();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->state(fn ($record, $rowLoop) => $rowLoop->iteration)
                    ->sortable(true)
                    ->searchable(false),
                Tables\Columns\ImageColumn::make('Document')
                    ->label('Foto')
                    ->placeholder("Foto Tidak Ditemukan")
                    ->getStateUsing(fn ($record) => $record->document
                        ? 'https://recruitment.savanait.com/' . $record->document->file_path
                        : null)
                    ->checkFileExistence(false)
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->size(60)
                    ->alignCenter()
                    ->circular(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('area_penugasan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
               Tables\Columns\ViewColumn::make('performance_rating')->view('tables.columns.star-rating'),
               Tables\Columns\ToggleColumn::make('field_officiers')
                    ->label('Kandidat Terbaik')
                    ->getStateUsing(fn (PetugasLapangan $record) =>
                        ActiveKandidat::where('field_officiers_id', $record->id)
                            ->value('field_officiers_id') ?? false
                    )
                    ->updateStateUsing(function (bool $state, PetugasLapangan $record) {


                        if ($state) {
                             // Cari row kosong khusus sensei_id
                            $existing = ActiveKandidat::whereNull('field_officiers_id')->first();

                            if ($existing) {
                                $existing->update(['field_officiers_id' => $record->id]);
                            } else {
                                ActiveKandidat::create([
                                    'field_officiers_id' => $record->id,
                                ]);
                            }
                        } else {
                             ActiveKandidat::where('field_officiers_id', $record->id)->delete();
                        }

                        $status = $state ? 'Aktif' : 'Non Aktif';


                        Notification::make()
                            ->title("Data Diupdate : {$status}")
                            ->success()
                            ->send();
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->modifyQueryUsing(function (EloquentBuilder $query) {
                $query->inActiveProgress();
            })
            ->emptyStateHeading('Data belum tersedia')
            ->emptyStateDescription('Silakan tambahkan data untuk mulai menampilkan.')
            ->emptyStateIcon('heroicon-o-information-circle');
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
            'index' => Pages\ListPetugasLapangans::route('/'),
        ];
    }
}
