export interface AssociateFormData {
  // Dados Pessoais
  nomeCompleto: string;
  dataNascimento: string;
  cpf: string;
  naturalidade: string;
  email: string;
  estadoCivil: string;
  telefone1: string;
  telefone2: string;
  cep: string;
  logradouro: string;
  numero: string;
  complemento: string;
  cidade: string;
  estado: string;
  // Carreira
  corporacao: string;
  matricula: string;
  postoGraduacao: string;
  associadoCivil: string;
  // Documentos
  rgFrente: string; // base64
  rgFrenteName: string;
  rgVerso: string;
  rgVersoName: string;
  fotoAssociado: string;
  fotoAssociadoName: string;
  // Assinatura
  assinatura: string; // base64
  // Termos
  autorizoInclusao: boolean;
  cienteLGPD: boolean;
}

export const POSTOS_PM_BM = [
  "Soldado",
  "Cabo",
  "3º Sargento",
  "2º Sargento",
  "1º Sargento",
  "Subtenente",
  "Aspirante a Oficial",
  "2º Tenente",
  "1º Tenente",
  "Capitão",
  "Major",
  "Tenente-Coronel",
  "Coronel",
];

export const ESTADOS_CIVIS = [
  "Solteiro(a)",
  "Casado(a)",
  "Divorciado(a)",
  "Viúvo(a)",
  "União Estável",
  "Separado(a)",
];
