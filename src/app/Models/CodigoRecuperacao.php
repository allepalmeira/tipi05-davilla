<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoRecuperacao extends Model
{
    protected $table = 'password_reset_codes';

    protected $fillable = [
        'id_cliente',
        'codigo_hash',
        'tentativas',
        'expira_em',
        'validado_em',
        'reset_token_hash',
        'reset_expira_em',
        'consumido_em',
    ];

    protected $hidden = [
        'codigo_hash',
        'reset_token_hash',
    ];

    protected $casts = [
        'expira_em' => 'datetime',
        'validado_em' => 'datetime',
        'reset_expira_em' => 'datetime',
        'consumido_em' => 'datetime',
    ];

    // Um código pertence a um cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
