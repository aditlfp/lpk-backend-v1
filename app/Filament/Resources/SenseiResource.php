<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SenseiResource\Pages;
use App\Filament\Resources\SenseiResource\RelationManagers;
use App\Models\Sensei;
use App\Models\ActiveKandidat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;


class SenseiResource extends Resource
{
    protected static ?string $model = Sensei::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationGroup = 'Manage Student/PL/Sensei';

    protected static ?string $pluralModelLabel = 'Sensei';

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
                Tables\Columns\TextColumn::make('email')
                    ->placeholder('No Email Found Yet')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->placeholder('No Hp Not Found')
                    ->searchable(),
                Tables\Columns\TextColumn::make('usia')
                    ->label('Umur')
                    ->placeholder('Usia/Umur Not Found')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('sensei')
                    ->label('Kandidat Terbaik')
                    ->getStateUsing(fn (Sensei $record) =>
                        ActiveKandidat::where('sensei_id', $record->id)
                            ->value('sensei_id') ?? false
                    )
                    ->updateStateUsing(function (bool $state, Sensei $record) {

                        if ($state) {
                            // Cari row kosong khusus sensei_id
                            $existing = ActiveKandidat::whereNull('sensei_id')->first();

                            if ($existing) {
                                $existing->update(['sensei_id' => $record->id]);
                            } else {
                                ActiveKandidat::create([
                                    'sensei_id' => $record->id,
                                ]);
                            }
                        } else {
                            // Toggle OFF → hapus baris yg memang sensei ini
                            ActiveKandidat::where('sensei_id', $record->id)->delete();
                        }

                        $status = $state ? 'Aktif' : 'Non Aktif';

                        Notification::make()
                            ->title("Data Diupdate : {$status}")
                            ->success()
                            ->send();
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListSenseis::route('/'),
        ];
    }
}
