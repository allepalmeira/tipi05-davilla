<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ajustes para receber pedidos criados pelo aplicativo:
     * - id_usuario passa a aceitar NULL (o pedido do app não tem atendente;
     *   a equipe pode assumir o pedido depois). A FK continua valendo.
     * - status_venda ganha default PENDENTE e uma lista de valores permitidos.
     * data_entrega_venda continua obrigatório: o cliente agenda a encomenda.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE tbl_vendas MODIFY id_usuario INT NULL');

        DB::statement("ALTER TABLE tbl_vendas MODIFY status_venda VARCHAR(12) NOT NULL DEFAULT 'PENDENTE'");

        DB::statement("ALTER TABLE tbl_vendas ADD CONSTRAINT chk_status_venda CHECK (status_venda IN ('PENDENTE', 'CONFIRMADO', 'EM_PREPARO', 'PRONTO', 'EM_ENTREGA', 'ENTREGUE', 'CANCELADO'))");
    }

    /**
     * Reverse the migrations.
     * Atenção: o rollback falha se existirem vendas com id_usuario NULL.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE tbl_vendas DROP CONSTRAINT chk_status_venda');

        DB::statement('ALTER TABLE tbl_vendas MODIFY status_venda VARCHAR(12) NOT NULL');

        DB::statement('ALTER TABLE tbl_vendas MODIFY id_usuario INT NOT NULL');
    }
};
