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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj', 18)->unique();
            $table->string('ie')->nullable();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->unsignedBigInteger('endereco_id')->nullable();
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->date('data_vencimento')->nullable();
            $table->date('cliente_desde')->nullable();
            $table->string('path_logo')->nullable();
            $table->timestamps();

            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
