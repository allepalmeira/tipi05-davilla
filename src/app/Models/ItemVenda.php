<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    protected $table = 'tbl_itens_venda';
    protected $primaryKey = 'id_item';
    public $timestamps = true;

    // A tabela só tem a data de atualização
    const CREATED_AT = null;
    const UPDATED_AT = 'atualizado_em_item';

    protected $fillable = [
        'id_venda',
        'id_produto',
        'valor_unit_item',
        'qtde_item',
        'status_item',
    ];

    protected $casts = [
        'valor_unit_item' => 'float',
        'qtde_item' => 'float',
    ];

    // Um item pertence a uma venda
    public function venda()
    {
        return $this->belongsTo(Venda::class, 'id_venda', 'id_venda');
    }

    // Um item refere-se a um produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }
}
