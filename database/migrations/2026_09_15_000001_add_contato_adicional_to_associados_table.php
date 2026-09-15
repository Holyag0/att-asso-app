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
        Schema::table('associados', function (Blueprint $table) {
            $table->string('contato_adicional_nome')->nullable()->after('ciencia_lgpd');
            $table->string('contato_adicional_endereco')->nullable()->after('contato_adicional_nome');
            $table->string('contato_adicional_bairro')->nullable()->after('contato_adicional_endereco');
            $table->string('contato_adicional_cidade')->nullable()->after('contato_adicional_bairro');
            $table->string('contato_adicional_estado', 2)->nullable()->after('contato_adicional_cidade');
            $table->string('contato_adicional_telefone')->nullable()->after('contato_adicional_estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('associados', function (Blueprint $table) {
            $table->dropColumn([
                'contato_adicional_nome',
                'contato_adicional_endereco',
                'contato_adicional_bairro',
                'contato_adicional_cidade',
                'contato_adicional_estado',
                'contato_adicional_telefone',
            ]);
        });
    }
};
