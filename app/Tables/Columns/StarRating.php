<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\Column;

class StarRating extends Column
{
    protected string $view = 'tables.columns.star-rating';

    public static function make(string $name): static
    {
        return parent::make($name);
    }
}
