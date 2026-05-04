<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('associados', function (Blueprint $table) {
            $table->id();
            
            // Dados Pessoais
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->date('data_nascimento');
            $table->string('estado_civil');
            $table->string('naturalidade');
            $table->string('email')->unique();
            $table->string('telefone_whatsapp');
            
            // Endereço
            $table->string('cep');
            $table->string('logradouro');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            
            // Dados Militares
            $table->string('corporacao'); // PM ou BM
            $table->string('matricula');
            $table->string('posto_graduacao');
            $table->boolean('is_civil')->default(false);
            
            // Documentos
            $table->string('rg_frente_path')->nullable();
            $table->string('rg_verso_path')->nullable();
            
            // Legal
            $table->text('assinatura')->nullable(); // Base64 ou path
            $table->boolean('aceite_termos')->default(false);
            $table->boolean('ciencia_lgpd')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associados');
    }
};
