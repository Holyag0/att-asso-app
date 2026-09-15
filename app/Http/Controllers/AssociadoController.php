<?php

namespace App\Http\Controllers;

use App\Models\Associado;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
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
            'corporacao' => 'nullable|string',
            'matricula' => 'nullable|string',
            'postoGraduacao' => 'nullable|string',
            'rgFrente' => 'nullable|string', // Base64 or path
            'rgVerso' => 'nullable|string',
            'fotoAssociado' => 'nullable|string',
            'assinatura' => 'nullable|string',
            'autorizoInclusao' => 'accepted',
            'cienteLGPD' => 'accepted',
            'contatoAdicionalNome' => 'nullable|string|max:255',
            'contatoAdicionalEndereco' => 'nullable|string|max:255',
            'contatoAdicionalBairro' => 'nullable|string|max:255',
            'contatoAdicionalCidade' => 'nullable|string|max:255',
            'contatoAdicionalEstado' => 'nullable|string|max:2',
            'contatoAdicionalTelefone' => 'nullable|string|max:255',
        ]);

        $isCivil = $request->input('associadoCivil') === 'Sim';
        $maxAge = $isCivil ? 55 : 49;
        $age = \Carbon\Carbon::parse($validated['dataNascimento'])->age;

        if ($age > $maxAge) {
            $tipo = $isCivil ? 'civil' : 'militar';
            return redirect()->back()->withErrors([
                'dataNascimento' => "Limite de idade excedido: associado {$tipo} pode se cadastrar até {$maxAge} anos (sua idade calculada: {$age} anos)."
            ]);
        }

        // Map React fields to Database fields if they differ
        $data = [
            'tipo_cadastro' => 'att_cadastral',
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
            'corporacao' => $isCivil ? 'CIVIL' : ($validated['corporacao'] ?? 'CIVIL'),
            'matricula' => $isCivil ? 'CIVIL' : ($validated['matricula'] ?? 'CIVIL'),
            'posto_graduacao' => $isCivil ? 'CIVIL' : ($validated['postoGraduacao'] ?? 'CIVIL'),
            'is_civil' => $isCivil,
            'assinatura' => $validated['assinatura'],
            'aceite_termos' => true,
            'ciencia_lgpd' => true,
            'contato_adicional_nome' => $request->input('contatoAdicionalNome'),
            'contato_adicional_endereco' => $request->input('contatoAdicionalEndereco'),
            'contato_adicional_bairro' => $request->input('contatoAdicionalBairro'),
            'contato_adicional_cidade' => $request->input('contatoAdicionalCidade'),
            'contato_adicional_estado' => $request->input('contatoAdicionalEstado'),
            'contato_adicional_telefone' => $request->input('contatoAdicionalTelefone'),
        ];

        // Handling Base64 images
        $data['rg_frente_path'] = $this->saveBase64Image($request->input('rgFrente'), 'associados/rg');
        $data['rg_verso_path'] = $this->saveBase64Image($request->input('rgVerso'), 'associados/rg');
        $data['foto_associado_path'] = $this->saveBase64Image($request->input('fotoAssociado'), 'associados/fotos');

        $associado = Associado::create($data);

        $pdfUrl = URL::signedRoute('associados.pdf.public', ['associado' => $associado->id]);

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Cadastro realizado com sucesso!',
            'pdf_url' => $pdfUrl,
        ]);
    }

    public function generatePdf(Associado $associado)
    {
        $view = $associado->is_civil ? 'pdf.contrato_civil' : 'pdf.associado';
        $prefix = $associado->is_civil ? 'contrato-civil-' : 'ficha-';

        $pdf = Pdf::loadView($view, ['associado' => $associado]);
        $pdf->setPaper('a4', 'portrait');

        $filename = $prefix.str_replace(['.', '-'], '', $associado->cpf).'.pdf';

        return $pdf->download($filename);
    }

    public function generatePdfPublic(Request $request, Associado $associado)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        return $this->generatePdf($associado);
    }

    private function saveBase64Image(?string $base64, string $directory): ?string
    {
        if (! $base64 || ! str_contains($base64, ';base64,')) {
            return null;
        }

        try {
            $format = explode('/', explode(':', substr($base64, 0, strpos($base64, ';')))[1])[1];
            $image = str_replace(' ', '+', explode(',', $base64)[1]);
            $fileName = Str::random(40).'.'.$format;
            $path = $directory.'/'.$fileName;

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
