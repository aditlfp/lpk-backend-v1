<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BestStudentResource\Pages;
use App\Filament\Resources\BestStudentResource\RelationManagers;
use App\Models\BestStudent;
use App\Models\SetBestStudent;
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

    protected static ?string $navigationLabel = "Best Candidate";

    protected static ?string $navigationGroup = 'Manage View Asahikari';

        public static function getEloquentQuery(): EloquentBuilder
    {
        // Do NOT turn this into Query\Builder (no ->toBase(), no DB::table())
        $query = parent::getEloquentQuery();

        // Optional sanity check while debugging:
        // if (! method_exists($query->getModel(), 'scopeInActiveProgress')) {
        //     throw new \RuntimeException('Resource is not using App\Models\BestStudent');
        // }

        return $query->inActiveProgress(); // ✅ scope now available
    }

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
                    ->getStateUsing(fn (BestStudent $record) =>
                        SetBestStudent::where('best_student_id', $record->id)
                            ->value('is_best') ?? false
                    )
                    ->updateStateUsing(function (bool $state, BestStudent $record) {
                        // Update the record's state
                        // $record->best_student = $state;
                        // $record->save();

                        SetBestStudent::updateOrCreate(
                            ['best_student_id' => $record->id],
                            [
                                'is_best' => $state,
                            ]
                        );

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
            ])->modifyQueryUsing(function (EloquentBuilder $query) {
                $query->inActiveProgress(); // ✅ also ok here
            });
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
