<?php

namespace App\Filament\Resources\Services\Pages;

use Filament\Resources\Pages\ListRecords;

use Filament\Actions\CreateAction;

use App\Filament\Resources\Services\ServiceResource;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
