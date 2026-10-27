<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $table = 'tbl_cupons';
    protected $primaryKey = 'id_cupom';
    public $timestamps = true;

    const CREATED_AT = 'criado_em_cupom';
    const UPDATED_AT = 'atualizado_em_cupom';

    protected $fillable = [
        'codigo_cupom',
        'valor_desconto_cupom',
        'data_inicio_cupom',
        'data_fim_cupom',
        'status_cupom',
    ];

    protected $casts = [
        'valor_desconto_cupom' => 'float',
        'data_inicio_cupom' => 'datetime',
        'data_fim_cupom' => 'datetime',
    ];

    // Um cupom pode ser usado em várias vendas
    public function vendas()
    {
        return $this->hasMany(Venda::class, 'id_cupom', 'id_cupom');
    }
}
