<?php

namespace App\Filament\Resources\Associados\Pages;

use App\Filament\Resources\Associados\AssociadoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAssociado extends EditRecord
{
    protected static string $resource = AssociadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
