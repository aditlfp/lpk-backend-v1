<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    protected static ?string $model = Comments::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $navigationGroup = 'Manage View Asahikari';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_foto')
                    ->label('Profile User'),
                Forms\Components\TextInput::make('username')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->required(),
                Forms\Components\TextInput::make('rating')
                    ->label('Rating (1-5)')
                    ->required(),
                Forms\Components\RichEditor::make('comment')
                    ->required()
                    ->placeholder('Example: This LPK is very cool and great'),

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
                Tables\Columns\ImageColumn::make('image_foto')
                    ->label('Profile User'),
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->badge()
                    ->color('success')
                    ->searchable(),
                Tables\Columns\ViewColumn::make('rating')->view('tables.columns.star-rating'),
                Tables\Columns\TextColumn::make('comment')
                    ->wrap()
                    ->html()
                    ->limit(50)
                    ->formatStateUsing(fn ($state) => str($state)->limit(50))
                    ->tooltip('This is a preview. Click the view icon to see the full comment.') // A more informative tooltip
                    ->toggleable(),
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
