<?php

namespace App\Filament\Resources\TipoPersonalResource\Pages;

use App\Filament\Resources\TipoPersonalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoPersonal extends EditRecord
{
    protected static string $resource = TipoPersonalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
