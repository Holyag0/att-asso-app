import React, { useEffect, useRef } from "react";
import { Head, Link } from "@inertiajs/react";
import { UserPlus, RefreshCw, Shield, FileText, ArrowRight, CheckCircle2 } from "lucide-react";

export default function Welcome() {
  const canvasRef = useRef(null);

  useEffect(() => {
    const canvas = canvasRef.current;
    if (!canvas) return;

    const ctx = canvas.getContext("2d");
    if (!ctx) return;

    let animationFrameId;
    let width = (canvas.width = window.innerWidth);
    let height = (canvas.height = window.innerHeight);

    const handleResize = () => {
      if (!canvas) return;
      width = canvas.width = window.innerWidth;
      height = canvas.height = window.innerHeight;
    };

    window.addEventListener("resize", handleResize);

    // Dynamic particles with floating nodes
    const particleCount = Math.min(Math.floor(width / 22), 65);
    const particles = Array.from({ length: particleCount }, () => ({
      x: Math.random() * width,
      y: Math.random() * height,
      vx: (Math.random() - 0.5) * 0.7,
      vy: (Math.random() - 0.5) * 0.7,
      radius: Math.random() * 2.5 + 1.2,
      alpha: Math.random() * 0.5 + 0.2,
      color: Math.random() > 0.4 ? "#0284c7" : Math.random() > 0.5 ? "#059669" : "#0369a1",
    }));

    const render = () => {
      ctx.clearRect(0, 0, width, height);

      // Gradient background glow
      const grad = ctx.createRadialGradient(
        width * 0.5,
        height * 0.3,
        100,
        width * 0.5,
        height * 0.5,
        Math.max(width, height)
      );
      grad.addColorStop(0, "rgba(240, 249, 255, 0.9)");
      grad.addColorStop(0.5, "rgba(224, 242, 254, 0.6)");
      grad.addColorStop(1, "rgba(248, 250, 252, 1)");
      ctx.fillStyle = grad;
      ctx.fillRect(0, 0, width, height);

      // Render particle connections
      for (let i = 0; i < particles.length; i++) {
        const p1 = particles[i];

        p1.x += p1.vx;
        p1.y += p1.vy;

        if (p1.x < 0 || p1.x > width) p1.vx *= -1;
        if (p1.y < 0 || p1.y > height) p1.vy *= -1;

        // Draw particle
        ctx.beginPath();
        ctx.arc(p1.x, p1.y, p1.radius, 0, Math.PI * 2);
        ctx.fillStyle = p1.color;
        ctx.globalAlpha = p1.alpha;
        ctx.fill();

        for (let j = i + 1; j < particles.length; j++) {
          const p2 = particles[j];
          const dx = p1.x - p2.x;
          const dy = p1.y - p2.y;
          const dist = Math.sqrt(dx * dx + dy * dy);

          if (dist < 130) {
            ctx.beginPath();
            ctx.moveTo(p1.x, p1.y);
            ctx.lineTo(p2.x, p2.y);
            ctx.strokeStyle = "#0284c7";
            ctx.globalAlpha = (1 - dist / 130) * 0.22;
            ctx.lineWidth = 0.8;
            ctx.stroke();
          }
        }
      }
      ctx.globalAlpha = 1.0;

      animationFrameId = requestAnimationFrame(render);
    };

    render();

    return () => {
      window.removeEventListener("resize", handleResize);
      cancelAnimationFrame(animationFrameId);
    };
  }, []);

  return (
    <div className="relative min-h-screen font-sans antialiased text-slate-800 overflow-x-hidden">
      <Head title="CABEMCE - Portal de Adesão e Atualização Cadastral" />

      {/* HTML5 Canvas Background */}
      <canvas
        ref={canvasRef}
        className="fixed inset-0 pointer-events-none z-0"
      />

      {/* Main Layer */}
      <div className="relative z-10 min-h-screen flex flex-col justify-between">
        {/* Header Navigation */}
        <header className="w-full backdrop-blur-md bg-white/70 border-b border-sky-100/80 sticky top-0 z-20 shadow-sm transition-all">
          <div className="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <div className="flex items-center gap-4">
              <div className="h-14 w-14 rounded-2xl bg-white p-1.5 shadow-md border border-sky-100 flex items-center justify-center shrink-0">
                <img
                  src="/images/logo.png"
                  alt="CABEMCE Logo"
                  className="h-full w-full object-contain"
                />
              </div>
              <div>
                <h1 className="text-xl font-extrabold text-sky-950 tracking-tight leading-none">
                  CABEMCE
                </h1>
                <p className="text-xs font-semibold text-sky-700 tracking-wide mt-1">
                  Caixa Beneficente dos Militares do Ceará
                </p>
              </div>
            </div>

            <a
              href="https://cabemce.com.br"
              target="_blank"
              rel="noreferrer"
              className="hidden sm:inline-flex items-center text-xs font-bold text-sky-800 bg-sky-50 hover:bg-sky-100 px-4 py-2.5 rounded-xl border border-sky-200/80 transition-all hover:shadow-sm"
            >
              Site Oficial CABEMCE
            </a>
          </div>
        </header>

        {/* Hero & Cards Content */}
        <main className="max-w-6xl mx-auto px-6 py-12 flex-1 flex flex-col justify-center">
          {/* Header Title Section */}
          <div className="text-center max-w-3xl mx-auto space-y-4 mb-14">
            <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-100/80 border border-sky-200 text-sky-900 text-xs font-bold tracking-wide uppercase shadow-sm">
              <CheckCircle2 className="w-4 h-4 text-emerald-600" />
              <span>Portal de Atendimento Eletrônico</span>
            </div>

            <h2 className="text-3xl sm:text-5xl font-black text-sky-950 tracking-tight leading-tight">
              Selecione a opção desejada para a sua ficha
            </h2>

            <p className="text-slate-600 text-base sm:text-lg leading-relaxed font-normal">
              Escolha abaixo a opção correspondente ao seu perfil para preencher a sua{" "}
              <strong className="text-sky-900 font-semibold">Ficha de Inclusão/Adesão</strong> ou realizar a{" "}
              <strong className="text-sky-900 font-semibold">Atualização Cadastral</strong>.
            </p>
          </div>

          {/* 4 Primary Service Cards Grid */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto w-full">
            {/* CARD 1: ADESÃO CIVIL */}
            <Link
              href={route("associados.adesao.civil")}
              className="group relative bg-white/80 backdrop-blur-md rounded-[2.5rem] p-8 border border-emerald-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden"
            >
              <div className="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500" />

              <div>
                <div className="flex items-center justify-between mb-6">
                  <div className="h-16 w-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 shadow-inner group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                    <UserPlus className="w-8 h-8" />
                  </div>
                  <span className="px-3.5 py-1.5 rounded-full bg-emerald-100/80 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                    Civil • Novo Cadastro
                  </span>
                </div>

                <h3 className="text-2xl font-bold text-slate-900 mb-2 group-hover:text-emerald-700 transition-colors">
                  Ficha de Adesão (Civil)
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed mb-6">
                  Inscrição para novos sócios civis com preenchimento da ficha e emissão automática do <strong>Contrato de Adesão Civil</strong>.
                </p>
              </div>

              <div className="flex items-center justify-between pt-4 border-t border-slate-100 text-emerald-700 font-bold text-sm">
                <span>Iniciar Nova Adesão</span>
                <div className="h-9 w-9 rounded-full bg-emerald-50 group-hover:bg-emerald-600 group-hover:text-white flex items-center justify-center transition-all">
                  <ArrowRight className="w-5 h-5 group-hover:translate-x-0.5 transition-transform" />
                </div>
              </div>
            </Link>

            {/* CARD 2: ATUALIZAÇÃO CIVIL */}
            <Link
              href={route("associados.atualizacao.civil")}
              className="group relative bg-white/80 backdrop-blur-md rounded-[2.5rem] p-8 border border-sky-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden"
            >
              <div className="absolute top-0 right-0 w-32 h-32 bg-sky-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500" />

              <div>
                <div className="flex items-center justify-between mb-6">
                  <div className="h-16 w-16 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center border border-sky-100 shadow-inner group-hover:bg-sky-600 group-hover:text-white transition-all duration-300">
                    <RefreshCw className="w-8 h-8" />
                  </div>
                  <span className="px-3.5 py-1.5 rounded-full bg-sky-100/80 text-sky-800 text-xs font-bold uppercase tracking-wider">
                    Civil • Já Associado
                  </span>
                </div>

                <h3 className="text-2xl font-bold text-slate-900 mb-2 group-hover:text-sky-700 transition-colors">
                  Atualização Cadastral (Civil)
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed mb-6">
                  Atualização de dados pessoais, contatos e documentos para associados civis já cadastrados na instituição.
                </p>
              </div>

              <div className="flex items-center justify-between pt-4 border-t border-slate-100 text-sky-700 font-bold text-sm">
                <span>Atualizar Meu Cadastro</span>
                <div className="h-9 w-9 rounded-full bg-sky-50 group-hover:bg-sky-600 group-hover:text-white flex items-center justify-center transition-all">
                  <ArrowRight className="w-5 h-5 group-hover:translate-x-0.5 transition-transform" />
                </div>
              </div>
            </Link>

            {/* CARD 3: ADESÃO MILITAR */}
            <Link
              href={route("associados.adesao.militar")}
              className="group relative bg-white/80 backdrop-blur-md rounded-[2.5rem] p-8 border border-indigo-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden"
            >
              <div className="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500" />

              <div>
                <div className="flex items-center justify-between mb-6">
                  <div className="h-16 w-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center border border-indigo-100 shadow-inner group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                    <Shield className="w-8 h-8" />
                  </div>
                  <span className="px-3.5 py-1.5 rounded-full bg-indigo-100/80 text-indigo-800 text-xs font-bold uppercase tracking-wider">
                    Militar • Novo Cadastro
                  </span>
                </div>

                <h3 className="text-2xl font-bold text-slate-900 mb-2 group-hover:text-indigo-700 transition-colors">
                  Ficha de Adesão (Militar)
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed mb-6">
                  Formulário de inclusão para Policiais e Bombeiros Militares com declaração de corporação e matrícula.
                </p>
              </div>

              <div className="flex items-center justify-between pt-4 border-t border-slate-100 text-indigo-700 font-bold text-sm">
                <span>Nova Inclusão Militar</span>
                <div className="h-9 w-9 rounded-full bg-indigo-50 group-hover:bg-indigo-600 group-hover:text-white flex items-center justify-center transition-all">
                  <ArrowRight className="w-5 h-5 group-hover:translate-x-0.5 transition-transform" />
                </div>
              </div>
            </Link>

            {/* CARD 4: ATUALIZAÇÃO MILITAR */}
            <Link
              href={route("associados.atualizacao.militar")}
              className="group relative bg-white/80 backdrop-blur-md rounded-[2.5rem] p-8 border border-amber-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden"
            >
              <div className="absolute top-0 right-0 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500" />

              <div>
                <div className="flex items-center justify-between mb-6">
                  <div className="h-16 w-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100 shadow-inner group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                    <FileText className="w-8 h-8" />
                  </div>
                  <span className="px-3.5 py-1.5 rounded-full bg-amber-100/80 text-amber-900 text-xs font-bold uppercase tracking-wider">
                    Militar • Já Associado
                  </span>
                </div>

                <h3 className="text-2xl font-bold text-slate-900 mb-2 group-hover:text-amber-700 transition-colors">
                  Atualização Cadastral (Militar)
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed mb-6">
                  Atualização de informações funcionais, patente e contatos de Policiais e Bombeiros Militares.
                </p>
              </div>

              <div className="flex items-center justify-between pt-4 border-t border-slate-100 text-amber-800 font-bold text-sm">
                <span>Atualizar Cadastro Militar</span>
                <div className="h-9 w-9 rounded-full bg-amber-50 group-hover:bg-amber-600 group-hover:text-white flex items-center justify-center transition-all">
                  <ArrowRight className="w-5 h-5 group-hover:translate-x-0.5 transition-transform" />
                </div>
              </div>
            </Link>
          </div>
        </main>

        {/* Footer */}
        <footer className="w-full border-t border-sky-100/60 bg-white/50 backdrop-blur-sm py-6 text-center text-xs text-slate-500">
          <div className="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <span>
              © {new Date().getFullYear()} CABEMCE — Caixa Beneficente dos Militares do Ceará
            </span>
            <span>
              Av. Domingos Olímpio, 1589 — Fortaleza/CE • (85) 3048.9964
            </span>
          </div>
        </footer>
      </div>
    </div>
  );
}
