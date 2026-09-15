import React, { useState } from "react";
import { Head, useForm } from "@inertiajs/react";
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Checkbox } from "@/Components/ui/checkbox";
import { toast, Toaster } from "sonner";
import { Send, ArrowLeft, FileCheck, UserPlus, ShieldCheck } from "lucide-react";

const ContratoCivil = ({ initialData, onBack }) => {
  const { data, setData, post, processing } = useForm({
    ...initialData,
    contatoAdicionalNome: initialData.contatoAdicionalNome || "",
    contatoAdicionalEndereco: initialData.contatoAdicionalEndereco || "",
    contatoAdicionalBairro: initialData.contatoAdicionalBairro || "",
    contatoAdicionalCidade: initialData.contatoAdicionalCidade || "",
    contatoAdicionalEstado: initialData.contatoAdicionalEstado || "",
    contatoAdicionalTelefone: initialData.contatoAdicionalTelefone || "",
    aceitouContratoCivil: false,
  });

  const handleSubmitContrato = (e) => {
    e.preventDefault();
    if (!data.aceitouContratoCivil) {
      toast.error("Você precisa aceitar os termos do Contrato de Adesão de Associado Civil para prosseguir.");
      return;
    }

    post(route("signup.store"), {
      onSuccess: (page) => {
        const flash = page.props.flash;
        if (flash && flash.success) {
          if (onBack) onBack(true, flash.pdf_url);
        } else {
          toast.success("Contrato e Ficha enviados com sucesso!");
        }
      },
      onError: (err) => {
        Object.values(err).forEach((e) => toast.error(e));
      },
    });
  };

  return (
    <div className="min-h-screen bg-slate-50 py-12 px-4 sm:px-6">
      <Head title="Contrato de Adesão de Associado Civil" />
      <Toaster position="top-right" />

      <div className="max-w-4xl mx-auto space-y-8">
        {/* Header */}
        <header className="bg-sky-800 text-white rounded-[2rem] p-8 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
          <div className="flex items-center gap-5">
            <div className="h-16 w-16 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
              <FileCheck className="h-8 w-8 text-white" />
            </div>
            <div>
              <span className="text-xs uppercase tracking-widest text-sky-200 font-bold">Etapa 2 de 2</span>
              <h1 className="text-2xl sm:text-3xl font-bold">Contrato de Associado Civil</h1>
              <p className="text-sm text-sky-100/80">Confirme seus dados e leia as cláusulas de adesão à CABEMCE</p>
            </div>
          </div>
          <Button
            type="button"
            variant="outline"
            onClick={onBack}
            className="bg-white/10 border-white/20 hover:bg-white/20 text-white shrink-0"
          >
            <ArrowLeft className="mr-2 h-4 w-4" /> Voltar à Ficha
          </Button>
        </header>

        <form onSubmit={handleSubmitContrato} className="space-y-8">
          {/* Card: Dados do Contratante (Auto-preenchidos) */}
          <div className="bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm space-y-6">
            <div className="flex items-center gap-3 border-b border-slate-100 pb-4">
              <UserPlus className="h-6 w-6 text-sky-700" />
              <h2 className="text-xl font-bold text-slate-900">Dados do Contratante (Auto-preenchidos)</h2>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-sm bg-sky-50/50 p-6 rounded-2xl border border-sky-100">
              <div>
                <span className="block text-xs font-bold text-slate-400 uppercase">Nome Completo</span>
                <span className="font-semibold text-slate-800 text-base">{data.nomeCompleto || "-"}</span>
              </div>
              <div>
                <span className="block text-xs font-bold text-slate-400 uppercase">CPF</span>
                <span className="font-semibold text-slate-800">{data.cpf || "-"}</span>
              </div>
              <div>
                <span className="block text-xs font-bold text-slate-400 uppercase">Naturalidade</span>
                <span className="font-semibold text-slate-800">{data.naturalidade || "-"}</span>
              </div>
              <div>
                <span className="block text-xs font-bold text-slate-400 uppercase">E-mail</span>
                <span className="font-semibold text-slate-800">{data.email || "-"}</span>
              </div>
              <div>
                <span className="block text-xs font-bold text-slate-400 uppercase">Telefone / WhatsApp</span>
                <span className="font-semibold text-slate-800">{data.telefone1 || "-"}</span>
              </div>
              <div>
                <span className="block text-xs font-bold text-slate-400 uppercase">CEP</span>
                <span className="font-semibold text-slate-800">{data.cep || "-"}</span>
              </div>
              <div className="md:col-span-2 lg:col-span-3">
                <span className="block text-xs font-bold text-slate-400 uppercase">Endereço Residencial</span>
                <span className="font-semibold text-slate-800">
                  {data.logradouro}, Nº {data.numero} {data.complemento ? `(${data.complemento})` : ""} - Bairro: {data.bairro} - {data.cidade}/{data.estado}
                </span>
              </div>
            </div>

            {/* Contato Adicional */}
            <div className="pt-4 border-t border-slate-100 space-y-4">
              <h3 className="text-base font-bold text-slate-800">Contato Adicional (Opcional)</h3>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label className="text-xs font-bold text-slate-600">Nome do Contato Adicional</Label>
                  <Input
                    value={data.contatoAdicionalNome}
                    onChange={(e) => setData("contatoAdicionalNome", e.target.value)}
                    placeholder="Nome completo do contato"
                  />
                </div>
                <div className="space-y-2">
                  <Label className="text-xs font-bold text-slate-600">Telefone do Contato Adicional</Label>
                  <Input
                    value={data.contatoAdicionalTelefone}
                    onChange={(e) => setData("contatoAdicionalTelefone", e.target.value)}
                    placeholder="(85) 99999-9999"
                  />
                </div>
                <div className="space-y-2 md:col-span-2">
                  <Label className="text-xs font-bold text-slate-600">Endereço do Contato Adicional</Label>
                  <Input
                    value={data.contatoAdicionalEndereco}
                    onChange={(e) => setData("contatoAdicionalEndereco", e.target.value)}
                    placeholder="Logradouro, número, complemento"
                  />
                </div>
                <div className="space-y-2">
                  <Label className="text-xs font-bold text-slate-600">Bairro</Label>
                  <Input
                    value={data.contatoAdicionalBairro}
                    onChange={(e) => setData("contatoAdicionalBairro", e.target.value)}
                    placeholder="Bairro"
                  />
                </div>
                <div className="grid grid-cols-3 gap-2">
                  <div className="col-span-2 space-y-2">
                    <Label className="text-xs font-bold text-slate-600">Cidade</Label>
                    <Input
                      value={data.contatoAdicionalCidade}
                      onChange={(e) => setData("contatoAdicionalCidade", e.target.value)}
                      placeholder="Cidade"
                    />
                  </div>
                  <div className="space-y-2">
                    <Label className="text-xs font-bold text-slate-600">UF</Label>
                    <Input
                      value={data.contatoAdicionalEstado}
                      maxLength={2}
                      onChange={(e) => setData("contatoAdicionalEstado", e.target.value.toUpperCase())}
                      placeholder="CE"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Card: Cláusulas do Contrato */}
          <div className="bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm space-y-6">
            <div className="flex items-center gap-3 border-b border-slate-100 pb-4">
              <ShieldCheck className="h-6 w-6 text-sky-700" />
              <h2 className="text-xl font-bold text-slate-900">Cláusulas do Contrato de Adesão</h2>
            </div>

            <div className="max-h-96 overflow-y-auto pr-4 text-xs text-slate-600 space-y-4 leading-relaxed bg-slate-50 p-6 rounded-2xl border border-slate-200">
              <div className="font-bold text-slate-900 text-center text-sm uppercase">
                CONTRATO DE ADESÃO DE ASSOCIADO CIVIL NA CABEMCE
              </div>

              <div>
                <strong className="text-slate-900">CONTRATADA:</strong> CAIXA BENEFICENTE DOS MILITARES DO CEARÁ, com sede na Av. Domingos Olímpio, 1589, Farias Brito, Fortaleza/CE, CNPJ 07.074.792/0001-98.
              </div>

              <div>
                <strong className="text-slate-900 font-bold block mb-1">CLÁUSULA PRIMEIRA – DA ADESÃO</strong>
                I. O CONTRATANTE ASSOCIADO de modo livre, informado e inequívoco declara que ao se ASSOCIAR A CABEMCE, conhece as condições e os DIREITOS DO ASSOCIADO da Caixa Beneficente dos Militares do Ceará (CABEMCE), as quais aceita de livre e espontânea vontade.<br />
                II. O presente contrato é de adesão, bilateral, gerando direitos e obrigações para ambas as partes.
              </div>

              <div>
                <strong className="text-slate-900 font-bold block mb-1">CLÁUSULA SEGUNDA – DO OBJETO</strong>
                I. O presente contrato tem por objeto a ADESÃO DO CONTRATANTE COMO ASSOCIADO CIVIL DA CABEMCE, com direito aos benefícios oferecidos, com exceção dos benefícios previstos no Artigos 41 e 43 do Estatuto Social da Cabemce.<br />
                II. A vigência do presente Contrato tem início na data de sua assinatura, tendo vigência indeterminada, podendo ser rescindido pela parte CONTRATANTE, a qualquer momento, mediante envio prévio de comunicação a CONTRATADA, com antecedência mínima de 30 (trinta) dias, sendo observado o pagamento de mensalidades vencidas e outros débitos.
              </div>

              <div>
                <strong className="text-slate-900 font-bold block mb-1">CLÁUSULA TERCEIRA – DAS OBRIGAÇÕES DO CONTRATANTE</strong>
                I. O CONTRATANTE, tem o conhecimento da obrigação de efetuar o pagamento das mensalidades da Instituição e do Plano de Saúde em dia, cuja inadimplência, por mais de 90 (noventa) dias, acarretará o cancelamento do mesmo, independente de aviso ou notificação.<br />
                II. O CONTRATANTE, pagará a mensalidade no valor de R$ 54,00 (cinquenta e quatro reais) a partir do mês da sua inscrição, como associado(a) civil, e terá direito aos benefícios previstos na cláusula segunda do presente contrato, reajustado anualmente pelo IGPM ou outro que o venha substituir.<br />
                III. É obrigação do CONTRATANTE como associado comunicar formalmente, solicitando a atualização, de quaisquer alterações dos dados cadastrais, inclusive mudança de endereço, sendo que se assim não proceder estará isentando a CONTRATADA de qualquer responsabilidade ou consequência por falta de comunicação.
              </div>

              <div>
                <strong className="text-slate-900 font-bold block mb-1">CLÁUSULA QUARTA – DAS OBRIGAÇÕES DA CONTRATADA</strong>
                I. A CONTRATADA fica obrigada a dar conhecimento ao CONTRATANTE das informações sobre a situação financeira dos pagamentos.<br />
                II. A CONTRATADA se obriga a informar previamente ao CONTRATANTE sobre toda e qualquer anormalidade no pagamento que possa influir negativamente no Contrato.<br />
                III. A CONTRATADA se obriga a fornecer canais de comunicação para o CONTRATANTE apresentar solicitações.<br />
                IV. A CONTRATADA, colocará a disposição do associados serviços disponíveis na CABEMCE conforme relação abaixo:<br />
                &nbsp;&nbsp;01 – Serviços Jurídicos nas áreas ADMINISTRATIVAS, CIVIL e CRIMINAL;<br />
                &nbsp;&nbsp;02 – Creche Escola Tiradentes, para filhos de 02 (dois) a 05 (cinco) anos;<br />
                &nbsp;&nbsp;03 – Compras na Loja Cabemce com 15% (quinze por cento) de desconto;<br />
                &nbsp;&nbsp;04 – Planos de Saúde e Participação em Convênios celebrados pela Instituição.
              </div>

              <div>
                <strong className="text-slate-900 font-bold block mb-1">CLÁUSULA QUINTA – DO PAGAMENTO</strong>
                I. A CONTRATANTE se obriga a realizar o pagamento da mensalidade, até o dia 10(dez) de cada mês.<br />
                II. Na ocorrência de falta ou atraso no pagamento, a CONTRATANTE, entrará em contato com o devedor para realizar o pagamento da mensalidade.<br />
                III. O atraso no pagamento da mensalidade do associado, poderá acarretar cobrança extrajudicial e/ou judicial, e inclusão do nome do CONTRATANTE nos Órgãos de Proteção ao Crédito.<br />
                IV. A falta de pagamento da mensalidade de associado da CABEMCE por 3 (três meses) consecutivos ou não, implica no desligamento do quadro de associados e consequentemente no cancelamento do contrato, de acordo com as Normas Estatutárias e Contratuais da CABEMCE.<br />
                V. A extinção do vínculo de Associado CONTRATANTE com CONTRATADA não extingue a responsabilidade com as mensalidades não pagas, arcando o CONTRATANTE integralmente com os débitos existentes.
              </div>

              <div>
                <strong className="text-slate-900 font-bold block mb-1">CLÁUSULA SEXTA – DAS COMUNICAÇÕES</strong>
                I. As comunicações com a CONTRATADA poderão ser feitas por meio de Telefone (85) 3048.9964, correio eletrônico, Mensagem Eletrônica, ou presencialmente na Sede da CONTRATADA.
              </div>

              <div>
                <strong className="text-slate-900 font-bold block mb-1">CLÁUSULA SÉTIMA – DA PROTEÇÃO DE DADOS PESSOAIS (LGPD)</strong>
                I. O CONTRATANTE, em decorrência do presente instrumento e para o bom andamento da prestação dos serviços declara EXPRESSO CONSENTIMENTO e AUTORIZA a coleta, tratamento e armazenamento dos dados obtidos por parte da CONTRATADA.<br />
                II. A CONTRATADA, na condição de CONTROLADORA, obriga-se a atuar em conformidade com a Lei nº 13.709/2018, Lei Geral de Proteção de Dados (LGPD), visando proteger os dados pessoais do associado, coletados exclusivamente para os fins de administração e execução deste Contrato.<br />
                III. A CONTRATADA compromete-se a tratar os dados pessoais obtidos com o CONTRATANTE de acordo com as bases legais previstas nas hipóteses dos Arts. 7º, 11 e/ou 14 da Lei 13.709/2018, para propósitos legítimos, específicos, explícitos e informados ao Titular desses Dados Pessoais.<br />
                IV. O CONTRATANTE consente de modo livre, e inequívoco, para a garantia da execução deste contrato, que a CONTRATADA possa realizar o compartilhamento de dados pessoais, com instituições financeiras, Empresas Cobrança e/ou Postagem, e a Operadora do Plano de Saúde contratado, conforme a Lei Nº 13.709/2018 (LGPD).
              </div>

              <div>
                <strong className="text-slate-900 font-bold block mb-1">CLÁUSULA OITAVA – DAS INFORMAÇÕES E ESCLARECIMENTOS</strong>
                I. Para obter informações e esclarecimento de dúvidas deve ser mantido contato com: SETOR DE ADESÃO 85 991141831 (WHATSAPP E TELEFONE).
              </div>
            </div>

            {/* Aceite dos termos */}
            <div className="pt-4 border-t border-slate-100">
              <label className="flex items-start gap-4 cursor-pointer bg-sky-50/80 p-5 rounded-2xl border border-sky-200">
                <Checkbox
                  checked={data.aceitouContratoCivil}
                  onCheckedChange={(c) => setData("aceitouContratoCivil", !!c)}
                  className="mt-1 h-6 w-6 border-sky-400 data-[state=checked]:bg-sky-700"
                />
                <span className="text-sm font-semibold text-sky-950 leading-relaxed">
                  Li, estou ciente e aceito integralmente os termos do Contrato de Adesão de Associado Civil da CABEMCE.
                </span>
              </label>
            </div>
          </div>

          {/* Botões de ação */}
          <div className="flex flex-col sm:flex-row gap-4">
            <Button
              type="button"
              variant="outline"
              onClick={onBack}
              className="w-full sm:w-1/3 h-16 rounded-2xl border-slate-300 font-bold text-slate-700"
            >
              <ArrowLeft className="mr-2 h-5 w-5" /> Alterar Ficha
            </Button>
            <Button
              type="submit"
              disabled={processing}
              className="w-full sm:w-2/3 bg-emerald-600 hover:bg-emerald-700 text-white text-lg h-16 rounded-2xl shadow-xl transition-all active:scale-[0.98]"
            >
              <Send className="mr-3 h-5 w-5" />
              {processing ? "Finalizando..." : "Confirmar e Finalizar Cadastro"}
            </Button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default ContratoCivil;
