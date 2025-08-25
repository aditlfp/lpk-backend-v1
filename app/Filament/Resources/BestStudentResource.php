<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BestStudentResource\Pages;
use App\Filament\Resources\BestStudentResource\RelationManagers;
use App\Models\BestStudent;
use App\Models\ActiveKandidat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class BestStudentResource extends Resource
{
    protected static ?string $model = BestStudent::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = "Students";

    protected static ?string $navigationGroup = 'Manage Student/PL/Sensei';

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
                    ->circular(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('umur')
                    ->label('Umur')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_progress')
                    ->label('Progress'),
                Tables\Columns\ToggleColumn::make('best_student')
                    ->label('Kandidat Terbaik')
                    ->getStateUsing(fn (BestStudent $record) =>
                        ActiveKandidat::where('best_student_id', $record->id)
                            ->value('best_student_id') ?? false
                    )
                    ->updateStateUsing(function (bool $state, BestStudent $record) {

                        if ($state) {
                            // Cari row kosong khusus sensei_id
                            $existing = ActiveKandidat::whereNull('best_student_id')->first();

                            if ($existing) {
                                $existing->update(['best_student_id' => $record->id]);
                            } else {
                                ActiveKandidat::create([
                                    'best_student_id' => $record->id,
                                ]);
                            }
                        } else {
                            // Toggle OFF → hapus baris yg memang sensei ini
                            ActiveKandidat::where('best_student_id', $record->id)->delete();
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
            'index' => Pages\ListBestStudents::route('/'),
        ];
    }
}
