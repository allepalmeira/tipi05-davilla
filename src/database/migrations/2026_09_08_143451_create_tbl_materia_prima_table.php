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
        Schema::create('tbl_materia_prima', function (Blueprint $table) {
            $table->integer('id_materia_prima', true);
            $table->string('nome_materia_prima', 30);
            $table->string('unid_med_materia_prima', 2);
            $table->double('qtde_atual_materia_prima');
            $table->integer('id_fornecedor')->index('fk_materia_prima_fornecedor');
            $table->dateTime('criado_em_materia_prima')->useCurrent();
            $table->dateTime('atualizado_em_materia_prima')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_materia_prima');
    }
};
