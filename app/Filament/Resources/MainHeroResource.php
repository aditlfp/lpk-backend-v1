<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MainHeroResource\Pages;
use App\Filament\Resources\MainHeroResource\RelationManagers;
use App\Models\MainHero;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class MainHeroResource extends Resource
{
    protected static ?string $model = MainHero::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = "Master Data";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('Instruction ( Petunjuk )')
                    ->content(new HtmlString('<img src="' . asset('images/contoh_main_hero.jpg') . '" class="rounded-md shadow-md w-full max-w-4xl" />'))
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('c_image')
                    ->label('Background Image')
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('main_logo')
                    ->required()
                    ->image(),
                Forms\Components\TextInput::make('text_logo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('desc')
                    ->columnSpanFull(),
                Grid::make(2)->schema([
                    Forms\Components\FileUpload::make('collab_logo')
                        ->label('Collaboration Logo')
                        ->multiple()
                        ->columnSpanFull()
                        ->image(),
                ]),
                Forms\Components\Toggle::make('is_pinned')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('c_image'),
                Tables\Columns\ImageColumn::make('main_logo'),
                Tables\Columns\TextColumn::make('text_logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('collab_logo'),
                Tables\Columns\IconColumn::make('is_pinned')
                    ->boolean(),
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
            ])->emptyStateHeading('Data belum tersedia')  // Heading text
            ->emptyStateDescription('Silakan tambahkan data untuk mulai menampilkan.')  // Optional description
            ->emptyStateIcon('heroicon-o-information-circle');  // Optional custom icon

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
