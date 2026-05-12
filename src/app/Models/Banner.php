<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'tbl_banner';
    protected $primaryKey = 'id_banner';

    public $timestamps = false;

    protected $fillable = [
        'nome_banner',
        'titulo_banner',
        'subtitulo_banner',
        'descricao_banner',
        'texto_botao_banner',
        'link_botao_banner',
        'ordem_banner',
        'foto_banner',
        'status_banner',
    ];
}
