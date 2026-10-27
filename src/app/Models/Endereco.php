<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'tbl_enderecos_cliente';
    protected $primaryKey = 'id_endereco';
    public $timestamps = true;

    const CREATED_AT = 'criado_em_endereco';
    const UPDATED_AT = 'atualizado_em_endereco';

    protected $fillable = [
        'id_cliente',
        'nome_endereco',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'principal_endereco',
        'status_endereco',
    ];

    // Um endereço pertence a um cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
