<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use App\Models\Customer;
use App\Models\Service;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->label('Customer')
                    ->options(
                        Customer::query()
                            ->pluck('name', 'id')
                    )
                    ->searchable()
                    ->required(),

                Select::make('service_id')
                    ->label('Service')
                    ->options(
                        Service::query()
                            ->pluck('name', 'id')
                    )
                    ->searchable()
                    ->required(),

                DatePicker::make('start_date')
                    ->required(),

                DatePicker::make('end_date')
                    ->required(),

                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'trial' => 'Trial',
                        'isolir' => 'Isolir',
                        'dismantle' => 'Dismantle',
                    ])
                    ->required()
                    ->native(false),
            ]);
    }
}
