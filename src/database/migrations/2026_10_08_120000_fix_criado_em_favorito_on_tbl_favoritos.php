<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * criado_em_favorito foi criado como INT sem default;
     * o correto é DATETIME com CURRENT_TIMESTAMP.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE tbl_favoritos MODIFY criado_em_favorito DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE tbl_favoritos MODIFY criado_em_favorito INT NOT NULL');
    }
};
