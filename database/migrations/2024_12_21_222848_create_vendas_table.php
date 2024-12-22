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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id'); 
            $table->unsignedBigInteger('empresa_id'); 
            $table->unsignedBigInteger('forma_pagamento_id'); 
            $table->unsignedBigInteger('usuario_id'); 

            $table->date('data'); 
            $table->float('total', 10, 2); 
            $table->float('desconto', 10, 2)->default(0); 
            $table->float('acrescimo', 10, 2)->default(0); 
            $table->string('status'); 
            $table->text('obs')->nullable(); 

            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('forma_pagamento_id')->references('id')->on('forma_pagamentos')->onDelete('restrict');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
