<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BestStudentResource\Pages;
use App\Filament\Resources\BestStudentResource\RelationManagers;
use App\Models\BestStudent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BestStudentResource extends Resource
{
    protected static ?string $model = BestStudent::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = "Best Candidate";

    protected static ?string $navigationGroup = "Data LPK";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('best_student')
                    ->label('Kandidat Terbaik')
                    ->updateStateUsing(function ($record, $state) {
                        // Update the record's state
                        $record->best_student = $state;
                        $record->save();

                        // Prepare the notification message
                        $status = $state ? 'Kandidat Terbaik Dinyalakan' : 'Kandidat Terbaik Di Nonaktifkan';

                        // Send the notification
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
            'index' => Pages\ListBestStudents::route('/'),
        ];
    }
}
