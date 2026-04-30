<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Produto extends Model
{
    protected $table = 'tbl_produtos';
    protected $primaryKey = 'id_produto';
    public $timestamps = true;

    const CREATED_AT = 'criado_em_produto';
    const UPDATED_AT = 'atualizado_em_produto';

    protected $fillable = [
        'nome_produto',
        'slug_produto',
        'id_categoria',
        'descricao_produto',
        'tamanho_produto',
        'unid_med_produto',
        'valor_produto',
        'foto_produto',
        'status_produto',
        'destaque_produto',
        'ordem_produto',
    ];
    

    // Relacionamento um produto pertence a uma categoria 
    // belongsTo: pertence a
    public function CategoriaProduto(){
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }   



}
