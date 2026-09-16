<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associado extends Model
{
    protected $fillable = [
        'tipo_cadastro',
        'nome',
        'cpf',
        'data_nascimento',
        'estado_civil',
        'naturalidade',
        'email',
        'telefone_whatsapp',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'corporacao',
        'matricula',
        'posto_graduacao',
        'is_civil',
        'codigo',
        'rg_frente_path',
        'rg_verso_path',
        'foto_associado_path',
        'assinatura',
        'aceite_termos',
        'ciencia_lgpd',
        'contato_adicional_nome',
        'contato_adicional_endereco',
        'contato_adicional_bairro',
        'contato_adicional_cidade',
        'contato_adicional_estado',
        'contato_adicional_telefone',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'is_civil' => 'boolean',
        'aceite_termos' => 'boolean',
        'ciencia_lgpd' => 'boolean',
    ];
}
