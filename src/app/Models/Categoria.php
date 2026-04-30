<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Categoria extends Model
{
    protected $table = 'tbl_categoria';
    protected $primaryKey = 'id_categoria';
    public $timestamps = true;

    const CREATED_AT = 'criado_em_categoria';
    const UPDATED_AT = 'atualizado_em_categoria';

    protected $fillable = [
        'nome_categoria',
        'descricao_categoria',
        'status_categoria',
        'ordem_categoria',
    ];

    // hasMany: tem muitos
    public function ProdutosCategoria() {
        return $this->hasMany(Produto::class, 'id_categoria',  'id_categoria');
    }
    
}
