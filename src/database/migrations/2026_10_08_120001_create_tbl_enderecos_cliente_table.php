<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Um cliente pode possuir vários endereços (casa, trabalho...).
     */
    public function up(): void
    {
        Schema::create('tbl_enderecos_cliente', function (Blueprint $table) {
            $table->integer('id_endereco')->autoIncrement();

            $table->integer('id_cliente')->index('fk_endereco_cliente');
            $table->string('nome_endereco', 30);
            $table->string('endereco', 40);
            $table->string('numero', 6);
            $table->string('complemento', 50)->nullable();
            $table->string('bairro', 40);
            $table->string('cidade', 40);
            $table->string('uf', 2);
            $table->string('cep', 9);
            $table->string('principal_endereco', 3)->default('NAO');
            $table->string('status_endereco', 10)->default('ATIVO');
            $table->dateTime('criado_em_endereco')->useCurrent();
            $table->dateTime('atualizado_em_endereco')->useCurrentOnUpdate()->useCurrent();

            /* id_cliente ---- 1 ---- N ---- id_endereco */

            $table->foreign('id_cliente', 'fk_endereco_cliente')
            ->references('id_cliente')
            ->on('tbl_clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_enderecos_cliente');
    }
};
