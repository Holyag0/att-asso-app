<?php

namespace App\Filament\Resources\Associados\Pages;

use App\Filament\Resources\Associados\AssociadoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssociados extends ListRecords
{
    protected static string $resource = AssociadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
