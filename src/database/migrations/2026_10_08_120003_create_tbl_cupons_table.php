<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Cupons de desconto que podem ser usados na realização de um pedido.
     */
    public function up(): void
    {
        Schema::create('tbl_cupons', function (Blueprint $table) {
            $table->integer('id_cupom')->autoIncrement();

            $table->string('codigo_cupom', 30)->unique('codigo_cupom');
            $table->double('valor_desconto_cupom');
            $table->dateTime('data_inicio_cupom');
            $table->dateTime('data_fim_cupom');
            $table->string('status_cupom', 10)->default('ATIVO');
            $table->dateTime('criado_em_cupom')->useCurrent();
            $table->dateTime('atualizado_em_cupom')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cupons');
    }
};
