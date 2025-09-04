<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LpkClassResource\Pages;
use App\Filament\Resources\LpkClassResource\RelationManagers;
use App\Models\LpkClass;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\Placeholder;

class LpkClassResource extends Resource
{
    protected static ?string $model = LpkClass::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Kelas LPK';

    protected static ?string $navigationGroup = 'Manage View Asahikari';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\FileUpload::make('image')->image()->downloadable(),
                    Forms\Components\TextInput::make('title')
                        ->placeholder('Judul/Nama Kelas...')
                        ->required(),
                    Forms\Components\TextInput::make('waktu_pendidikan')
                        ->placeholder('Contoh: 1 - 6 Bulan...'),
                    Forms\Components\Select::make('bersertifikat')
                    ->options(['1' => 'Ya', '0' => 'Tidak'])
                    ->default('0'),
                    Forms\Components\TextInput::make('url')
                        ->label('Link/URL (opsional)')
                        ->placeholder('Masukkan Link Kelas anda jika ada...'),
                    Forms\Components\TextInput::make('rating')
                        ->placeholder('1-5')
                        ->numeric(),
                    Forms\Components\Textarea::make('desc')
                        ->placeholder('Deskripsikan Kelas anda...'),    

                ]),
                // --- VALIDASI PADA FORM ---
                Forms\Components\Toggle::make('active')
                    ->required()
                    ->rule(function (Forms\Get $get, $record): \Closure { // <-- FIX DI SINI: Menghapus type hint ?Model
                        return function (string $attribute, $value, \Closure $fail) use ($get, $record) {
                            // Jika user tidak mengaktifkannya, tidak perlu validasi
                            if (!$value) {
                                return;
                            }

                            $query = LpkClass::where('active', true);

                            // Jika sedang dalam mode edit, kecualikan record yang sedang diedit
                            if ($record) {
                                $query->where('id', '!=', $record->id);
                            }

                        };
                    }),
            ]);
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
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('waktu_pendidikan'),
                Tables\Columns\ToggleColumn::make('bersertifikat')
                    ->updateStateUsing(function ($record, $state) {
                        // Update the record's state
                        $record->bersertifikat = $state;
                        $record->save();

                        // Prepare the notification message
                        $status = $state ? 'Bersertifikat' : 'Tidak Bersertifikat';

                        // Send the notification
                        Notification::make()
                            ->title("Data Diupdate : {$status}")
                            ->success()
                            ->send();
                    })
                    ->alignCenter(),
                Tables\Columns\ViewColumn::make('rating')
                        ->view('tables.columns.star-rating')
                        ->alignCenter(),
                Tables\Columns\ToggleColumn::make('active')
                   ->updateStateUsing(function ($record, $state) {
                        // Update the record's state
                        $record->active = $state;
                        $record->save();

                        // Prepare the notification message
                        $status = $state ? 'Active' : 'Non Active';

                        // Send the notification
                        Notification::make()
                            ->title("Data Diupdate : {$status}")
                            ->success()
                            ->send();
                    })
                    ->alignCenter(),

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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Data belum tersedia')
            ->emptyStateDescription('Silakan tambahkan data untuk mulai menampilkan.')
            ->emptyStateIcon('heroicon-o-information-circle');
    }

    public static function getRelations(): array
    {
        return [
            // LpkClassResource\RelationManagers\MateriRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLpkClasses::route('/'),
            'create' => Pages\CreateLpkClass::route('/create'),
            'edit' => Pages\EditLpkClass::route('/{record}/edit'),
        ];
    }
}
