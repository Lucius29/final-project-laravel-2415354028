<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->action(function (Model $record) {

                    $response = Http::delete(
                        "http://127.0.0.1:8001/api/services/{$record->id}"
                    );

                    if (! $response->successful()) {
                        throw new \Exception(
                            $response->json('message')
                                ?? 'Failed delete service'
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
            "http://127.0.0.1:8001/api/services/{$record->id}",
            $data
        );

        if (! $response->successful()) {
            throw new \Exception(
                $response->json('message')
                    ?? 'Failed update service'
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
