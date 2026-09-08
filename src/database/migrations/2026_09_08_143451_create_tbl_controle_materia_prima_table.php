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
        Schema::create('tbl_controle_materia_prima', function (Blueprint $table) {
            $table->integer('id_controle', true);
            $table->integer('id_materia_prima')->index('fk_controle_materia_prima_materia_prima');
            $table->string('tipo_controle', 7);
            $table->double('qtde_controle');
            $table->dateTime('data_controle')->useCurrent();
            $table->text('obs_controle')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_controle_materia_prima');
    }
};
