<?php

namespace App\Filament\Resources\Customer\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->action(function (Model $record) {

                    $response = Http::delete(
                        "http://127.0.0.1:8001/api/customers/{$record->id}"
                    );

                    if (! $response->successful()) {
                        throw new \Exception(
                            $response->json('message')
                                ?? 'Failed delete customer'
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
            "http://127.0.0.1:8001/api/customers/{$record->id}",
            $data
        );

        if (! $response->successful()) {
            throw new \Exception(
                $response->json('message')
                    ?? 'Failed update customer'
            );
        }

        $apiData = $response->json('data');

        $record->update($apiData);

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
