<?php

namespace App\Filament\Resources\APIListResource\Pages;

use App\Filament\Resources\APIListResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAPILists extends ManageRecords
{
    protected static string $resource = APIListResource::class;

    protected static ?string $title = 'API Lists';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
