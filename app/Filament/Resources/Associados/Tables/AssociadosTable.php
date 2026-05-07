<?php

namespace App\Filament\Resources\Associados\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AssociadosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('matricula')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('posto_graduacao')
                    ->label('Posto/Graduação')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('corporacao')
                    ->label('Corporação')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('telefone_whatsapp')
                    ->label('Telefone')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
