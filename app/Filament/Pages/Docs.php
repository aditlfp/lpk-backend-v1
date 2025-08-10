<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Docs extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static string $view = 'filament.pages.docs';

    protected static ?string $navigationGroup = "Developer";

    protected static ?string $navigationLabel = "Documentation";
}
