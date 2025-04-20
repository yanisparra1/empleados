<?php

namespace App\Filament\Resources\TipoPersonalResource\Pages;

use App\Filament\Resources\TipoPersonalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoPersonals extends ListRecords
{
    protected static string $resource = TipoPersonalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
