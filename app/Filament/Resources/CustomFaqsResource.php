<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomFaqsResource\Pages;
use App\Filament\Resources\CustomFaqsResource\RelationManagers;
use App\Models\CustomFaqs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class CustomFaqsResource extends Resource
{
    protected static ?string $model = CustomFaqs::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Custom FAQs';

    protected static ?string $navigationGroup = 'Manage View Asahikari';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\Section::make()
                            ->description('')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->placeholder('Contoh: Apa Itu Asahikari Mulya ?')
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('desc')
                                    ->label('Description')
                                    ->required()
                                    ->placeholder('Jawaban Pertanyaan (FAQ)'),
                            ])
                            ->columns(1),
                    ]),
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                 Tables\Columns\TextColumn::make('desc')
                    ->label('Description')
                    ->wrap()
                    ->html()
                    ->limit(50)
                    ->formatStateUsing(fn ($state) => str($state)->limit(50))
                    ->tooltip('This is a preview. Click the view icon to see the full description.') // A more informative tooltip
                    ->toggleable(), // Still useful
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
            'index' => Pages\ListCustomFaqs::route('/'),
            'create' => Pages\CreateCustomFaqs::route('/create'),
            'edit' => Pages\EditCustomFaqs::route('/{record}/edit'),
        ];
    }
}
