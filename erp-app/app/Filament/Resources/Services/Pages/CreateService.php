<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $response = Http::post(
            'http://127.0.0.1:8001/api/services',
            $data
        );

        if (! $response->successful()) {
            throw new \Exception(
                $response->json('message') ?? 'Failed create service'
            );
        }

        $apiData = $response->json('data');

        return Service::updateOrCreate(
            ['id' => $apiData['id']],
            $apiData
        );
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
