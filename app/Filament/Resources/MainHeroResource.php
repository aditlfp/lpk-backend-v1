<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MainHeroResource\Pages;
use App\Models\MainHero;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class MainHeroResource extends Resource
{
    protected static ?string $model = MainHero::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Manage View Asahikari';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Instructions')
                    ->description('Contoh tampilan Main Hero di halaman depan.')
                    ->schema([
                        Forms\Components\Placeholder::make('image_preview')
                            ->label('')
                            ->content(new HtmlString('<img src="' . asset('images/contoh_main_hero.jpg') . '" alt="Contoh Tampilan" class="rounded-md shadow-md w-full max-w-4xl" />')),
                    ]),

                Forms\Components\Section::make('Content Details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\FileUpload::make('c_image')
                            ->label('Background Image')
                            ->image()
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('main_logo')
                            ->label('Main Logo')
                            ->image(),
                        Forms\Components\TextInput::make('text_logo')
                            ->label('Text for Logo')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('desc')
                            ->label('Description')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Collaboration')
                    ->schema([
                        Forms\Components\FileUpload::make('collab_logo')
                            ->label('Collaboration Logos')
                            ->multiple()
                            ->image(),
                    ]),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_pinned')
                            ->label('Active')
                            ->helperText('Hanya satu item yang bisa aktif pada satu waktu.')
                            ->rule(function ($record): \Closure {
                                return function (string $attribute, $value, \Closure $fail) use ($record) {
                                    if (!$value) {
                                        return;
                                    }

                                    $query = MainHero::where('is_pinned', true);
                                    if ($record) {
                                        $query->where('id', '!=', $record->id);
                                    }

                                    if ($query->exists()) {
                                        $fail('Sudah ada item lain yang aktif. Harap nonaktifkan item tersebut terlebih dahulu.');
                                    }
                                };
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('c_image')
                    ->label('Background'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->description(fn (MainHero $record): string => $record->text_logo),

                // --- BEST PRACTICE: ToggleColumn dengan validasi ---
                Tables\Columns\ToggleColumn::make('is_pinned')
                    ->label('Active')
                    ->disabled(function ($record) {
                        // Nonaktifkan toggle jika item ini tidak aktif TAPI sudah ada item lain yang aktif
                        if (!$record->is_pinned) {
                            return MainHero::where('is_pinned', true)->exists();
                        }
                        return false;
                    })
                    ->updateStateUsing(function ($record, $state) {
                        // Jika mencoba mengaktifkan (state jadi true)
                        if ($state) {
                            // Cek apakah sudah ada yang aktif
                            $activeExists = MainHero::where('is_pinned', true)
                                ->where('id', '!=', $record->id)
                                ->exists();

                            if ($activeExists) {
                                Notification::make()
                                    ->title('Aksi Gagal')
                                    ->body('Item lain sudah aktif. Harap nonaktifkan terlebih dahulu.')
                                    ->danger()
                                    ->send();
                                // Batalkan aksi
                                $record->refresh();
                                return;
                            }
                        }
                        // Lanjutkan update jika validasi lolos
                        $record->is_pinned = $state;
                        $record->save();
                    }),
                // --------------------------------------------------

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMainHeroes::route('/'),
            'create' => Pages\CreateMainHero::route('/create'),
            'view' => Pages\ViewMainHero::route('/{record}'),
            'edit' => Pages\EditMainHero::route('/{record}/edit'),
        ];
    }
}
