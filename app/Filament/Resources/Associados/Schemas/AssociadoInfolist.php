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
                    ->disk('public')
                    ->circular()
                    ->columnSpanFull(),
                TextEntry::make('tipo_cadastro')
                    ->label('Tipo de Cadastro')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'novo_cadastro' => 'Novo Cadastro',
                        'att_cadastral' => 'Atualização Cadastral',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'novo_cadastro' => 'success',
                        'att_cadastral' => 'warning',
                        default => 'gray',
                    }),
                TextEntry::make('nome')
                    ->label('Nome Completo'),
                TextEntry::make('cpf')
                    ->label('CPF'),
                TextEntry::make('data_nascimento')
                    ->label('Data de Nascimento')
                    ->date('d/m/Y'),
                TextEntry::make('estado_civil')
                    ->label('Estado Civil'),
                TextEntry::make('naturalidade')
                    ->label('Naturalidade'),
                TextEntry::make('email')
                    ->label('E-mail'),
                TextEntry::make('telefone_whatsapp')
                    ->label('Telefone / WhatsApp'),
                TextEntry::make('cep')
                    ->label('CEP'),
                TextEntry::make('logradouro')
                    ->label('Logradouro'),
                TextEntry::make('numero')
                    ->label('Número'),
                TextEntry::make('complemento')
                    ->label('Complemento')
                    ->placeholder('-'),
                TextEntry::make('bairro')
                    ->label('Bairro'),
                TextEntry::make('cidade')
                    ->label('Cidade'),
                TextEntry::make('estado')
                    ->label('Estado'),
                TextEntry::make('corporacao')
                    ->label('Corporação'),
                TextEntry::make('matricula')
                    ->label('Matrícula'),
                TextEntry::make('posto_graduacao')
                    ->label('Posto / Graduação'),
                IconEntry::make('is_civil')
                    ->label('É Civil?')
                    ->boolean(),
                TextEntry::make('codigo')
                    ->label('Código Militar')
                    ->placeholder('-'),
                ImageEntry::make('rg_frente_path')
                    ->label('Envio de Documento - RG Frente')
                    ->disk('public'),
                ImageEntry::make('rg_verso_path')
                    ->label('Envio de Documento - RG Verso')
                    ->disk('public'),
                TextEntry::make('assinatura')
                    ->label('Assinatura')
                    ->html()
                    ->formatStateUsing(fn ($state) => $state ? "<img src=\"{$state}\" alt=\"Assinatura\" style=\"max-height: 100px; border: 1px solid #ccc; background: white; padding: 4px; border-radius: 4px;\" />" : '-')
                    ->columnSpanFull(),
                IconEntry::make('aceite_termos')
                    ->label('Aceitou os Termos?')
                    ->boolean(),
                IconEntry::make('ciencia_lgpd')
                    ->label('Ciente da LGPD?')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),
            ]);
    }
}
