<?php

namespace App\Http\Controllers;

use App\Models\Associado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AssociadoController extends Controller
{
    public function index()
    {
        return Inertia::render('Associado/Signup');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomeCompleto' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:associados,cpf',
            'dataNascimento' => 'required|date',
            'estadoCivil' => 'required|string',
            'naturalidade' => 'required|string',
            'email' => 'required|email|unique:associados,email',
            'telefone1' => 'required|string',
            'cep' => 'required|string|max:9',
            'logradouro' => 'required|string',
            'numero' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string|size:2',
            'corporacao' => 'required|string',
            'matricula' => 'required|string',
            'postoGraduacao' => 'required|string',
            'rgFrente' => 'nullable|string', // Base64 or path
            'rgVerso' => 'nullable|string',
            'fotoAssociado' => 'nullable|string',
            'assinatura' => 'nullable|string',
            'autorizoInclusao' => 'accepted',
            'cienteLGPD' => 'accepted',
        ]);

        // Map React fields to Database fields if they differ
        $data = [
            'nome' => $validated['nomeCompleto'],
            'cpf' => $validated['cpf'],
            'data_nascimento' => $validated['dataNascimento'],
            'estado_civil' => $validated['estadoCivil'],
            'naturalidade' => $validated['naturalidade'],
            'email' => $validated['email'],
            'telefone_whatsapp' => $validated['telefone1'],
            'cep' => $validated['cep'],
            'logradouro' => $validated['logradouro'],
            'numero' => $validated['numero'],
            'bairro' => $validated['bairro'] ?? '',
            'cidade' => $validated['cidade'],
            'estado' => $validated['estado'],
            'corporacao' => $validated['corporacao'],
            'matricula' => $validated['matricula'],
            'posto_graduacao' => $validated['postoGraduacao'],
            'is_civil' => $request->input('associadoCivil') === 'Sim',
            'assinatura' => $validated['assinatura'],
            'aceite_termos' => true,
            'ciencia_lgpd' => true,
        ];

        // Handling Base64 images
        $data['rg_frente_path'] = $this->saveBase64Image($request->input('rgFrente'), 'associados/rg');
        $data['rg_verso_path'] = $this->saveBase64Image($request->input('rgVerso'), 'associados/rg');
        $data['foto_associado_path'] = $this->saveBase64Image($request->input('fotoAssociado'), 'associados/fotos');

        Associado::create($data);

        return redirect()->back()->with('message', 'Cadastro realizado com sucesso!');
    }

    private function saveBase64Image(?string $base64, string $directory): ?string
    {
        if (!$base64 || !str_contains($base64, ';base64,')) {
            return null;
        }

        try {
            $format = explode('/', explode(':', substr($base64, 0, strpos($base64, ';')))[1])[1];
            $image = str_replace(' ', '+', explode(',', $base64)[1]);
            $fileName = Str::random(40) . '.' . $format;
            $path = $directory . '/' . $fileName;

            Storage::disk('public')->put($path, base64_decode($image));

            return $path;
        } catch (\Exception $e) {
            return null;
        }
    }

    // API endpoint for direct POST (bypassing CSRF if route starts with /api/)
    public function apiStore(Request $request)
    {
        return $this->store($request);
    }
}
