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
        Schema::table('tbl_produtos', function (Blueprint $table) {
            $table->foreign(['id_categoria'], 'fk_produtos_categorias')->references(['id_categoria'])->on('tbl_categoria')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_produtos', function (Blueprint $table) {
            $table->dropForeign('fk_produtos_categorias');
        });
    }
};
