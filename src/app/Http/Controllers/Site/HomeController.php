<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Banner;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    // Metodo HOME - Carregar a index
    public function home()
    {

        // Buscar CATEGORIA para montar a lista de filtro
        $filtroCategoria = Categoria::where('status_categoria', 'ATIVO')
            ->inRandomOrder()
            ->get();


        // Buscar todos os PRODUTOS ativos COM a categoria
        $listaProduto = Produto::with('CategoriaProduto')
            ->where('status_produto', 'ATIVO')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $banner = Banner::where('status_banner', 'ATIVO')
            ->inRandomOrder()
            ->get();


        //dd($listaProduto);

        return view('site.home.home', compact('filtroCategoria', 'listaProduto', 'banner'));
    }
}
