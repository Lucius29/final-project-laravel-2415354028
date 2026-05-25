<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('price')
                    ->numeric()
                    ->required(),

                Textarea::make('description'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        1 => 'Activate',
                        0 => 'Deactivate',
                    ])
                    ->required()
                    ->native(false)
            ]);
    }
}
