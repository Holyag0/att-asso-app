<?php

namespace App\Filament\Resources\Associados\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AssociadoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->required(),
                TextInput::make('cpf')
                    ->required(),
                DatePicker::make('data_nascimento')
                    ->required(),
                TextInput::make('estado_civil')
                    ->required(),
                TextInput::make('naturalidade')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('telefone_whatsapp')
                    ->tel()
                    ->required(),
                TextInput::make('cep')
                    ->required(),
                TextInput::make('logradouro')
                    ->required(),
                TextInput::make('numero')
                    ->required(),
                TextInput::make('complemento'),
                TextInput::make('bairro')
                    ->required(),
                TextInput::make('cidade')
                    ->required(),
                TextInput::make('estado')
                    ->required(),
                TextInput::make('corporacao')
                    ->required(),
                TextInput::make('matricula')
                    ->required(),
                TextInput::make('posto_graduacao')
                    ->required(),
                Toggle::make('is_civil')
                    ->required(),
                TextInput::make('rg_frente_path'),
                TextInput::make('rg_verso_path'),
                Textarea::make('assinatura')
                    ->columnSpanFull(),
                Toggle::make('aceite_termos')
                    ->required(),
                Toggle::make('ciencia_lgpd')
                    ->required(),
            ]);
    }
}
