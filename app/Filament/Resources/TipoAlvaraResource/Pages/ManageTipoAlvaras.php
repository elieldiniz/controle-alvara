<?php

namespace App\Filament\Resources\TipoAlvaraResource\Pages;

use App\Filament\Resources\TipoAlvaraResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipoAlvaras extends ManageRecords
{
    protected static string $resource = TipoAlvaraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
