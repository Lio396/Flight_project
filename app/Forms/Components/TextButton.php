<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class TextButton extends Field
{
    protected string $view = 'forms.components.text-button';

    public static function make(): static
    {
        return new static();
    }
}
