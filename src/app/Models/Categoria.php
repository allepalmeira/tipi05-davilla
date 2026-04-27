<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'tbl_categoria';
    protected $primaryKey = 'id_categoria';
    public $timestamps = true;

    const CREATED_AT = 'criado_em_categoria';
    const UPDATED_AT = 'atualizado_em_categoria';

    protected $fillable = [
        'nome_categoria',
        'descricao_categoria'
    ];
    
}
