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
        Schema::create('tbl_banner', function (Blueprint $table) {
            $table->integer('id_banner', true);
            $table->string('nome_banner', 30);
            $table->string('titulo_banner', 80);
            $table->string('subtitulo_banner', 120)->nullable();
            $table->text('descricao_banner')->nullable();
            $table->string('texto_botao_banner', 30)->nullable();
            $table->string('link_botao_banner', 120)->nullable();
            $table->integer('ordem_banner')->default(0);
            $table->string('foto_banner', 50);
            $table->string('status_banner', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_banner');
    }
};
