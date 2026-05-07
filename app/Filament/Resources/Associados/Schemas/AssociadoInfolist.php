<?php

namespace App\Filament\Resources\Associados\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AssociadoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('foto_associado_path')
                    ->label('Foto do Associado')
                    ->circular()
                    ->columnSpanFull(),
                TextEntry::make('nome'),
                TextEntry::make('cpf'),
                TextEntry::make('data_nascimento')
                    ->date(),
                TextEntry::make('estado_civil'),
                TextEntry::make('naturalidade'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('telefone_whatsapp'),
                TextEntry::make('cep'),
                TextEntry::make('logradouro'),
                TextEntry::make('numero'),
                TextEntry::make('complemento')
                    ->placeholder('-'),
                TextEntry::make('bairro'),
                TextEntry::make('cidade'),
                TextEntry::make('estado'),
                TextEntry::make('corporacao'),
                TextEntry::make('matricula'),
                TextEntry::make('posto_graduacao'),
                IconEntry::make('is_civil')
                    ->boolean(),
                ImageEntry::make('rg_frente_path')
                    ->label('RG Frente'),
                ImageEntry::make('rg_verso_path')
                    ->label('RG Verso'),
                TextEntry::make('assinatura')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('aceite_termos')
                    ->boolean(),
                IconEntry::make('ciencia_lgpd')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
