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
        Schema::create('tbl_usuarios', function (Blueprint $table) {
            $table->integer('id_usuario', true);
            $table->string('nome_usuario', 50);
            $table->string('email_usuario', 80)->unique('email_usuario');
            $table->string('senha_usuario');
            $table->string('perfil_usuario', 13);
            $table->string('foto_usuario', 30);
            $table->string('status_usuario', 10);
            $table->dateTime('criado_em_usuario')->useCurrent();
            $table->dateTime('atualizado_em_usuario')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_usuarios');
    }
};
