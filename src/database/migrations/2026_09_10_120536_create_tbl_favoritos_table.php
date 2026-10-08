<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * id_favorito
     * id_cliente
     * id_produto
     * criado_em_favorito
     * status_favorito
     */
    public function up(): void
    {
        Schema::create('tbl_favoritos', function (Blueprint $table) {
            $table->integer('id_favorito')->autoIncrement();

            $table->integer('id_cliente');
            $table->integer('id_produto');
            $table->dateTime('criado_em_favorito')->useCurrent();
            $table->string('status_favorito', 20)->default('ATIVO');

            /* id_cliente ---- 1 ---- id_favorito ---- N ---- id_produto */

            $table->unique(['id_cliente', 'id_produto'], 'favorito_cliente_produto');

            $table->foreign('id_cliente', 'fk_favorito_cliente')
            ->references('id_cliente')
            ->on('tbl_clientes');

            $table->foreign('id_produto', 'fk_favorito_produto')
            ->references('id_produto')
            ->on('tbl_produtos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_favoritos');
    }
};
