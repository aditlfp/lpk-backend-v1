<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LpkClassResource\Pages;
use App\Filament\Resources\LpkClassResource\RelationManagers;
use App\Models\LpkClass;
use Filament\Forms;
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
                Forms\Components\FileUpload::make('image')->image(),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\TextInput::make('waktu_pendidikan'),
                Forms\Components\Select::make('bersertifikat')
                ->options(['1' => 'Ya', '0' => 'Tidak'])
                ->default('0'),
                Forms\Components\TextInput::make('url')->required(),
                Forms\Components\Textarea::make('desc'),
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

                            // Hitung jumlah yang sudah aktif
                            $activeCount = $query->count();

                            if ($activeCount >= 4) {
                                $fail('Batas maksimal (4) kelas aktif telah tercapai. Anda tidak bisa mengaktifkan kelas ini.');
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
                    }),
                Tables\Columns\TextColumn::make('url'),
                 // --- MODIFIKASI BEST PRACTICE ---
                Tables\Columns\ToggleColumn::make('active')
                    ->disabled(function ($record) {
                        // Jika record ini belum aktif, periksa jumlah total yang sudah aktif.
                        if (!$record->active) {
                            // Hitung jumlah record yang sudah aktif.
                            $activeCount = LpkClass::where('active', true)->count();
                            // Jika sudah ada 4 atau lebih yang aktif, nonaktifkan toggle ini.
                            return $activeCount >= 4;
                        }
                        // Jika record ini sudah aktif, biarkan toggle tetap bisa digunakan (untuk menonaktifkan).
                        return false;
                    })
                    ->updateStateUsing(function ($record, $state) {
                        // Logika ini tetap sebagai pengaman di sisi server,
                        // meskipun UI sudah dinonaktifkan.
                        $activeCount = LpkClass::where('active', true)->count();

                        if ($activeCount >= 4 && $state) {
                            Notification::make()
                                ->title('Gagal Mengaktifkan')
                                ->body('Batas maksimal (4) kelas aktif telah tercapai.')
                                ->danger()
                                ->send();

                            // Mencegah update dan mengembalikan toggle ke posisi semula.
                            $record->refresh();
                            return;
                        }

                        $record->active = $state;
                        $record->save();
                    }),
                // -------------------------

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
