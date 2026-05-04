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
                    ->searchable(),
                TextColumn::make('cpf')
                    ->searchable(),
                TextColumn::make('data_nascimento')
                    ->date()
                    ->sortable(),
                TextColumn::make('estado_civil')
                    ->searchable(),
                TextColumn::make('naturalidade')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('telefone_whatsapp')
                    ->searchable(),
                TextColumn::make('cep')
                    ->searchable(),
                TextColumn::make('logradouro')
                    ->searchable(),
                TextColumn::make('numero')
                    ->searchable(),
                TextColumn::make('complemento')
                    ->searchable(),
                TextColumn::make('bairro')
                    ->searchable(),
                TextColumn::make('cidade')
                    ->searchable(),
                TextColumn::make('estado')
                    ->searchable(),
                TextColumn::make('corporacao')
                    ->searchable(),
                TextColumn::make('matricula')
                    ->searchable(),
                TextColumn::make('posto_graduacao')
                    ->searchable(),
                IconColumn::make('is_civil')
                    ->boolean(),
                TextColumn::make('rg_frente_path')
                    ->searchable(),
                TextColumn::make('rg_verso_path')
                    ->searchable(),
                IconColumn::make('aceite_termos')
                    ->boolean(),
                IconColumn::make('ciencia_lgpd')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
