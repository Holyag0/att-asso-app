<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associado extends Model
{
    protected $fillable = [
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
        'rg_frente_path',
        'rg_verso_path',
        'foto_associado_path',
        'assinatura',
        'aceite_termos',
        'ciencia_lgpd',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'is_civil' => 'boolean',
        'aceite_termos' => 'boolean',
        'ciencia_lgpd' => 'boolean',
    ];
}
