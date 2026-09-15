<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CONTRATO DE ASSOCIADO CIVIL - {{ $associado->nome }}</title>
    <style>
        @page {
            margin: 25px 35px 35px 35px;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
            color: #000;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header-logo {
            max-height: 60px;
            margin-bottom: 4px;
        }
        .header-title {
            font-size: 11px;
            font-weight: bold;
            margin: 1px 0;
        }
        .header-subtitle {
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
            text-indent: 0;
        }
        .underline-value {
            border-bottom: 1px solid #000;
            display: inline-block;
            padding: 0 4px;
            font-weight: bold;
        }
        .clause-title {
            font-weight: bold;
            font-size: 10px;
            margin-top: 10px;
            margin-bottom: 3px;
            text-transform: uppercase;
        }
        .list-item {
            margin-bottom: 3px;
            text-align: justify;
        }
        .signature-table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse;
        }
        .signature-table td {
            vertical-align: bottom;
            text-align: center;
            width: 50%;
            padding: 0 15px;
        }
        .signature-img {
            max-height: 50px;
            max-width: 180px;
            margin-bottom: -5px;
        }
        .signature-line {
            border-top: 1px solid #000;
            padding-top: 4px;
            font-size: 9px;
            font-weight: bold;
        }
        .witness-section {
            margin-top: 20px;
            font-size: 9px;
        }
        .witness-line {
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

    <!-- Header Oficial -->
    <div class="header">
        @if(file_exists(public_path('images/logo.png')))
            <img src="{{ public_path('images/logo.png') }}" class="header-logo" alt="Logo CABEMCE"><br>
        @endif
        <div class="header-title">Caixa Beneficente dos Militares do Ceará</div>
        <div class="header-subtitle">Diretoria Administrativa e Financeira</div>
        <div class="header-subtitle">Setor de Plano de Saúde - 1</div>
    </div>

    <!-- Título do Contrato -->
    <div class="contract-main-title">
        CONTRATO DE ADESÃO DE ASSOCIADO CIVIL NA CABEMCE
    </div>

    <!-- Qualificação Contratada -->
    <div class="paragraph">
        Pelo presente Contrato, de um lado na qualidade de <strong>CONTRATADA: CAIXA BENEFICENTE DOS MILITARES DO CEARÁ</strong>, com sede Avenida Domingos Olímpio, 1589, Farias Brito, Fortaleza/CE, Brasil, CEP 60.191-070 e CNPJ 07.074.792/0001-98, denominada de Controladora para fins da Lei nº 13.709/2018 - Lei Geral de Proteção de Dados.
    </div>

    <!-- Qualificação Contratante -->
    <div class="paragraph">
        <strong>Do outro lado na qualidade de CONTRATANTE:</strong><br>
        Nome: <span class="underline-value" style="width: 320px;">{{ $associado->nome }}</span>, Nacionalidade: <span class="underline-value" style="width: 120px;">{{ $associado->naturalidade ?? 'Brasileira' }}</span>,<br>
        CPF nº: <span class="underline-value" style="width: 160px;">{{ $associado->cpf }}</span>, residente e domiciliado na <span class="underline-value" style="width: 280px;">{{ $associado->logradouro }}, Nº {{ $associado->numero }} {{ $associado->complemento }}</span>,<br>
        Bairro: <span class="underline-value" style="width: 130px;">{{ $associado->bairro }}</span>, Cidade: <span class="underline-value" style="width: 130px;">{{ $associado->cidade }}</span>, Estado: <span class="underline-value" style="width: 30px;">{{ $associado->estado }}</span>, CEP: <span class="underline-value" style="width: 80px;">{{ $associado->cep }}</span>,<br>
        Correio Eletrônico (<em>e-mail</em>): <span class="underline-value" style="width: 380px;">{{ $associado->email }}</span>,<br>
        Telefones: <span class="underline-value" style="width: 200px;">{{ $associado->telefone_whatsapp }}</span>.
    </div>

    <!-- Contato Adicional -->
    <div class="paragraph">
        <strong>CONTATO ADICIONAL:</strong><br>
        Nome: <span class="underline-value" style="width: 340px;">{{ $associado->contato_adicional_nome ?? '________________________________________' }}</span>, Endereço: <span class="underline-value" style="width: 180px;">{{ $associado->contato_adicional_endereco ?? '___________________' }}</span>,<br>
        Bairro: <span class="underline-value" style="width: 110px;">{{ $associado->contato_adicional_bairro ?? '____________' }}</span>, Cidade: <span class="underline-value" style="width: 110px;">{{ $associado->contato_adicional_cidade ?? '____________' }}</span>, Estado: <span class="underline-value" style="width: 30px;">{{ $associado->contato_adicional_estado ?? '__' }}</span>, Telefone: <span class="underline-value" style="width: 120px;">{{ $associado->contato_adicional_telefone ?? '____________' }}</span>.
    </div>

    <div class="paragraph" style="margin-top: 10px;">
        Firmam o presente <strong>CONTRATO DE INCLUSÃO COMO ASSOCIADO CIVIL DA CABEMCE</strong>, mediante as condições insertas nas cláusulas que se seguem:
    </div>

    <!-- Cláusulas -->
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
    <div class="list-item">III. A CONTRATADA compromete-se a tratar os dados pessoais obtidos com o CONTRATANTE de acordo com as bases legais previstas na Lei 13.709/2018.</div>
    <div class="list-item">IV. O CONTRATANTE consente de modo livre, e inequívoco, para a garantia da execução deste contrato, que a CONTRATADA possa realizar o compartilhamento de dados pessoais, com instituições financeiras, Empresas Cobrança e/ou Postagem, e a Operadora do Plano de Saúde contratado, conforme a Lei Nº 13.709/2018 (LGPD).</div>

    <div class="clause-title">CLÁUSULA OITAVA – DAS INFORMAÇÕES E ESCLARECIMENTOS</div>
    <div class="list-item">I. Para obter informações e esclarecimento de dúvidas deve ser mantido contato com: SETOR DE ADESÃO 85 991141831 (WHATSAPP E TELEFONE).</div>

    <div class="paragraph" style="margin-top: 10px;">
        Por estarem justas e acertadas, as Parte firmam o presente Contrato em duas vias, de igual teor e forma, se obrigando a cumprir o que nele está avençado, na presença de duas testemunhas, que abaixo também subscrevem, para os fins pretendidos. E anexos referentes a esta adesão.
    </div>

    <div style="text-align: right; margin-top: 15px; font-weight: bold;">
        Fortaleza/CE, {{ now()->format('d') }} de {{ \Carbon\Carbon::now()->translatedFormat('F') }} de {{ now()->format('Y') }}.
    </div>

    <!-- Bloco de Assinaturas -->
    <table class="signature-table">
        <tr>
            <td>
                @if($associado->assinatura && str_starts_with($associado->assinatura, 'data:image'))
                    <img src="{{ $associado->assinatura }}" class="signature-img" alt="Assinatura"><br>
                @endif
                <div class="signature-line">
                    {{ $associado->nome }}<br>
                    ASSOCIADO CONTRATANTE
                </div>
            </td>
            <td>
                <div class="signature-line" style="margin-top: 45px;">
                    CAIXA BENEFICENTE DOS MILITARES DO CEARÁ<br>
                    CONTRATADA
                </div>
            </td>
        </tr>
    </table>

    <div class="witness-section">
        <strong>TESTEMUNHAS:</strong><br><br>
        1: <span class="witness-line"></span><br><br>
        2: <span class="witness-line"></span>
    </div>

    <div class="footer-banner">
        CABEMCE: Respeitando e cuidando das pessoas | Seu melhor investimento<br>
        Av. Domingos Olímpio, 1589, Bairro Farias Brito, Fortaleza/CE - CEP: 60.015-103 | CNPJ: 07.074.792/0001-98<br>
        @cabemce | (85) 3048.9964
    </div>

</body>
</html>
