<?php

namespace App\Models;
use App\Mail\RedefinirSenhaMail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
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
        'email_cliente',
        'senha_cliente',
        'telefone_cliente',
        'foto_cliente',
        'status_cliente',
        'termo_aceito_em_cliente',
    ];

    protected $hidden = [
        'senha_cliente',
    ];

    protected $casts = [
        'data_nasc_cliente' => 'date',
        'termo_aceito_em_cliente' => 'datetime',
    ];

    // Um cliente possui vários favoritos
    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'id_cliente', 'id_cliente');
    }

    // Um cliente realiza vários pedidos
    public function vendas()
    {
        return $this->hasMany(Venda::class, 'id_cliente', 'id_cliente');
    }

    // Um cliente possui vários endereços
    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'id_cliente', 'id_cliente');
    }

    // O e-mail do cliente fica em email_cliente (o padrão do Laravel é "email")
    public function getEmailForPasswordReset()
    {
        return $this->email_cliente;
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email_cliente)->send(new RedefinirSenhaMail($this, $token));
    }

    public function getAuthPassword()
    {
        return $this->senha_cliente;
    }
}