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
        Schema::create('tbl_clientes', function (Blueprint $table) {
            $table->integer('id_cliente', true);
            $table->string('nome_cliente', 50);
            $table->string('tipo_cliente', 2);
            $table->string('cpf_cnpj_cliente', 18)->unique('cpf_cnpj_cliente');
            $table->date('data_nasc_cliente');
            $table->string('endereco_cliente', 40);
            $table->string('numero_cliente', 6);
            $table->string('complemento_cliente', 50)->nullable();
            $table->string('bairro_cliente', 40);
            $table->string('cidade_cliente', 40);
            $table->string('uf_cliente', 2);
            $table->string('cep_cliente', 9);
            $table->string('email_cliente', 80)->unique('email_cliente');
            $table->string('senha_cliente');
            $table->string('telefone_cliente', 14);
            $table->string('foto_cliente', 60);
            $table->string('status_cliente', 10)->default('ATIVO');
            $table->dateTime('criado_em_cliente')->useCurrent();
            $table->dateTime('atualizado_em_cliente')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_clientes');
    }
};
