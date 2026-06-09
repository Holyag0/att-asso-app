<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ficha de Associação - {{ $associado->nome }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .header {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 2px solid #0284c7;
            padding-bottom: 10px;
        }
        .header td {
            vertical-align: middle;
        }
        .logo {
            max-height: 70px;
        }
        .header-title {
            text-align: center;
            font-weight: bold;
        }
        .header-title h1 {
            font-size: 18px;
            margin: 0;
            color: #0369a1;
        }
        .header-title p {
            font-size: 11px;
            margin: 5px 0 0 0;
            color: #64748b;
            text-transform: uppercase;
            font-weight: normal;
        }
        .photo-container {
            text-align: right;
        }
        .profile-photo {
            width: 85px;
            height: 110px;
            border: 2px solid #cbd5e1;
            padding: 2px;
            object-fit: cover;
            border-radius: 4px;
        }
        .photo-placeholder {
            width: 85px;
            height: 110px;
            border: 2px dashed #cbd5e1;
            line-height: 110px;
            text-align: center;
            color: #94a3b8;
            font-size: 9px;
            display: inline-block;
            border-radius: 4px;
        }
        .section {
            margin-bottom: 15px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
        }
        .section-header {
            background-color: #0369a1;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .section-content {
            padding: 10px;
        }
        .grid-table {
            width: 100%;
            border-collapse: collapse;
        }
        .grid-table td {
            padding: 4px 6px;
            vertical-align: top;
        }
        .label {
            font-size: 8px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: bold;
            display: block;
            margin-bottom: 2px;
        }
        .value {
            font-size: 11px;
            color: #0f172a;
            font-weight: 500;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 9px;
            font-weight: bold;
            color: white;
            border-radius: 4px;
            text-transform: uppercase;
        }
        .badge-new {
            background-color: #16a34a;
        }
        .badge-update {
            background-color: #ca8a04;
        }
        .footer-terms {
            margin-top: 20px;
            font-size: 9px;
            color: #475569;
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 10px;
            border-radius: 6px;
        }
        .terms-item {
            margin-bottom: 6px;
        }
        .terms-item:last-child {
            margin-bottom: 0;
        }
        .signatures-section {
            margin-top: 40px;
            width: 100%;
        }
        .signature-box {
            text-align: center;
            vertical-align: bottom;
            width: 50%;
        }
        .signature-img {
            max-height: 55px;
            max-width: 250px;
            margin-bottom: 5px;
        }
        .signature-line {
            border-top: 1px solid #94a3b8;
            width: 80%;
            margin: 0 auto 5px auto;
        }
        .doc-preview-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        .doc-preview-table td {
            width: 50%;
            padding: 5px;
            text-align: center;
        }
        .doc-img {
            max-width: 90%;
            max-height: 180px;
            border: 1px solid #cbd5e1;
            padding: 2px;
            border-radius: 4px;
        }
        .doc-placeholder {
            height: 100px;
            line-height: 100px;
            border: 1px dashed #cbd5e1;
            color: #94a3b8;
            font-size: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <table class="header">
        <tr>
            <td style="width: 15%;">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" class="logo">
                @else
                    <div style="font-weight: bold; color: #0369a1; font-size: 18px;">CABEMCE</div>
                @endif
            </td>
            <td style="width: 65%;" class="header-title">
                <h1>CABEMCE</h1>
                <p>Caixa Beneficente dos Militares do Ceará</p>
                <div style="margin-top: 8px;">
                    <span class="badge {{ $associado->tipo_cadastro === 'novo_cadastro' ? 'badge-new' : 'badge-update' }}">
                        {{ $associado->tipo_cadastro === 'novo_cadastro' ? 'Novo Cadastro' : 'Atualização Cadastral' }}
                    </span>
                </div>
            </td>
            <td style="width: 20%;" class="photo-container">
                @if($associado->foto_associado_path && file_exists(storage_path('app/public/' . $associado->foto_associado_path)))
                    <img src="{{ storage_path('app/public/' . $associado->foto_associado_path) }}" class="profile-photo">
                @else
                    <div class="photo-placeholder">Sem Foto</div>
                @endif
            </td>
        </tr>
    </table>

    <div class="section">
        <div class="section-header">1. Dados Pessoais</div>
        <div class="section-content">
            <table class="grid-table">
                <tr>
                    <td colspan="3" style="width: 60%;">
                        <span class="label">Nome Completo</span>
                        <span class="value">{{ $associado->nome }}</span>
                    </td>
                    <td style="width: 40%;">
                        <span class="label">CPF</span>
                        <span class="value">{{ $associado->cpf }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <span class="label">Data de Nascimento</span>
                        <span class="value">{{ $associado->data_nascimento ? $associado->data_nascimento->format('d/m/Y') : '-' }}</span>
                    </td>
                    <td style="width: 25%;">
                        <span class="label">Estado Civil</span>
                        <span class="value">{{ $associado->estado_civil }}</span>
                    </td>
                    <td style="width: 25%;">
                        <span class="label">Naturalidade</span>
                        <span class="value">{{ $associado->naturalidade }}</span>
                    </td>
                    <td style="width: 25%;">
                        <span class="label">WhatsApp / Telefone</span>
                        <span class="value">{{ $associado->telefone_whatsapp }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <span class="label">E-mail</span>
                        <span class="value">{{ $associado->email }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-header">2. Endereço Residencial</div>
        <div class="section-content">
            <table class="grid-table">
                <tr>
                    <td style="width: 20%;">
                        <span class="label">CEP</span>
                        <span class="value">{{ $associado->cep }}</span>
                    </td>
                    <td colspan="2" style="width: 60%;">
                        <span class="label">Logradouro</span>
                        <span class="value">{{ $associado->logradouro }}</span>
                    </td>
                    <td style="width: 20%;">
                        <span class="label">Número</span>
                        <span class="value">{{ $associado->numero }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <span class="label">Complemento</span>
                        <span class="value">{{ $associado->complemento ?? '-' }}</span>
                    </td>
                    <td style="width: 25%;">
                        <span class="label">Bairro</span>
                        <span class="value">{{ $associado->bairro }}</span>
                    </td>
                    <td style="width: 35%;">
                        <span class="label">Cidade</span>
                        <span class="value">{{ $associado->cidade }}</span>
                    </td>
                    <td style="width: 15%;">
                        <span class="label">Estado</span>
                        <span class="value">{{ $associado->estado }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-header">3. Dados Funcionais / Carreira</div>
        <div class="section-content">
            <table class="grid-table">
                <tr>
                    <td style="width: 25%;">
                        <span class="label">Corporação</span>
                        <span class="value">{{ $associado->corporacao }}</span>
                    </td>
                    <td style="width: 25%;">
                        <span class="label">Matrícula</span>
                        <span class="value">{{ $associado->matricula }}</span>
                    </td>
                    <td style="width: 25%;">
                        <span class="label">Posto / Graduação</span>
                        <span class="value">{{ $associado->posto_graduacao }}</span>
                    </td>
                    <td style="width: 25%;">
                        <span class="label">É Civil?</span>
                        <span class="value">{{ $associado->is_civil ? 'Sim' : 'Não' }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer-terms">
        <div class="terms-item">
            <strong>Declaração de Inclusão:</strong> Afirmo que as informações prestadas por mim, relativas a minha atualização cadastral de SÓCIO da CABEMCE, estão corretas e verdadeiras. (Aceito em {{ $associado->created_at->format('d/m/Y H:i') }})
        </div>
        <div class="terms-item" style="margin-top: 5px;">
            <strong>Ciência LGPD:</strong> Estou ciente de que estou amparado pela Lei Geral de Proteção de Dados Pessoais. (Aceito em {{ $associado->created_at->format('d/m/Y H:i') }})
        </div>
    </div>

    <table class="signatures-section">
        <tr>
            <td class="signature-box" style="width: 50%;">
                @if($associado->assinatura)
                    <img src="{{ $associado->assinatura }}" class="signature-img"><br>
                @else
                    <div style="height: 55px;"></div>
                @endif
                <div class="signature-line"></div>
                <div style="font-weight: bold; font-size: 10px;">{{ $associado->nome }}</div>
                <div style="font-size: 8px; color: #64748b; text-transform: uppercase;">Associado(a)</div>
            </td>
            <td class="signature-box" style="width: 50%;">
                <div style="height: 55px;"></div>
                <div class="signature-line"></div>
                <div style="font-weight: bold; font-size: 10px;">Representante CABEMCE</div>
                <div style="font-size: 8px; color: #64748b; text-transform: uppercase;">Assinatura do Atendente</div>
            </td>
        </tr>
    </table>

    <div style="page-break-before: always;"></div>

    <div class="section">
        <div class="section-header">4. Documentos Anexados</div>
        <div class="section-content">
            <h3 style="margin-top: 0; font-size: 12px; color: #0369a1;">Registro Geral (RG)</h3>
            <table class="doc-preview-table">
                <tr>
                    <td>
                        <span class="label" style="margin-bottom: 5px;">RG Frente</span>
                        @if($associado->rg_frente_path && file_exists(storage_path('app/public/' . $associado->rg_frente_path)))
                            <img src="{{ storage_path('app/public/' . $associado->rg_frente_path) }}" class="doc-img">
                        @else
                            <div class="doc-placeholder">Frente do RG não anexada</div>
                        @endif
                    </td>
                    <td>
                        <span class="label" style="margin-bottom: 5px;">RG Verso</span>
                        @if($associado->rg_verso_path && file_exists(storage_path('app/public/' . $associado->rg_verso_path)))
                            <img src="{{ storage_path('app/public/' . $associado->rg_verso_path) }}" class="doc-img">
                        @else
                            <div class="doc-placeholder">Verso do RG não anexado</div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>
