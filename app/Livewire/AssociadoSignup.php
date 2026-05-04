<?php

namespace App\Livewire;

use App\Models\Associado;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

class AssociadoSignup extends Component
{
    use WithFileUploads;

    // Form data
    public $nome;
    public $cpf;
    public $data_nascimento;
    public $estado_civil;
    public $naturalidade;
    public $email;
    public $telefone_whatsapp;

    public $cep;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cidade;
    public $estado;

    public $corporacao = 'PM';
    public $matricula;
    public $posto_graduacao;
    public $is_civil = false;

    public $rg_frente;
    public $rg_verso;

    public $assinatura;
    public $aceite_termos = false;
    public $ciencia_lgpd = false;

    protected $rules = [
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|max:14|unique:associados,cpf',
        'data_nascimento' => 'required|date',
        'estado_civil' => 'required|string',
        'naturalidade' => 'required|string',
        'email' => 'required|email|unique:associados,email',
        'telefone_whatsapp' => 'required|string',
        'cep' => 'required|string|max:9',
        'logradouro' => 'required|string',
        'numero' => 'required|string',
        'bairro' => 'required|string',
        'cidade' => 'required|string',
        'estado' => 'required|string|size:2',
        'corporacao' => 'required|string',
        'matricula' => 'required|string',
        'posto_graduacao' => 'required|string',
        'rg_frente' => 'nullable|image|max:2048',
        'rg_verso' => 'nullable|image|max:2048',
        'aceite_termos' => 'accepted',
        'ciencia_lgpd' => 'accepted',
    ];

    public function updatedCep($value)
    {
        $cep = preg_replace('/[^0-9]/', '', $value);
        if (strlen($cep) === 8) {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
            if ($response->successful()) {
                $data = $response->json();
                if (!isset($data['erro'])) {
                    $this->logradouro = $data['logradouro'];
                    $this->bairro = $data['bairro'];
                    $this->cidade = $data['localidade'];
                    $this->estado = $data['uf'];
                }
            }
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento,
            'estado_civil' => $this->estado_civil,
            'naturalidade' => $this->naturalidade,
            'email' => $this->email,
            'telefone_whatsapp' => $this->telefone_whatsapp,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'corporacao' => $this->corporacao,
            'matricula' => $this->matricula,
            'posto_graduacao' => $this->posto_graduacao,
            'is_civil' => $this->is_civil,
            'assinatura' => $this->assinatura,
            'aceite_termos' => $this->aceite_termos,
            'ciencia_lgpd' => $this->ciencia_lgpd,
        ];

        if ($this->rg_frente) {
            $data['rg_frente_path'] = $this->rg_frente->store('documentos', 'public');
        }

        if ($this->rg_verso) {
            $data['rg_verso_path'] = $this->rg_verso->store('documentos', 'public');
        }

        Associado::create($data);

        session()->flash('message', 'Cadastro realizado com sucesso!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.associado-signup')
            ->layout('layouts.app');
    }
}
