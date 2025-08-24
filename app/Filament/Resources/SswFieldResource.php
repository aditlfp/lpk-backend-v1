<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SswFieldResource\Pages;
use App\Filament\Resources\SswFieldResource\RelationManagers;
use App\Models\SswField;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SswFieldResource extends Resource
{
    protected static ?string $model = SswField::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationLabel = 'SSW ( Bidang Pekerjaan )';

    protected static ?string $navigationGroup = 'Manage View Asahikari';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_icon')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->placeholder('Contoh: Industri Penerbangan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtitle_japan')
                    ->label('subtitle_japan (opsional)')
                    ->placeholder('(航空業)')
                    ->maxLength(255),
                Forms\Components\TextArea::make('desc')
                    ->label('Description')
                    ->required()
                    ->placeholder('Deskripsi Pekerjaan')
                    ->autosize(),
                Forms\Components\TextInput::make('jumlah_dibutuhkan')
                    ->required()
                    ->placeholder('100 - 1000')
                    ->maxLength(255),
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
                Tables\Columns\ImageColumn::make('image_icon'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle_japan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('desc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_dibutuhkan')
                    ->searchable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSswFields::route('/'),
            'create' => Pages\CreateSswField::route('/create'),
            'edit' => Pages\EditSswField::route('/{record}/edit'),
        ];
    }
}
