<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryMediaResource\Pages;
use App\Filament\Resources\GalleryMediaResource\RelationManagers;
use App\Models\GalleryMedia;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class GalleryMediaResource extends Resource
{
    protected static ?string $model = GalleryMedia::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $navigationLabel = "Gallery Media";

    protected static ?string $navigationGroup = 'Manage View Asahikari';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('Instruction ( Petunjuk )')
                    ->content(new HtmlString('<img src="' . asset('images/contoh_upload_gallery.jpg') . '" class="rounded-md shadow-md w-full max-w-4xl" />'))
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('bg_image')
                    ->label('Background Image')
                    ->multiple()
                    ->image(),
                Forms\Components\FileUpload::make('img')
                    ->label('Image / Foto Kegiatan')
                    ->required()
                    ->image(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('location')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('bg_image')
                    ->label('Background Image'),
                Tables\Columns\ImageColumn::make('img')
                    ->label('Image / Foto Kegiatan'),
                Tables\Columns\TextColumn::make('title')
                    ->placeholder('Enter a title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->placeholder('Ponorogo')
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListGalleryMedia::route('/'),
            'create' => Pages\CreateGalleryMedia::route('/create'),
            'view' => Pages\ViewGalleryMedia::route('/{record}'),
            'edit' => Pages\EditGalleryMedia::route('/{record}/edit'),
        ];
    }
}
