<?php

namespace App\Filament\Resources\Subscriptions\Pages;

use App\Filament\Resources\Subscriptions\SubscriptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class EditSubscription extends EditRecord
{
    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [

            DeleteAction::make()
                ->action(function (Model $record) {

                    $response = Http::delete(
                        "http://127.0.0.1:8001/api/subscriptions/{$record->id}"
                    );

                    if (! $response->successful()) {
                        throw new \Exception(
                            $response->json('message')
                                ?? 'Failed delete subscription'
                        );
                    }

                    $record->delete();
                }),
        ];
    }

    protected function handleRecordUpdate(
        Model $record,
        array $data
    ): Model {

        $response = Http::patch(
            "http://127.0.0.1:8001/api/subscriptions/{$record->id}",
            $data
        );

        if (! $response->successful()) {
            throw new \Exception(
                $response->json('message')
                    ?? 'Failed update subscription'
            );
        }

        $record->update(
            $response->json('data')
        );

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
