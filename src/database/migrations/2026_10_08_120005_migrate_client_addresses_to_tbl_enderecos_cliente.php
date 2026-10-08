<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Copia o endereço atual de cada cliente (tbl_clientes) para
     * tbl_enderecos_cliente como endereço PRINCIPAL.
     * Clientes que já possuem endereço cadastrado são ignorados.
     */
    public function up(): void
    {
        DB::statement("
            INSERT INTO tbl_enderecos_cliente
                (id_cliente, nome_endereco, endereco, numero, complemento,
                 bairro, cidade, uf, cep, principal_endereco, status_endereco)
            SELECT
                c.id_cliente, 'Principal', c.endereco_cliente, c.numero_cliente, c.complemento_cliente,
                c.bairro_cliente, c.cidade_cliente, c.uf_cliente, c.cep_cliente, 'SIM', 'ATIVO'
            FROM tbl_clientes c
            WHERE NOT EXISTS (
                SELECT 1 FROM tbl_enderecos_cliente e WHERE e.id_cliente = c.id_cliente
            )
        ");
    }

    /**
     * Reverse the migrations.
     * Devolve o endereço principal para tbl_clientes. Os registros em
     * tbl_enderecos_cliente são mantidos, pois podem estar ligados a vendas.
     */
    public function down(): void
    {
        DB::statement("
            UPDATE tbl_clientes c
            JOIN tbl_enderecos_cliente e
                ON e.id_cliente = c.id_cliente AND e.principal_endereco = 'SIM'
            SET c.endereco_cliente    = e.endereco,
                c.numero_cliente      = e.numero,
                c.complemento_cliente = e.complemento,
                c.bairro_cliente      = e.bairro,
                c.cidade_cliente      = e.cidade,
                c.uf_cliente          = e.uf,
                c.cep_cliente         = e.cep
        ");
    }
};
