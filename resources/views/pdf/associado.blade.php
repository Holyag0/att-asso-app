<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ficha de Associação e Contrato - {{ $associado->nome }}</title>
    <style>
        @page {
            margin: 25px 35px 35px 35px;
        }
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
            margin-bottom: 15px;
            border-bottom: 2px solid #0284c7;
            padding-bottom: 10px;
        }
        .header td {
            vertical-align: middle;
        }
        .logo {
            max-height: 65px;
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
            margin: 3px 0 0 0;
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
            margin-bottom: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
        }
        .section-header {
            background-color: #0369a1;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .section-content {
            padding: 8px 10px;
        }
        .grid-table {
            width: 100%;
            border-collapse: collapse;
        }
        .grid-table td {
            padding: 3px 5px;
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
            font-size: 10px;
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
            margin-top: 15px;
            font-size: 8.5px;
            color: #475569;
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 8px;
            border-radius: 6px;
        }
        .terms-item {
            margin-bottom: 4px;
        }
        .terms-item:last-child {
            margin-bottom: 0;
        }
        .signatures-section {
            margin-top: 30px;
            width: 100%;
        }
        .signature-box {
            text-align: center;
            vertical-align: bottom;
            width: 50%;
        }
        .signature-img {
            max-height: 75px;
            max-width: 250px;
            margin-bottom: 4px;
        }
        .signature-line {
            border-top: 1px solid #94a3b8;
            width: 80%;
            margin: 0 auto 4px auto;
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

        /* Estilos específicos para o Contrato Civil */
        .contract-header {
            text-align: center;
            margin-bottom: 15px;
        }
        .contract-header-logo {
            max-height: 55px;
            margin-bottom: 4px;
        }
        .contract-header-title {
            font-size: 11px;
            font-weight: bold;
            margin: 1px 0;
        }
        .contract-header-subtitle {
            font-size: 10px;
            margin: 1px 0;
        }
        .contract-main-title {
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            margin: 15px 0 10px 0;
            text-transform: uppercase;
        }
        .paragraph {
            text-align: justify;
            margin-bottom: 8px;
            font-size: 9.5px;
            line-height: 1.4;
        }
        .underline-value {
            border-bottom: 1px solid #000;
            display: inline-block;
            padding: 0 4px;
            font-weight: bold;
        }
        .clause-title {
            font-weight: bold;
            font-size: 9.5px;
            margin-top: 10px;
            margin-bottom: 3px;
            text-transform: uppercase;
        }
        .list-item {
            margin-bottom: 3px;
            text-align: justify;
            font-size: 9.5px;
            line-height: 1.4;
        }
        .contract-sig-table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse;
        }
        .contract-sig-table td {
            vertical-align: bottom;
            text-align: center;
            width: 50%;
            padding: 0 15px;
        }
        .contract-witness-section {
            margin-top: 20px;
            font-size: 9px;
        }
        .contract-witness-line {
            border-bottom: 1px solid #000;
            width: 250px;
            display: inline-block;
            margin-bottom: 4px;
        }
        .footer-banner {
            text-align: center;
            font-size: 8px;
            color: #444;
            margin-top: 15px;
            border-top: 1px solid #ccc;
            padding-top: 4px;
        }
    </style>
</head>
<body>

    <!-- ==================== PÁGINA 1: FICHA DE ASSOCIAÇÃO ==================== -->
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
                <div style="margin-top: 6px;">
                    <span class="badge {{ $associado->tipo_cadastro === 'novo_cadastro' ? 'badge-new' : 'badge-update' }}">
                        {{ $associado->tipo_cadastro === 'novo_cadastro' ? 'Nova Adesão' : 'Atualização Cadastral' }}
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
                    <td style="width: 20%;">
                        <span class="label">Corporação</span>
                        <span class="value">{{ $associado->corporacao }}</span>
                    </td>
                    <td style="width: 20%;">
                        <span class="label">Matrícula</span>
                        <span class="value">{{ $associado->matricula }}</span>
                    </td>
                    <td style="width: 20%;">
                        <span class="label">Posto / Graduação</span>
                        <span class="value">{{ $associado->posto_graduacao }}</span>
                    </td>
                    <td style="width: 20%;">
                        <span class="label">É Civil?</span>
                        <span class="value">{{ $associado->is_civil ? 'Sim' : 'Não' }}</span>
                    </td>
                    @if(!$associado->is_civil && $associado->codigo)
                    <td style="width: 20%;">
                        <span class="label">Rubrica (Código)</span>
                        <span class="value">{{ $associado->codigo }}</span>
                    </td>
                    @endif
                </tr>
            </table>
        </div>
    </div>

    <div class="footer-terms">
        <div class="terms-item">
            <strong>Declaração de Inclusão:</strong> Afirmo que as informações prestadas por mim, relativas a minha atualização cadastral de SÓCIO da CABEMCE, estão corretas e verdadeiras. (Aceito em {{ $associado->created_at->format('d/m/Y H:i') }})
        </div>
        <div class="terms-item" style="margin-top: 4px;">
            <strong>Ciência LGPD:</strong> Estou ciente de que estou amparado pela Lei Geral de Proteção de Dados Pessoais. (Aceito em {{ $associado->created_at->format('d/m/Y H:i') }})
        </div>
    </div>

    <table class="signatures-section">
        <tr>
            <td class="signature-box" style="width: 50%;">
                @if($associado->assinatura)
                    <img src="{{ $associado->assinatura }}" class="signature-img"><br>
                @else
                    <div style="height: 50px;"></div>
                @endif
                <div class="signature-line"></div>
                <div style="font-weight: bold; font-size: 10px;">{{ $associado->nome }}</div>
                <div style="font-size: 8px; color: #64748b; text-transform: uppercase;">Associado(a)</div>
            </td>
            <td class="signature-box" style="width: 50%;">
                @if(file_exists(public_path('images/assinatura_diretor.png')))
                    <img src="{{ public_path('images/assinatura_diretor.png') }}" class="signature-img" style="max-height: 55px; max-width: 220px;"><br>
                @else
                    <div style="height: 50px;"></div>
                @endif
                <div class="signature-line"></div>
                <div style="font-weight: bold; font-size: 10px;">DIRETOR JURÍDICO CABEMCE</div>
                <div style="font-size: 8px; color: #64748b; text-transform: uppercase;">Assinatura e Carimbo</div>
            </td>
        </tr>
    </table>

    <!-- ==================== PÁGINA 2: DOCUMENTOS ANEXADOS (RG) ==================== -->
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

    <!-- ==================== PÁGINAS 3 E 4: CONTRATO DE ADESÃO DE ASSOCIADO CIVIL (APENAS SE FOR CIVIL) ==================== -->
    @if($associado->is_civil)
        <div style="page-break-before: always;"></div>

        <div class="contract-header">
            @if(file_exists(public_path('images/logo.png')))
                <img src="{{ public_path('images/logo.png') }}" class="contract-header-logo" alt="Logo CABEMCE"><br>
            @endif
            <div class="contract-header-title">Caixa Beneficente dos Militares do Ceará</div>
            <div class="contract-header-subtitle">Diretoria Administrativa e Financeira</div>
            <div class="contract-header-subtitle">Setor de Plano de Saúde - 1</div>
        </div>

        <div class="contract-main-title">
            CONTRATO DE ADESÃO DE ASSOCIADO CIVIL NA CABEMCE
        </div>

        <div class="paragraph">
            Pelo presente Contrato, de um lado na qualidade de <strong>CONTRATADA: CAIXA BENEFICENTE DOS MILITARES DO CEARÁ</strong>, com sede Avenida Domingos Olímpio, 1589, Farias Brito, Fortaleza/CE, Brasil, CEP 60.191-070 e CNPJ 07.074.792/0001-98, denominada de Controladora para fins da Lei nº 13.709/2018 - Lei Geral de Proteção de Dados.
        </div>

        <div class="paragraph">
            <strong>Do outro lado na qualidade de CONTRATANTE:</strong><br>
            Nome: <span class="underline-value" style="width: 320px;">{{ $associado->nome }}</span>, Nacionalidade: <span class="underline-value" style="width: 120px;">{{ $associado->naturalidade ?? 'Brasileira' }}</span>,<br>
            CPF nº: <span class="underline-value" style="width: 160px;">{{ $associado->cpf }}</span>, residente e domiciliado na <span class="underline-value" style="width: 280px;">{{ $associado->logradouro }}, Nº {{ $associado->numero }} {{ $associado->complemento }}</span>,<br>
            Bairro: <span class="underline-value" style="width: 130px;">{{ $associado->bairro }}</span>, Cidade: <span class="underline-value" style="width: 130px;">{{ $associado->cidade }}</span>, Estado: <span class="underline-value" style="width: 30px;">{{ $associado->estado }}</span>, CEP: <span class="underline-value" style="width: 80px;">{{ $associado->cep }}</span>,<br>
            Correio Eletrônico (<em>e-mail</em>): <span class="underline-value" style="width: 380px;">{{ $associado->email }}</span>,<br>
            Telefones: <span class="underline-value" style="width: 200px;">{{ $associado->telefone_whatsapp }}</span>.
        </div>

        <div class="paragraph">
            <strong>CONTATO ADICIONAL:</strong><br>
            Nome: <span class="underline-value" style="width: 340px;">{{ $associado->contato_adicional_nome ?? '________________________________________' }}</span>, Endereço: <span class="underline-value" style="width: 180px;">{{ $associado->contato_adicional_endereco ?? '___________________' }}</span>,<br>
            Bairro: <span class="underline-value" style="width: 110px;">{{ $associado->contato_adicional_bairro ?? '____________' }}</span>, Cidade: <span class="underline-value" style="width: 110px;">{{ $associado->contato_adicional_cidade ?? '____________' }}</span>, Estado: <span class="underline-value" style="width: 30px;">{{ $associado->contato_adicional_estado ?? '__' }}</span>, Telefone: <span class="underline-value" style="width: 120px;">{{ $associado->contato_adicional_telefone ?? '____________' }}</span>.
        </div>

        <div class="paragraph" style="margin-top: 8px;">
            Firmam o presente <strong>CONTRATO DE INCLUSÃO COMO ASSOCIADO CIVIL DA CABEMCE</strong>, mediante as condições insertas nas cláusulas que se seguem:
        </div>

        <div class="clause-title">CLÁUSULA PRIMEIRA – DA ADESÃO</div>
        <div class="list-item">I. O CONTRATANTE ASSOCIADO de modo livre, informado e inequívoco declara que ao se ASSOCIAR À CABEMCE, conhece as condições e os DIREITOS DO ASSOCIADO da Caixa Beneficente dos Militares do Ceará (CABEMCE), as quais aceita de livre e espontânea vontade.</div>
        <div class="list-item">II. O presente contrato é de adesão, bilateral, gerando direitos e obrigações para ambas as partes.</div>

        <div class="clause-title">CLÁUSULA SEGUNDA – DO OBJETO</div>
        <div class="list-item">I. O presente contrato tem por objeto a ADESÃO DO CONTRATANTE COMO ASSOCIADO CIVIL DA CABEMCE, com direito aos benefícios oferecidos, com exceção dos benefícios previstos no Artigos 41 e 43 do Estatuto Social da Cabemce.</div>
        <div class="list-item">II. A vigência do presente Contrato tem início na data de sua assinatura, tendo a vigência indeterminada, podendo ser rescindido pela parte CONTRATANTE, a qualquer momento, mediante envio prévio de comunicação à CONTRATADA, com antecedência mínima de 30 (trinta) dias, sendo observado o pagamento de mensalidades vencidas e outros débitos.</div>

        <div class="clause-title">CLÁUSULA TERCEIRA – DAS OBRIGAÇÕES DO CONTRATANTE</div>
        <div class="list-item">I. O CONTRATANTE, tem o conhecimento da obrigação de efetuar o pagamento das mensalidades da Instituição e do Plano de Saúde em dia, cuja inadimplência, por mais de <strong>90 (noventa) dias</strong>, acarretará o cancelamento do mesmo, independente de aviso ou notificação.</div>
        <div class="list-item">II. O CONTRATANTE, pagará a mensalidade no valor de R$ 54,00 (cinquenta e quatro reais) a partir do mês da sua inscrição, como associado(a) civil, e terá direito aos benefícios previstos na cláusula segunda do presente contrato, reajustado anualmente pelo IGPM ou outro que o venha substituir.</div>
        <div class="list-item">III. É obrigação do CONTRATANTE como associado comunicar formalmente, solicitando a atualização, de quaisquer alterações dos dados cadastrais, inclusive mudança de endereço, sendo que se assim não proceder estará isentando a CONTRATADA de qualquer responsabilidade ou consequência por falta de comunicação.</div>

        <div class="clause-title">CLÁUSULA QUARTA – DAS OBRIGAÇÕES DA CONTRATADA</div>
        <div class="list-item">I. A CONTRATADA fica obrigada a dar conhecimento ao CONTRATANTE das informações sobre a situação financeira dos pagamentos.</div>
        <div class="list-item">II. A CONTRATADA se obriga a informar previamente ao CONTRATANTE sobre toda e qualquer anormalidade no pagamento que possa influir negativamente no Contrato.</div>
        <div class="list-item">III. A CONTRATADA se obriga a fornecer canais de comunicação para o CONTRATANTE apresentar solicitações.</div>
        <div class="list-item">IV. A CONTRATADA, colocará à disposição dos associados serviços disponíveis na CABEMCE conforme relação abaixo:</div>
        <div class="list-item" style="padding-left: 15px;">01 – Serviços Jurídicos nas áreas ADMINISTRATIVAS, CIVIL e CRIMINAL;</div>
        <div class="list-item" style="padding-left: 15px;">02 – Creche Escola Tiradentes, para filhos de 02 (dois) a 05 (cinco) anos;</div>
        <div class="list-item" style="padding-left: 15px;">03 – Compras na Loja Cabemce com 15% (quinze por cento) de desconto;</div>
        <div class="list-item" style="padding-left: 15px;">04 – Planos de Saúde e Participação em Convênios celebrados pela Instituição.</div>

        <div class="clause-title">CLÁUSULA QUINTA – DO PAGAMENTO</div>
        <div class="list-item">I. A CONTRATANTE se obriga a realizar o pagamento da mensalidade, até o dia <strong>10 (dez)</strong> de cada mês.</div>
        <div class="list-item">II. Na ocorrência de falta ou atraso no pagamento, a CONTRATANTE, entrará em contato com o devedor para realizar o pagamento da mensalidade.</div>
        <div class="list-item">III. O atraso no pagamento da mensalidade do associado, poderá acarretar cobrança extrajudicial e/ou judicial, e inclusão do nome do CONTRATANTE nos Órgãos de Proteção ao Crédito.</div>
        <div class="list-item">IV. A falta de pagamento da mensalidade de associado da CABEMCE por <strong>3 (três meses)</strong> consecutivos ou não, implica no desligamento do quadro de associados e consequentemente no cancelamento do contrato, de acordo com as Normas Estatutárias e Contratuais da CABEMCE.</div>
        <div class="list-item">V. A extinção do vínculo de Associado CONTRATANTE com CONTRATADA não extingue a responsabilidade com as mensalidades não pagas, arcando o CONTRATANTE integralmente com os débitos existentes.</div>

        <div class="clause-title">CLÁUSULA SEXTA – DAS COMUNICAÇÕES</div>
        <div class="list-item">I. As comunicações com a CONTRATADA poderão ser feitas por meio de Telefone (85) 3048.9964, correio eletrônico, Mensagem Eletrônica, ou presencialmente na Sede da CONTRATADA.</div>

        <div class="clause-title">CLÁUSULA SÉTIMA – DA PROTEÇÃO DE DADOS PESSOAIS</div>
        <div class="list-item">I. O CONTRATANTE, em decorrência do presente instrumento e para o bom andamento da prestação dos serviços declara EXPRESSO CONSENTIMENTO e AUTORIZA a coleta, tratamento e armazenamento dos dados obtidos por parte da CONTRATADA.</div>
        <div class="list-item">II. A CONTRATADA, na condição de CONTROLADORA, obriga-se a atuar em conformidade com a Lei nº 13.709/2018, Lei Geral de Proteção de Dados (LGPD), visando proteger os dados pessoais do associado, coletados exclusivamente para os fins de administração e execução deste Contrato.</div>
        <div class="list-item">III. A CONTRATADA compromete-se a tratar os dados pessoais obtidos com o CONTRATANTE de acordo com as bases legais previstas nas hipóteses dos Arts. 7º, 11 e/ou 14 da Lei 13.709/2018, para propósitos legítimos, específicos, explícitos e informados ao Titular desses Dados Pessoais.</div>
        <div class="list-item">IV. O CONTRATANTE consente de modo livre, e inequívoco, para a garantia da execução deste contrato, que a CONTRATADA possa realizar o compartilhamento de dados pessoais, com instituições financeiras, Empresas Cobrança e/ou Postagem, e a Operadora do Plano de Saúde contratado, conforme a Lei Nº 13.709/2018 (LGPD).</div>

        <div class="clause-title">CLÁUSULA OITAVA – DAS INFORMAÇÕES E ESCLARECIMENTOS</div>
        <div class="list-item">I. Para obter informações e esclarecimento de dúvidas deve ser mantido contato com: SETOR DE ADESÃO 85 991141831 (WHATSAPP E TELEFONE).</div>

        <div class="paragraph" style="margin-top: 10px;">
            Por estarem justas e acertadas, as Parte firmam o presente Contrato em duas vias, de igual teor e forma, se obrigando a cumprir o que nele está avençado, na presença de duas testemunhas, que abaixo também subscrevem, para os fins pretendidos. E anexos referentes a esta adesão.
        </div>

        <div style="text-align: right; margin-top: 12px; font-weight: bold;">
            Fortaleza/CE, {{ now()->format('d') }} de {{ \Carbon\Carbon::now()->translatedFormat('F') }} de {{ now()->format('Y') }}.
        </div>

        <table class="contract-sig-table">
            <tr>
                <td>
                    @if($associado->assinatura && str_starts_with($associado->assinatura, 'data:image'))
                        <img src="{{ $associado->assinatura }}" class="signature-img" alt="Assinatura"><br>
                    @endif
                    <div class="signature-line" style="margin: 0 auto 4px auto; width: 80%;"></div>
                    <div style="font-weight: bold; font-size: 9px;">{{ $associado->nome }}</div>
                    <div style="font-size: 8px; color: #64748b; text-transform: uppercase;">ASSOCIADO CONTRATANTE</div>
                </td>
                <td>
                    @if(file_exists(public_path('images/assinatura_diretor.png')))
                        <img src="{{ public_path('images/assinatura_diretor.png') }}" class="signature-img" style="max-height: 55px; max-width: 220px;" alt="Assinatura Diretor"><br>
                    @else
                        <div style="height: 45px;"></div>
                    @endif
                    <div class="signature-line" style="margin: 0 auto 4px auto; width: 80%;"></div>
                    <div style="font-weight: bold; font-size: 9px;">CAIXA BENEFICENTE DOS MILITARES DO CEARÁ</div>
                    <div style="font-size: 8px; color: #64748b; text-transform: uppercase;">CONTRATADA / DIRETOR JURÍDICO</div>
                </td>
            </tr>
        </table>

        <div class="contract-witness-section">
            <strong>TESTEMUNHAS:</strong><br><br>
            1: <span class="contract-witness-line"></span><br><br>
            2: <span class="contract-witness-line"></span>
        </div>

        <div class="footer-banner">
            CABEMCE: Respeitando e cuidando das pessoas | Seu melhor investimento<br>
            Av. Domingos Olímpio, 1589, Bairro Farias Brito, Fortaleza/CE - CEP: 60.015-103 | CNPJ: 07.074.792/0001-98<br>
            @cabemce | (85) 3048.9964
        </div>
    @endif

</body>
</html>
