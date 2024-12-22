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
        Schema::create('itens_venda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venda_id'); 
            $table->unsignedBigInteger('produto_id');

            $table->integer('qtd');
            $table->float('unitario', 10, 2); 
            $table->float('desconto', 10, 2)->default(0); 
            $table->float('subtotal', 10, 2); // Subtotal = (unitário * qtd) - desconto

            $table->timestamps();

            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_vendas');
    }
};
