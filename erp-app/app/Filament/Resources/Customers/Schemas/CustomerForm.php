<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->tel()
                    ->maxLength(50),

                Textarea::make('address')
                    ->columnSpanFull(),

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
