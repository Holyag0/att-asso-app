import { useState, useRef, ChangeEvent } from "react";
import { Head, useForm, usePage } from "@inertiajs/react";
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Checkbox } from "@/Components/ui/checkbox";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/Components/ui/select";
import {
  RadioGroup,
  RadioGroupItem,
} from "@/Components/ui/radio-group";
import { toast, Toaster } from "sonner";
import { Upload, Send, User, Briefcase, FileText, PenTool } from "lucide-react";
import { SignaturePad } from "@/Components/SignaturePad";
import { ESTADOS_CIVIS, POSTOS_PM_BM } from "@/types/form";
import ContratoCivil from "@/Pages/Associado/ContratoCivil";

const Signup = () => {
  const { data, setData, post, processing, errors } = useForm({
    nomeCompleto: "",
    dataNascimento: "",
    cpf: "",
    naturalidade: "",
    email: "",
    estadoCivil: "",
    telefone1: "",
    telefone2: "",
    cep: "",
    logradouro: "",
    numero: "",
    complemento: "",
    cidade: "",
    estado: "",
    corporacao: "PM",
    matricula: "",
    postoGraduacao: "",
    associadoCivil: "Não",
    rgFrente: "",
    rgFrenteName: "",
    rgVerso: "",
    rgVersoName: "",
    fotoAssociado: "",
    fotoAssociadoName: "",
    assinatura: "",
    autorizoInclusao: false,
    cienteLGPD: false,
  });

  const [loadingCep, setLoadingCep] = useState(false);
  const [showSuccessModal, setShowSuccessModal] = useState(false);
  const [showAgeModal, setShowAgeModal] = useState(false);
  const [ageModalInfo, setAgeModalInfo] = useState({ age: 0, limit: 0, isCivil: false });
  const [pdfUrl, setPdfUrl] = useState("");
  const [step, setStep] = useState(1);

  const calculateAge = (birthDateString) => {
    if (!birthDateString || birthDateString.length < 10) return null;
    const birthDate = new Date(birthDateString + "T00:00:00");
    if (isNaN(birthDate.getTime())) return null;
    const year = birthDate.getFullYear();
    if (year < 1900 || year > new Date().getFullYear()) return null;

    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    return age;
  };

  const checkAgeRestriction = (formData = data) => {
    const age = calculateAge(formData.dataNascimento);
    if (age !== null) {
      const isCivil = formData.associadoCivil === "Sim";
      const maxAge = isCivil ? 55 : 49;
      if (age > maxAge) {
        setAgeModalInfo({ age, limit: maxAge, isCivil });
        setShowAgeModal(true);
        return false;
      }
    }
    return true;
  };

  const rgFrenteRef = useRef(null);
  const rgVersoRef = useRef(null);
  const fotoAssociadoRef = useRef(null);

  const maskCPF = (v) =>
    v.replace(/\D/g, "").slice(0, 11)
      .replace(/(\d{3})(\d)/, "$1.$2")
      .replace(/(\d{3})(\d)/, "$1.$2")
      .replace(/(\d{3})(\d{1,2})$/, "$1-$2");

  const maskCEP = (v) =>
    v.replace(/\D/g, "").slice(0, 8).replace(/(\d{5})(\d)/, "$1-$2");

  const maskPhone = (v) =>
    v.replace(/\D/g, "").slice(0, 11)
      .replace(/(\d{2})(\d)/, "($1) $2")
      .replace(/(\d{5})(\d)/, "$1-$2");

  const handleCEPBlur = async () => {
    const cep = data.cep.replace(/\D/g, "");
    if (cep.length !== 8) return;
    try {
      setLoadingCep(true);
      const res = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
      const json = await res.json();
      if (json.erro) {
        toast.error("CEP não encontrado");
        return;
      }
      setData({
        ...data,
        logradouro: json.logradouro || "",
        cidade: json.localidade || "",
        estado: json.uf || "",
      });
      toast.success("Endereço preenchido");
    } catch {
      toast.error("Erro ao consultar CEP");
    } finally {
      setLoadingCep(false);
    }
  };

  const handleFile = (e, key) => {
    const file = e.target.files?.[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = () => {
      setData({
        ...data,
        [key]: reader.result,
        [`${key}Name`]: file.name,
      });
    };
    reader.readAsDataURL(file);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!checkAgeRestriction()) {
      return;
    }

    if (data.associadoCivil === "Sim") {
      setStep(2);
      window.scrollTo({ top: 0, behavior: "smooth" });
      return;
    }

    post(route('signup.store'), {
      onSuccess: (page) => {
        const flash = page.props.flash;
        if (flash && flash.success) {
          setPdfUrl(flash.pdf_url);
          setShowSuccessModal(true);
        } else {
          toast.success("Cadastro realizado com sucesso!");
        }
      },
      onError: (err) => {
        Object.values(err).forEach(e => toast.error(e));
      }
    });
  };

  if (step === 2) {
    return (
      <>
        <ContratoCivil
          initialData={data}
          onBack={(isSuccess, pdf_url) => {
            if (isSuccess) {
              setPdfUrl(pdf_url);
              setShowSuccessModal(true);
              setStep(1);
            } else {
              setStep(1);
              window.scrollTo({ top: 0, behavior: "smooth" });
            }
          }}
        />

        {/* Modal de Sucesso com Download de PDF */}
        {showSuccessModal && (
          <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-in fade-in duration-200">
            <div className="bg-white rounded-[2rem] shadow-2xl max-w-md w-full p-8 border border-sky-100 animate-in zoom-in-95 duration-200 text-center">
              <div className="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 text-emerald-600 mb-6">
                <svg className="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={3} d="M5 13l4 4L19 7" />
                </svg>
              </div>

              <h3 className="text-2xl font-bold text-sky-950 mb-2">
                Cadastro Concluído!
              </h3>

              <p className="text-sm text-slate-500 mb-8 leading-relaxed">
                Sua ficha e contrato de associação foram enviados com sucesso para a CABEMCE.
              </p>

              <div className="space-y-3">
                {pdfUrl && (
                  <a
                    href={pdfUrl}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="flex items-center justify-center w-full bg-emerald-600 hover:bg-emerald-700 text-white text-base font-bold h-14 rounded-xl shadow-lg transition-all active:scale-[0.98] gap-2"
                  >
                    <svg className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Baixar Meu Contrato (PDF)
                  </a>
                )}

                <button
                  type="button"
                  onClick={() => {
                    setShowSuccessModal(false);
                    window.location.reload();
                  }}
                  className="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-base font-bold h-14 rounded-xl transition-all"
                >
                  Concluir
                </button>
              </div>
            </div>
          </div>
        )}
      </>
    );
  }

  return (
    <div className="min-h-screen bg-white">
      <Head title="Ficha de Associação" />
      <Toaster position="top-right" />

      {/* Header */}
      <header className="bg-sky-700 text-white shadow-xl">
        <div className="container max-w-5xl mx-auto py-12 px-6">
          <div className="flex items-center gap-6">
            <div className="h-24 w-24 flex items-center justify-center">
              <img src="/images/logo.png" alt="CABEMCE Logo" className="h-full w-full object-contain" />
            </div>
            <div>
              <h1 className="text-3xl font-bold tracking-tight">CABEMCE</h1>
              <p className="text-lg opacity-80">Caixa Beneficente dos Militares do Ceará</p>
            </div>
          </div>
          <div className="mt-10">
            <h2 className="text-2xl font-semibold italic">Ficha de Associação Online</h2>
          </div>
        </div>
      </header>

      <main className="container max-w-5xl mx-auto py-12 px-6">
        {/* Instruções Gov.br */}
        <div className="bg-blue-50 border border-blue-200 rounded-[2rem] p-8 mb-8 shadow-sm flex flex-col md:flex-row gap-6 items-start">
          <div className="h-12 w-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md">
            <svg className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div className="space-y-2">
            <h4 className="text-lg font-bold text-blue-950">Quer assinar digitalmente pelo Gov.br?</h4>
            <p className="text-sm text-blue-900 leading-relaxed">
              Caso prefira assinar a sua ficha usando a assinatura eletrônica oficial do <strong>Gov.br</strong>, siga estes passos:
            </p>
            <ol className="list-decimal list-inside text-sm text-blue-900/80 space-y-1.5 pl-2">
              <li>Preencha todos os campos do formulário abaixo normalmente.</li>
              <li>Finalize o envio do cadastro e, no modal de confirmação, clique em <strong>"Baixar Minha Ficha (PDF)"</strong>.</li>
              <li>Acesse o portal de assinaturas digitais do <a href="https://assinador.iti.br/" target="_blank" rel="noopener noreferrer" className="underline font-bold text-blue-600 hover:text-blue-800">Gov.br</a> e assine o arquivo PDF baixado.</li>
              <li>Com o PDF assinado pelo Gov.br, entre em contato diretamente com o nosso <strong>setor de pecúlio</strong> para validar o seu documento.</li>
            </ol>
          </div>
        </div>

        <form onSubmit={handleSubmit} className="space-y-12">
          {/* SEÇÃO 1 */}
          <Section icon={<User />} title="1. Dados Pessoais">
            <Field label="Nome Completo *" full>
              <Input value={data.nomeCompleto} onChange={(e) => setData("nomeCompleto", e.target.value)} />
            </Field>
            <Field label="CPF *">
              <Input value={data.cpf} onChange={(e) => setData("cpf", maskCPF(e.target.value))} placeholder="000.000.000-00" />
            </Field>
            <Field label={`Data de Nascimento *${calculateAge(data.dataNascimento) !== null ? ` (${calculateAge(data.dataNascimento)} anos)` : ""}`}>
              <Input
                type="date"
                value={data.dataNascimento}
                onChange={(e) => {
                  const val = e.target.value;
                  setData("dataNascimento", val);
                  checkAgeRestriction({ ...data, dataNascimento: val });
                }}
              />
            </Field>
            <Field label="Estado Civil *">
              <Select value={data.estadoCivil} onValueChange={(v) => setData("estadoCivil", v)}>
                <SelectTrigger><SelectValue placeholder="Selecione" /></SelectTrigger>
                <SelectContent>
                  {ESTADOS_CIVIS.map((e) => <SelectItem key={e} value={e}>{e}</SelectItem>)}
                </SelectContent>
              </Select>
            </Field>
            <Field label="Naturalidade *">
              <Input value={data.naturalidade} onChange={(e) => setData("naturalidade", e.target.value)} placeholder="Ex.: Fortaleza/CE" />
            </Field>
            <Field label="E-mail *">
              <Input type="email" value={data.email} onChange={(e) => setData("email", e.target.value)} />
            </Field>
            <Field label="WhatsApp 1 *">
              <Input value={data.telefone1} onChange={(e) => setData("telefone1", maskPhone(e.target.value))} placeholder="(85) 99999-9999" />
            </Field>

            <div className="md:col-span-2 pt-4 border-t mt-4">
                <h4 className="text-sm font-bold text-sky-700 mb-4 uppercase tracking-wider">Endereço Residencial</h4>
            </div>
            <Field label="CEP *">
              <Input
                value={data.cep}
                onChange={(e) => setData("cep", maskCEP(e.target.value))}
                onBlur={handleCEPBlur}
                placeholder={loadingCep ? "Buscando..." : "00000-000"}
              />
            </Field>
            <Field label="Logradouro *">
              <Input value={data.logradouro} onChange={(e) => setData("logradouro", e.target.value)} />
            </Field>
            <Field label="Número *">
              <Input value={data.numero} onChange={(e) => setData("numero", e.target.value)} />
            </Field>
            <Field label="Bairro *">
              <Input value={data.bairro} onChange={(e) => setData("bairro", e.target.value)} />
            </Field>
            <Field label="Cidade *">
              <Input value={data.cidade} onChange={(e) => setData("cidade", e.target.value)} />
            </Field>
            <Field label="Estado *">
              <Input value={data.estado} maxLength={2} onChange={(e) => setData("estado", e.target.value.toUpperCase())} />
            </Field>
          </Section>

          {/* SEÇÃO 2 */}
          <Section icon={<Briefcase />} title="2. Tipo de Associado e Carreira">
            <Field label="É associado civil? *" full={data.associadoCivil === "Sim"}>
              <RadioGroup
                value={data.associadoCivil}
                onValueChange={(v) => {
                  setData("associadoCivil", v);
                  checkAgeRestriction({ ...data, associadoCivil: v });
                }}
                className="flex gap-8 pt-3"
              >
                <div className="flex items-center gap-2 cursor-pointer">
                  <RadioGroupItem value="Sim" id="sim" />
                  <Label htmlFor="sim" className="cursor-pointer font-semibold text-sky-900">Sim (Civil)</Label>
                </div>
                <div className="flex items-center gap-2 cursor-pointer">
                  <RadioGroupItem value="Não" id="nao" />
                  <Label htmlFor="nao" className="cursor-pointer font-semibold text-slate-700">Não (Militar)</Label>
                </div>
              </RadioGroup>
            </Field>

            {data.associadoCivil !== "Sim" && (
              <>
                <Field label="Corporação *">
                  <RadioGroup
                    value={data.corporacao}
                    onValueChange={(v) => setData("corporacao", v)}
                    className="flex gap-8 pt-3"
                  >
                    <div className="flex items-center gap-2 cursor-pointer">
                      <RadioGroupItem value="PM" id="pm" />
                      <Label htmlFor="pm" className="cursor-pointer">PM</Label>
                    </div>
                    <div className="flex items-center gap-2 cursor-pointer">
                      <RadioGroupItem value="BM" id="bm" />
                      <Label htmlFor="bm" className="cursor-pointer">CBM</Label>
                    </div>
                  </RadioGroup>
                </Field>
                <Field label="Número de Matrícula *">
                  <Input value={data.matricula} onChange={(e) => setData("matricula", e.target.value)} />
                </Field>
                <Field label="Posto / Graduação *">
                  <Select value={data.postoGraduacao} onValueChange={(v) => setData("postoGraduacao", v)}>
                    <SelectTrigger><SelectValue placeholder="Selecione" /></SelectTrigger>
                    <SelectContent>
                      {POSTOS_PM_BM.map((p) => <SelectItem key={p} value={p}>{p}</SelectItem>)}
                    </SelectContent>
                  </Select>
                </Field>
              </>
            )}
          </Section>

          {/* SEÇÃO 3 */}
          <Section icon={<FileText />} title="3. Envio de Documentos">
            <FileUpload
              label="Foto do Associado *"
              fileName={data.fotoAssociadoName}
              previewSrc={data.fotoAssociado}
              onClick={() => fotoAssociadoRef.current?.click()}
            />
            <input ref={fotoAssociadoRef} type="file" accept="image/*" className="hidden" onChange={(e) => handleFile(e, "fotoAssociado")} />

            <FileUpload
              label="RG - Frente *"
              fileName={data.rgFrenteName}
              previewSrc={data.rgFrente}
              onClick={() => rgFrenteRef.current?.click()}
            />
            <input ref={rgFrenteRef} type="file" accept="image/*" className="hidden" onChange={(e) => handleFile(e, "rgFrente")} />

            <FileUpload
              label="RG - Verso *"
              fileName={data.rgVersoName}
              previewSrc={data.rgVerso}
              onClick={() => rgVersoRef.current?.click()}
            />
            <input ref={rgVersoRef} type="file" accept="image/*" className="hidden" onChange={(e) => handleFile(e, "rgVerso")} />
          </Section>

          {/* SEÇÃO 4 */}
          <Section icon={<PenTool />} title="4. Assinatura">
            <div className="md:col-span-2">
              <p className="text-sm text-slate-500 mb-6">
                Desenhe sua assinatura na área abaixo.
              </p>
              <div className="bg-amber-50 border border-amber-200 text-amber-800 rounded-xl p-4 mb-6 flex gap-3 text-xs leading-relaxed">
                <svg className="h-5 w-5 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>
                  <strong>Atenção:</strong> A assinatura desenhada deve ser o mais semelhante possível com a assinatura que consta em seu documento de identidade (RG).
                </span>
              </div>
              <SignaturePad onChange={(v) => setData("assinatura", v)} />
            </div>
          </Section>

          {/* TERMOS */}
          <div className="bg-white rounded-3xl border border-slate-200 p-8 space-y-6 shadow-sm">
            <label className="flex gap-4 items-start cursor-pointer">
              <Checkbox
                checked={data.autorizoInclusao}
                onCheckedChange={(c) => setData("autorizoInclusao", !!c)}
                className="mt-1 h-6 w-6 border-sky-300 data-[state=checked]:bg-sky-700"
              />
              <span className="text-sm text-sky-800 leading-relaxed">
                Afirmo que as informações prestadas por mim, relativas a minha atualização cadastral de SÓCIO da CABEMCE, estão corretas e verdadeiras.
              </span>
            </label>
            <label className="flex gap-4 items-start cursor-pointer">
              <Checkbox
                checked={data.cienteLGPD}
                onCheckedChange={(c) => setData("cienteLGPD", !!c)}
                className="mt-1 h-6 w-6 border-sky-300 data-[state=checked]:bg-sky-700"
              />
              <span className="text-sm text-sky-800 leading-relaxed">
                Estou ciente de que estou amparado pela Lei Geral de Proteção de Dados Pessoais
              </span>
            </label>
          </div>

          <Button
            type="submit"
            disabled={processing}
            className="w-full bg-red-600 hover:bg-red-700 text-white text-lg h-16 rounded-2xl shadow-xl transition-all active:scale-[0.98]"
          >
            <Send className="mr-3 h-5 w-5" />
            {processing
              ? "Enviando..."
              : data.associadoCivil === "Sim"
              ? "Avançar para o Contrato de Associado Civil"
              : "Finalizar e Enviar Cadastro"}
          </Button>
        </form>
      </main>

      <footer className="py-12 text-center text-sm text-sky-700/50">
        © {new Date().getFullYear()} CABEMCE — Caixa Beneficente dos Militares do Ceará
      </footer>

      {/* Modal de Sucesso com Download de PDF */}
      {showSuccessModal && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-in fade-in duration-200">
          <div className="bg-white rounded-[2rem] shadow-2xl max-w-md w-full p-8 border border-sky-100 animate-in zoom-in-95 duration-200 text-center">
            <div className="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 text-emerald-600 mb-6">
              <svg className="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={3} d="M5 13l4 4L19 7" />
              </svg>
            </div>
            
            <h3 className="text-2xl font-bold text-sky-950 mb-2">
              Cadastro Concluído!
            </h3>
            
            <p className="text-sm text-slate-500 mb-8 leading-relaxed">
              Sua ficha de associação foi enviada com sucesso para a CABEMCE.
            </p>
            
            <div className="space-y-3">
              {pdfUrl && (
                <a
                  href={pdfUrl}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex items-center justify-center w-full bg-emerald-600 hover:bg-emerald-700 text-white text-base font-bold h-14 rounded-xl shadow-lg transition-all active:scale-[0.98] gap-2"
                >
                  <svg className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                  </svg>
                  Baixar Minha Ficha (PDF)
                </a>
              )}
              
              <button
                type="button"
                onClick={() => {
                  setShowSuccessModal(false);
                  window.location.reload();
                }}
                className="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-base font-bold h-14 rounded-xl transition-all"
              >
                Concluir
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Modal de Restrição de Idade */}
      {showAgeModal && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-in fade-in duration-200">
          <div className="bg-white rounded-[2rem] shadow-2xl max-w-md w-full p-8 border border-red-100 animate-in zoom-in-95 duration-200 text-center">
            <div className="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 text-red-600 mb-6">
              <svg className="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
            </div>
            
            <h3 className="text-2xl font-bold text-slate-900 mb-2">
              Limite de Idade Excedido
            </h3>
            
            <p className="text-sm text-slate-600 mb-6 leading-relaxed">
              Sua idade calculada é de <strong className="text-red-600 text-base">{ageModalInfo.age} anos</strong>.
            </p>

            <div className="bg-red-50 border border-red-200 rounded-2xl p-4 text-left mb-6 text-xs text-red-900 space-y-2">
              <p className="font-bold">Regras de limite de idade para cadastro:</p>
              <ul className="list-disc list-inside space-y-1">
                <li><strong>Associado Civil:</strong> limite de até 55 anos.</li>
                <li><strong>Associado Militar:</strong> limite de até 49 anos.</li>
              </ul>
              <p className="pt-1 text-slate-600">
                Como seu cadastro é de tipo <strong className="uppercase">{ageModalInfo.isCivil ? "Civil" : "Militar"}</strong>, o limite máximo permitido é de <strong>{ageModalInfo.limit} anos</strong>. Por este motivo, não é possível concluir a associação online.
              </p>
            </div>
            
            <button
              type="button"
              onClick={() => setShowAgeModal(false)}
              className="w-full bg-red-600 hover:bg-red-700 text-white text-base font-bold h-14 rounded-xl transition-all shadow-md active:scale-[0.98]"
            >
              Entendi
            </button>
          </div>
        </div>
      )}
    </div>
  );
};

const Section = ({ icon, title, children }) => (
  <section className="bg-white rounded-[2.5rem] border border-sky-100 shadow-xl overflow-hidden">
    <header className="bg-sky-700 text-white px-8 py-6 flex items-center gap-4">
      <div className="h-10 w-10 rounded-xl bg-white/10 flex items-center justify-center">{icon}</div>
      <h3 className="font-bold text-xl">{title}</h3>
    </header>
    <div className="grid grid-cols-1 md:grid-cols-2 gap-8 p-8 md:p-10">{children}</div>
  </section>
);

const Field = ({ label, children, full }) => (
  <div className={full ? "md:col-span-2 space-y-3" : "space-y-3"}>
    <Label className="text-sm font-bold text-sky-800 ml-1">{label}</Label>
    {children}
  </div>
);

const FileUpload = ({ label, fileName, previewSrc, onClick }) => (
  <div className="space-y-3">
    <Label className="text-sm font-bold text-sky-800 ml-1">{label}</Label>
    <button
      type="button"
      onClick={onClick}
      className="w-full border-2 border-dashed border-sky-100 rounded-3xl p-6 hover:border-sky-300 hover:bg-sky-50 transition-all flex flex-col items-center gap-3 min-h-[160px] justify-center"
    >
      {previewSrc ? (
        <>
          <img src={previewSrc} alt={fileName} className="max-h-28 rounded-xl shadow-md" />
          <span className="text-xs font-semibold text-slate-400 truncate max-w-full px-4">{fileName}</span>
        </>
      ) : (
        <>
          <div className="h-12 w-12 rounded-full bg-slate-100 flex items-center justify-center">
            <Upload className="h-6 w-6 text-slate-400" />
          </div>
          <span className="text-sm font-bold text-slate-400">Selecionar Imagem</span>
        </>
      )}
    </button>
  </div>
);

export default Signup;
