<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\JsonResponse;

class ProdutoController extends Controller
{
    public function index(): JsonResponse
    {
        $produtos = Produto::with('CategoriaProduto')
            ->where('status_produto', 'ATIVO')
            ->whereHas('CategoriaProduto', function ($query) {
                $query->where('status_categoria', 'ATIVO');
            })
            ->orderBy('nome_produto')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $produtos
        ]);
    }


    public function show(string $slug): JsonResponse
    {
        $produto = Produto::with('CategoriaProduto')
            ->where('slug_produto', $slug)
            ->where('status_produto', 'ATIVO')
            ->whereHas('CategoriaProduto', function ($query) {
                $query->where('status_categoria', 'ATIVO');
            })
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $produto
        ]);
    }
    
}