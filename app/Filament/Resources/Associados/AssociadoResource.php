<?php

namespace App\Filament\Resources\Associados;

use App\Filament\Resources\Associados\Pages\CreateAssociado;
use App\Filament\Resources\Associados\Pages\EditAssociado;
use App\Filament\Resources\Associados\Pages\ListAssociados;
use App\Filament\Resources\Associados\Pages\ViewAssociado;
use App\Filament\Resources\Associados\Schemas\AssociadoForm;
use App\Filament\Resources\Associados\Schemas\AssociadoInfolist;
use App\Filament\Resources\Associados\Tables\AssociadosTable;
use App\Models\Associado;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AssociadoResource extends Resource
{
    protected static ?string $model = Associado::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nome';

    public static function form(Schema $schema): Schema
    {
        return AssociadoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AssociadoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssociadosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAssociados::route('/'),
            'create' => CreateAssociado::route('/create'),
            'view' => ViewAssociado::route('/{record}'),
            'edit' => EditAssociado::route('/{record}/edit'),
        ];
    }
}
