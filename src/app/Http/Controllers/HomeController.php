<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    // Metodo HOME - Carregar a index
    public function home()
    {

        // Buscar CATEGORIA para montar a lista de filtro
        $filtroCategoria = Categoria::where('status_categoria', 'ATIVO')
            ->orderBy('ordem_categoria')
            ->get();

        // Buscar todos os PRODUTOS ativos COM a categoria
        $listaProduto = Produto::with('CategoriaProduto')
            ->where('status_produto', 'ATIVO')
            ->orderBy('ordem_produto')
            ->get();

      

        //dd($listaProduto);

        return view('site.home.home', compact('filtroCategoria','listaProduto'));
    }

 
}
