<?php

namespace App\Filament\Resources\Associados\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AssociadoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('foto_associado_path')
                    ->label('Foto do Associado')
                    ->image()
                    ->disk('public')
                    ->directory('associados/fotos')
                    ->columnSpanFull(),
                Select::make('tipo_cadastro')
                    ->label('Tipo de Cadastro')
                    ->options([
                        'novo_cadastro' => 'Novo Cadastro',
                        'att_cadastral' => 'Atualização Cadastral',
                    ])
                    ->default('att_cadastral')
                    ->required(),
                TextInput::make('nome')
                    ->label('Nome Completo')
                    ->required(),
                TextInput::make('cpf')
                    ->label('CPF')
                    ->required(),
                DatePicker::make('data_nascimento')
                    ->label('Data de Nascimento')
                    ->required(),
                TextInput::make('estado_civil')
                    ->label('Estado Civil')
                    ->required(),
                TextInput::make('naturalidade')
                    ->label('Naturalidade')
                    ->required(),
                TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->required(),
                TextInput::make('telefone_whatsapp')
                    ->label('Telefone / WhatsApp')
                    ->tel()
                    ->required(),
                TextInput::make('cep')
                    ->label('CEP')
                    ->required(),
                TextInput::make('logradouro')
                    ->label('Logradouro')
                    ->required(),
                TextInput::make('numero')
                    ->label('Número')
                    ->required(),
                TextInput::make('complemento')
                    ->label('Complemento'),
                TextInput::make('bairro')
                    ->label('Bairro')
                    ->required(),
                TextInput::make('cidade')
                    ->label('Cidade')
                    ->required(),
                TextInput::make('estado')
                    ->label('Estado')
                    ->required(),
                TextInput::make('corporacao')
                    ->label('Corporação')
                    ->required(),
                TextInput::make('matricula')
                    ->label('Matrícula')
                    ->required(),
                TextInput::make('posto_graduacao')
                    ->label('Posto / Graduação')
                    ->required(),
                Toggle::make('is_civil')
                    ->label('É Civil?')
                    ->required(),
                FileUpload::make('rg_frente_path')
                    ->label('Envio de Documento - RG Frente')
                    ->image()
                    ->disk('public')
                    ->directory('associados/rg'),
                FileUpload::make('rg_verso_path')
                    ->label('Envio de Documento - RG Verso')
                    ->image()
                    ->disk('public')
                    ->directory('associados/rg'),
                Textarea::make('assinatura')
                    ->label('Assinatura (Base64)')
                    ->columnSpanFull(),
                Toggle::make('aceite_termos')
                    ->label('Aceite dos Termos')
                    ->required(),
                Toggle::make('ciencia_lgpd')
                    ->label('Ciência da LGPD')
                    ->required(),
            ]);
    }
}
