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
        Schema::table('tbl_controle_materia_prima', function (Blueprint $table) {
            $table->foreign(['id_materia_prima'], 'fk_controle_materia_prima_materia_prima')->references(['id_materia_prima'])->on('tbl_materia_prima')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_controle_materia_prima', function (Blueprint $table) {
            $table->dropForeign('fk_controle_materia_prima_materia_prima');
        });
    }
};
