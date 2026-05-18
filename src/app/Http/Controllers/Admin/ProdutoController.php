<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categoria;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::orderBy('ordem_produto')->get();
        //dd($produtos);
        return view('admin.produto.index', compact('produtos'));
    }
}
