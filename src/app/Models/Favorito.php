<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $table = 'tbl_favoritos';
    protected $primaryKey = 'id_favorito';
    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'id_produto',
        'status_favorito',
    ];

    // Um favorito pertence a um cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // Um favorito pertence a um produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }
}
