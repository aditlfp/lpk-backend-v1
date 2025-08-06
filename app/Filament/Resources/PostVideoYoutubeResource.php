<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostVideoYoutubeResource\Pages;
use App\Filament\Resources\PostVideoYoutubeResource\RelationManagers;
use App\Models\PostVideoYoutube;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function App\Utils\extractYoutubeId;
use function App\Utils\getYoutubeDuration;

class PostVideoYoutubeResource extends Resource
{
    protected static ?string $model = PostVideoYoutube::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    protected static ?string $navigationGroup = "Master Data";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('thumbnail')
                    ->required(),
                Grid::make(3)->schema([
                    Forms\Components\TextInput::make('url_video')
                        ->required()
                        ->maxLength(255)
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $videoId = extractYoutubeId($state);
                            if ($videoId) {
                                $duration = getYoutubeDuration($videoId);
                                $set('duration', $duration);
                            }
                        }),
                    Forms\Components\TextInput::make('duration')
                        ->readOnly(true),
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                ]),
                Forms\Components\Textarea::make('desc')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('category')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tag')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url_video')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tag')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
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
            'index' => Pages\ListPostVideoYoutubes::route('/'),
            'create' => Pages\CreatePostVideoYoutube::route('/create'),
            'view' => Pages\ViewPostVideoYoutube::route('/{record}'),
            'edit' => Pages\EditPostVideoYoutube::route('/{record}/edit'),
        ];
    }
}
