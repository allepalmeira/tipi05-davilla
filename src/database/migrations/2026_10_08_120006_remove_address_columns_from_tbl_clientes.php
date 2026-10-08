<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * O endereço agora fica em tbl_enderecos_cliente.
     */
    public function up(): void
    {
        Schema::table('tbl_clientes', function (Blueprint $table) {
            $table->dropColumn([
                'endereco_cliente',
                'numero_cliente',
                'complemento_cliente',
                'bairro_cliente',
                'cidade_cliente',
                'uf_cliente',
                'cep_cliente',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     * As colunas voltam como nullable, já que existem clientes cadastrados;
     * os dados são restaurados pelo down() da migration anterior.
     */
    public function down(): void
    {
        Schema::table('tbl_clientes', function (Blueprint $table) {
            $table->string('endereco_cliente', 40)->nullable()->after('data_nasc_cliente');
            $table->string('numero_cliente', 6)->nullable()->after('endereco_cliente');
            $table->string('complemento_cliente', 50)->nullable()->after('numero_cliente');
            $table->string('bairro_cliente', 40)->nullable()->after('complemento_cliente');
            $table->string('cidade_cliente', 40)->nullable()->after('bairro_cliente');
            $table->string('uf_cliente', 2)->nullable()->after('cidade_cliente');
            $table->string('cep_cliente', 9)->nullable()->after('uf_cliente');
        });
    }
};
