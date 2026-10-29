<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Recuperação de senha pelo aplicativo: código de 4 dígitos enviado por e-mail.
     * Nada é guardado em texto puro: somente o hash do código e o hash do reset_token.
     *
     * codigo_hash        hash do código de 4 dígitos
     * tentativas         erros de digitação do código (máximo 5)
     * expira_em          validade do código (5 minutos)
     * validado_em        quando o código foi digitado corretamente
     * reset_token_hash   hash do token que autoriza a nova senha
     * reset_expira_em    validade do reset_token (10 minutos)
     * consumido_em       quando a recuperação foi encerrada (senha trocada ou código substituído)
     */
    public function up(): void
    {
        Schema::create('password_reset_codes', function (Blueprint $table) {
            $table->id();

            $table->integer('id_cliente');
            $table->string('codigo_hash');
            $table->unsignedTinyInteger('tentativas')->default(0);
            $table->dateTime('expira_em');
            $table->dateTime('validado_em')->nullable();
            $table->string('reset_token_hash', 64)->nullable()->unique();
            $table->dateTime('reset_expira_em')->nullable();
            $table->dateTime('consumido_em')->nullable();
            $table->timestamps();

            /* id_cliente ---- 1 ---- N ---- password_reset_codes */

            $table->index(['id_cliente', 'consumido_em'], 'idx_reset_codes_cliente');

            $table->foreign('id_cliente', 'fk_reset_codes_cliente')
            ->references('id_cliente')
            ->on('tbl_clientes')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_codes');
    }
};
