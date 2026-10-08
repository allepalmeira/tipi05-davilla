<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * O cliente envia um depoimento, que entra como PENDENTE até ser aprovado.
     */
    public function up(): void
    {
        Schema::create('tbl_depoimentos', function (Blueprint $table) {
            $table->integer('id_depoimento')->autoIncrement();

            $table->integer('id_cliente')->index('fk_depoimento_cliente');
            $table->text('texto_depoimento');
            $table->tinyInteger('nota_depoimento')->unsigned();
            $table->string('status_depoimento', 10)->default('PENDENTE');
            $table->dateTime('criado_em_depoimento')->useCurrent();
            $table->dateTime('atualizado_em_depoimento')->useCurrentOnUpdate()->useCurrent();

            /* id_cliente ---- 1 ---- N ---- id_depoimento */

            $table->foreign('id_cliente', 'fk_depoimento_cliente')
            ->references('id_cliente')
            ->on('tbl_clientes');
        });

        // Nota sempre entre 1 e 5
        DB::statement('ALTER TABLE tbl_depoimentos ADD CONSTRAINT chk_nota_depoimento CHECK (nota_depoimento BETWEEN 1 AND 5)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_depoimentos');
    }
};
