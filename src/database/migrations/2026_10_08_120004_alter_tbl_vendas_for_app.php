<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Novos campos da venda para o aplicativo: endereço, cupom,
     * forma de pagamento, entrega/retirada, observação e desconto.
     */
    public function up(): void
    {
        Schema::table('tbl_vendas', function (Blueprint $table) {
            $table->integer('id_endereco')->nullable()->after('id_usuario')->index('fk_venda_endereco');
            $table->integer('id_cupom')->nullable()->after('id_endereco')->index('fk_venda_cupom');
            $table->string('forma_pagamento_venda', 10)->nullable()->after('valor_venda');
            $table->string('entrega_venda', 3)->default('NAO')->after('forma_pagamento_venda');
            $table->text('observacao_venda')->nullable()->after('entrega_venda');
            $table->double('valor_desconto_venda')->default(0)->after('observacao_venda');

            $table->foreign('id_endereco', 'fk_venda_endereco')
            ->references('id_endereco')
            ->on('tbl_enderecos_cliente');

            $table->foreign('id_cupom', 'fk_venda_cupom')
            ->references('id_cupom')
            ->on('tbl_cupons');
        });

        DB::statement("ALTER TABLE tbl_vendas ADD CONSTRAINT chk_forma_pagamento_venda CHECK (forma_pagamento_venda IN ('PIX', 'DINHEIRO', 'CARTAO'))");
        DB::statement("ALTER TABLE tbl_vendas ADD CONSTRAINT chk_entrega_venda CHECK (entrega_venda IN ('SIM', 'NAO'))");

        // Entrega = SIM exige um endereço relacionado
        DB::statement("ALTER TABLE tbl_vendas ADD CONSTRAINT chk_entrega_endereco_venda CHECK (entrega_venda = 'NAO' OR id_endereco IS NOT NULL)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE tbl_vendas DROP CHECK chk_entrega_endereco_venda');
        DB::statement('ALTER TABLE tbl_vendas DROP CHECK chk_entrega_venda');
        DB::statement('ALTER TABLE tbl_vendas DROP CHECK chk_forma_pagamento_venda');

        Schema::table('tbl_vendas', function (Blueprint $table) {
            $table->dropForeign('fk_venda_endereco');
            $table->dropForeign('fk_venda_cupom');

            $table->dropIndex('fk_venda_endereco');
            $table->dropIndex('fk_venda_cupom');

            $table->dropColumn([
                'id_endereco',
                'id_cupom',
                'forma_pagamento_venda',
                'entrega_venda',
                'observacao_venda',
                'valor_desconto_venda',
            ]);
        });
    }
};
