<?php

namespace App\Filament\Resources\Subscriptions\Pages;

use App\Filament\Resources\Subscriptions\SubscriptionResource;
use App\Models\Subscription;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;


class CreateSubscription extends CreateRecord
{
    protected static string $resource = SubscriptionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $response = Http::post(
            'http://127.0.0.1:8001/api/subscriptions',
            $data
        );

        if (! $response->successful()) {
            throw new \Exception(
                $response->json('message')
                    ?? 'Failed create subscription'
            );
        }

        $apiData = $response->json('data');

        return Subscription::updateOrCreate(
            ['id' => $apiData['id']],
            $apiData
        );
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
