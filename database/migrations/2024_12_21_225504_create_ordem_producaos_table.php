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
        Schema::create('ordem_producaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcionario_id')->constrained('funcionarios')->onDelete('cascade');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->float('producao_estimada', 8, 5)->nullable();
            $table->float('producao_real', 8, 4)->nullable();
            $table->float('valor_unitario', 8, 4)->nullable();
            $table->enum('status', ['executando', 'conluido', 'esperando'])->default('conluido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_producaos');
    }
};
