<div class="max-w-4xl mx-auto px-6 pb-24">
    <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold text-premium-navy mb-3">Ficha de Inscrição</h2>
        <p class="text-slate-500">Solicitação de associação à Caixa Beneficente dos Militares do Ceará.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 border border-green-200 p-6 rounded-2xl mb-12 flex items-center gap-4 animate-in fade-in slide-in-from-top-4 duration-500">
            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg shadow-green-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div>
                <p class="font-bold text-green-800">Cadastro Enviado!</p>
                <p class="text-green-700/80 text-sm">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-10">
        <!-- Dados Pessoais -->
        <section class="premium-card p-8 md:p-10 rounded-[2rem] space-y-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-premium-light-blue rounded-2xl flex items-center justify-center text-premium-navy shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-premium-navy">Dados Pessoais</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Nome Completo</label>
                    <input type="text" wire:model="nome" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                    @error('nome') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2" x-data>
                    <label class="text-sm font-semibold text-slate-600 ml-1">CPF</label>
                    <input type="text" wire:model="cpf" x-mask="999.999.999-99" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                    @error('cpf') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Data de Nascimento</label>
                    <input type="date" wire:model="data_nascimento" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                    @error('data_nascimento') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Estado Civil</label>
                    <select wire:model="estado_civil" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50 appearance-none">
                        <option value="">Selecione...</option>
                        <option value="Solteiro(a)">Solteiro(a)</option>
                        <option value="Casado(a)">Casado(a)</option>
                        <option value="União Estável">União Estável</option>
                        <option value="Divorciado(a)">Divorciado(a)</option>
                        <option value="Viúvo(a)">Viúvo(a)</option>
                    </select>
                    @error('estado_civil') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Naturalidade</label>
                    <input type="text" wire:model="naturalidade" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                    @error('naturalidade') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">WhatsApp</label>
                    <input type="text" wire:model="telefone_whatsapp" x-mask="(99) 99999-9999" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                    @error('telefone_whatsapp') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">E-mail</label>
                    <input type="email" wire:model="email" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                    @error('email') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </section>

        <!-- Dados Militares -->
        <section class="premium-card p-8 md:p-10 rounded-[2rem] space-y-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-premium-light-blue rounded-2xl flex items-center justify-center text-premium-navy shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-premium-navy">Dados Militares</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Corporação</label>
                    <div class="flex p-1 bg-slate-100 rounded-2xl">
                        <button type="button" wire:click="$set('corporacao', 'PM')" class="flex-1 py-3 rounded-xl font-bold transition {{ $corporacao === 'PM' ? 'bg-white text-premium-navy shadow-sm' : 'text-slate-500 hover:text-premium-navy' }}">PM</button>
                        <button type="button" wire:click="$set('corporacao', 'BM')" class="flex-1 py-3 rounded-xl font-bold transition {{ $corporacao === 'BM' ? 'bg-white text-premium-navy shadow-sm' : 'text-slate-500 hover:text-premium-navy' }}">BM (CBM)</button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Matrícula</label>
                    <input type="text" wire:model="matricula" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                    @error('matricula') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Posto ou Graduação</label>
                    <input type="text" wire:model="posto_graduacao" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                    @error('posto_graduacao') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center gap-3 pt-9">
                    <div class="relative inline-block w-12 h-6 transition duration-200 ease-in-out bg-slate-200 rounded-full cursor-pointer" @click="$wire.set('is_civil', !$wire.is_civil)" :class="$wire.is_civil ? 'bg-blue-600' : 'bg-slate-200'">
                        <span class="absolute left-0 w-6 h-6 transition duration-200 ease-in-out transform bg-white border border-slate-200 rounded-full shadow-sm" :class="$wire.is_civil ? 'translate-x-6' : 'translate-x-0'"></span>
                    </div>
                    <span class="text-sm font-semibold text-slate-600">Associado Civil?</span>
                </div>
            </div>
        </section>

        <!-- Endereço -->
        <section class="premium-card p-8 md:p-10 rounded-[2rem] space-y-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-premium-light-blue rounded-2xl flex items-center justify-center text-premium-navy shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-premium-navy">Endereço Residencial</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">CEP</label>
                    <input type="text" wire:model.live="cep" x-mask="99999-999" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                    @error('cep') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Logradouro</label>
                    <input type="text" wire:model="logradouro" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                    @error('logradouro') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Número</label>
                    <input type="text" wire:model="numero" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Bairro</label>
                    <input type="text" wire:model="bairro" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Complemento</label>
                    <input type="text" wire:model="complemento" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Cidade</label>
                    <input type="text" wire:model="cidade" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-600 ml-1">Estado (UF)</label>
                    <input type="text" wire:model="estado" maxlength="2" class="w-full premium-input rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-50">
                </div>
            </div>
        </section>

        <!-- Documentos e Assinatura -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <section class="premium-card p-8 md:p-10 rounded-[2rem] space-y-6">
                <h3 class="text-lg font-bold text-premium-navy flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Documentos (RG)
                </h3>
                
                <div class="space-y-6">
                    <div class="relative group">
                        <input type="file" wire:model="rg_frente" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="premium-input border-2 border-dashed rounded-2xl p-6 text-center group-hover:border-blue-400 transition">
                            @if ($rg_frente)
                                <img src="{{ $rg_frente->temporaryUrl() }}" class="h-24 mx-auto rounded-lg shadow-sm">
                            @else
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Frente do RG</p>
                            @endif
                        </div>
                    </div>

                    <div class="relative group">
                        <input type="file" wire:model="rg_verso" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="premium-input border-2 border-dashed rounded-2xl p-6 text-center group-hover:border-blue-400 transition">
                            @if ($rg_verso)
                                <img src="{{ $rg_verso->temporaryUrl() }}" class="h-24 mx-auto rounded-lg shadow-sm">
                            @else
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Verso do RG</p>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <section class="premium-card p-8 md:p-10 rounded-[2rem] space-y-6">
                <h3 class="text-lg font-bold text-premium-navy flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Assinatura Digital
                </h3>

                <div x-data="signaturePad(@entangle('assinatura'))" class="space-y-4">
                    <div class="bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden">
                        <canvas x-ref="canvas" class="w-full h-40 cursor-crosshair"></canvas>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="clear" class="text-xs font-bold text-slate-400 hover:text-red-500 uppercase tracking-widest transition">Limpar</button>
                    </div>
                    @error('assinatura') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </section>
        </div>

        <!-- Termos -->
        <section class="premium-card p-8 rounded-[2rem] space-y-6">
            <div class="flex items-start gap-4">
                <input type="checkbox" wire:model="aceite_termos" class="mt-1 w-6 h-6 text-blue-600 rounded-lg border-slate-300 focus:ring-blue-500">
                <label class="text-sm text-slate-600 leading-relaxed">
                    Afirmo que as informações prestadas são verdadeiras e autorizo a atualização cadastral como sócio da CABEMCE.
                </label>
            </div>
            <div class="flex items-start gap-4">
                <input type="checkbox" wire:model="ciencia_lgpd" class="mt-1 w-6 h-6 text-blue-600 rounded-lg border-slate-300 focus:ring-blue-500">
                <label class="text-sm text-slate-600 leading-relaxed">
                    Estou ciente e de acordo com o tratamento de dados pessoais nos termos da LGPD.
                </label>
            </div>
        </section>

        <div class="pt-6">
            <button type="submit" class="w-full bg-premium-navy py-5 rounded-3xl text-white font-bold text-lg hover:shadow-[0_20px_50px_rgba(30,58,138,0.3)] transition transform active:scale-95 flex items-center justify-center gap-3">
                <span>Finalizar Cadastro</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('signaturePad', (value) => ({
            signaturePad: null,
            init() {
                this.signaturePad = new SignaturePad(this.$refs.canvas);
                this.signaturePad.addEventListener("endStroke", () => {
                    this.$wire.set('assinatura', this.signaturePad.toDataURL());
                });
            },
            clear() {
                this.signaturePad.clear();
                this.$wire.set('assinatura', null);
            }
        }))
    })
</script>
@endpush
