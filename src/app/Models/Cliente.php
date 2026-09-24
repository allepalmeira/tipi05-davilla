<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'tbl_clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = true;

    const CREATED_AT = 'criado_em_cliente';
    const UPDATED_AT = 'atualizado_em_cliente';

    protected $fillable = [
        'nome_cliente',
        'tipo_cliente',
        'cpf_cnpj_cliente',
        'data_nasc_cliente',
        'endereco_cliente',
        'numero_cliente',
        'complemento_cliente',
        'bairro_cliente',
        'cidade_cliente',
        'uf_cliente',
        'cep_cliente',
        'email_cliente',
        'senha_cliente',
        'telefone_cliente',
        'foto_cliente',
        'status_cliente',
    ];

    protected $hidden = [
        'senha_cliente',
    ];

    protected $casts = [
        'data_nasc_cliente' => 'date',
    ];

    public function getAuthPassword()
    {
        return $this->senha_cliente;
    }
}