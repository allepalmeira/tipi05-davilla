<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'tbl_vendas';
    protected $primaryKey = 'id_venda';
    public $timestamps = true;

    const CREATED_AT = 'data_venda';
    const UPDATED_AT = 'atualizado_em_venda';

    protected $fillable = [
        'id_cliente',
        'id_usuario',
        'id_endereco',
        'id_cupom',
        'valor_venda',
        'forma_pagamento_venda',
        'entrega_venda',
        'observacao_venda',
        'valor_desconto_venda',
        'status_venda',
        'data_entrega_venda',
    ];

    protected $casts = [
        'valor_venda' => 'float',
        'valor_desconto_venda' => 'float',
        'data_entrega_venda' => 'datetime',
    ];

    // Campos calculados que acompanham o JSON do pedido
    protected $appends = [
        'subtotal_venda',
        'status_descricao_venda',
    ];

    const STATUS_DESCRICAO = [
        'PENDENTE' => 'Aguardando confirmação',
        'CONFIRMADO' => 'Pedido confirmado',
        'EM_PREPARO' => 'Em preparo',
        'PRONTO' => 'Pronto',
        'EM_ENTREGA' => 'Saiu para entrega',
        'ENTREGUE' => 'Entregue',
        'CANCELADO' => 'Cancelado',
    ];

    // Total antes do desconto (valor_venda já é o total com desconto)
    protected function subtotalVenda(): Attribute
    {
        return Attribute::get(
            fn () => round($this->valor_venda + $this->valor_desconto_venda, 2)
        );
    }

    protected function statusDescricaoVenda(): Attribute
    {
        return Attribute::get(
            fn () => self::STATUS_DESCRICAO[$this->status_venda] ?? $this->status_venda
        );
    }

    // Uma venda pertence a um cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // Uma venda possui vários itens
    public function itens()
    {
        return $this->hasMany(ItemVenda::class, 'id_venda', 'id_venda');
    }

    // Endereço de entrega (somente quando entrega_venda = SIM)
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'id_endereco', 'id_endereco');
    }

    // Cupom utilizado, se houver
    public function cupom()
    {
        return $this->belongsTo(Cupom::class, 'id_cupom', 'id_cupom');
    }
}
