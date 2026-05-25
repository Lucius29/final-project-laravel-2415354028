<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $response = Http::post(
            'http://127.0.0.1:8001/api/customers',
            $data
        );

        if (! $response->successful()) {
            throw new \Exception(
                $response->json('message') ?? 'Failed create Customer'
            );
        }

        $apiData = $response->json('data');

        return Customer::updateOrCreate(
            ['id' => $apiData['id']],
            $apiData
        );
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
