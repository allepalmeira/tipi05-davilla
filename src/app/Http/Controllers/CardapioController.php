<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;

use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function cardapio()
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

        return view('site.cardapio.cardapio', compact('filtroCategoria', 'listaProduto'));
    }

    public function showProduto($slug)
    {

        $produto = Produto::with('CategoriaProduto')
            ->where('status_produto', 'ATIVO')
            ->where('slug_produto', $slug)
            ->firstOrFail();

        $produtosRelacionados = Produto::where('status_produto', 'ATIVO')
            ->where('id_categoria', $produto->id_categoria)
            ->where('id_produto', '!=', $produto->id_produto)
            ->orderBy('ordem_produto')
            ->get();

        $listaCategoria = Categoria::where('status_categoria', 'ATIVO')
            ->orderBy('ordem_categoria')
            ->get();

        //dd($listaCategoria);

        return view('site.produto.produto', compact('produto', 'produtosRelacionados', 'listaCategoria'));
    }
}
