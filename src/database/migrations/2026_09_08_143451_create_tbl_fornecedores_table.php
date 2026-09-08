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
        Schema::create('tbl_fornecedores', function (Blueprint $table) {
            $table->integer('id_fornecedor', true);
            $table->string('nome_fornecedor', 50);
            $table->string('representante_fornecedor', 50);
            $table->string('email_fornecedor', 80)->unique('email_fornecedor');
            $table->string('telefone_fornecedor', 14);
            $table->string('status_fornecedor', 10)->default('ATIVO');
            $table->dateTime('criado_em_fornecedor')->useCurrent();
            $table->dateTime('atualizado_em_fornecedor')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_fornecedores');
    }
};
