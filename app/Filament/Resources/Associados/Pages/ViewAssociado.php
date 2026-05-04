<?php

namespace App\Filament\Resources\Associados\Pages;

use App\Filament\Resources\Associados\AssociadoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAssociado extends ViewRecord
{
    protected static string $resource = AssociadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
