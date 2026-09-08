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
        Schema::create('tbl_produtos', function (Blueprint $table) {
            $table->integer('id_produto', true);
            $table->string('nome_produto', 30);
            $table->string('slug_produto', 150)->nullable();
            $table->integer('id_categoria')->index('fk_produtos_categorias');
            $table->text('descricao_produto');
            $table->string('tamanho_produto', 10);
            $table->string('unid_med_produto', 2);
            $table->double('valor_produto');
            $table->string('foto_produto', 60);
            $table->string('status_produto', 10)->default('ATIVO');
            $table->string('destaque_produto', 3)->default('NAO');
            $table->dateTime('criado_em_produto')->useCurrent();
            $table->dateTime('atualizado_em_produto')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_produtos');
    }
};
