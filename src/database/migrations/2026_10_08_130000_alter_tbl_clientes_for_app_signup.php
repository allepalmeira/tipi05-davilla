<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * O cadastro pelo aplicativo pede apenas nome, e-mail, telefone, senha
     * e o aceite do termo. Os demais dados são completados depois no perfil.
     */
    public function up(): void
    {
        Schema::table('tbl_clientes', function (Blueprint $table) {
            $table->string('tipo_cliente', 2)->nullable()->change();
            $table->string('cpf_cnpj_cliente', 18)->nullable()->change();
            $table->date('data_nasc_cliente')->nullable()->change();
            $table->string('foto_cliente', 60)->nullable()->change();

            // Data e hora em que o cliente aceitou o termo de consentimento (LGPD)
            $table->dateTime('termo_aceito_em_cliente')->nullable()->after('status_cliente');
        });
    }

    /**
     * Reverse the migrations.
     * Só reverte se todos os clientes tiverem esses campos preenchidos.
     */
    public function down(): void
    {
        Schema::table('tbl_clientes', function (Blueprint $table) {
            $table->dropColumn('termo_aceito_em_cliente');

            $table->string('tipo_cliente', 2)->nullable(false)->change();
            $table->string('cpf_cnpj_cliente', 18)->nullable(false)->change();
            $table->date('data_nasc_cliente')->nullable(false)->change();
            $table->string('foto_cliente', 60)->nullable(false)->change();
        });
    }
};
