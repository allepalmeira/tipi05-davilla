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
        Schema::create('tbl_itens_venda', function (Blueprint $table) {
            $table->integer('id_item', true);
            $table->integer('id_venda')->index('fk_itens_venda_venda');
            $table->integer('id_produto')->index('fk_itens_venda_produto');
            $table->double('valor_unit_item');
            $table->double('qtde_item');
            $table->string('status_item', 10);
            $table->dateTime('atualizado_em_item')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_itens_venda');
    }
};
