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
        Schema::create('tbl_categoria', function (Blueprint $table) {
            $table->integer('id_categoria', true);
            $table->string('nome_categoria', 30);
            $table->text('descricao_categoria');
            $table->string('status_categoria', 10)->default('ATIVO');
            $table->dateTime('criado_em_categoria')->useCurrent();
            $table->dateTime('atualizado_em_categoria')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_categoria');
    }
};
