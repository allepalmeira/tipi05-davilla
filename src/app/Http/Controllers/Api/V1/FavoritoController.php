<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Favorito;
use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $favoritos = $request->user()
            ->favoritos()
            ->where('status_favorito', 'ATIVO')
            ->whereHas('produto', function ($query) {
                $query->where('status_produto', 'ATIVO')
                    ->whereHas('CategoriaProduto', function ($q) {
                        $q->where('status_categoria', 'ATIVO');
                    });
            })
            ->with('produto.CategoriaProduto')
            ->orderByDesc('criado_em_favorito')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $favoritos
        ]);
    }


    public function store(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'id_produto' => 'required|integer',
        ], [
            'id_produto.required' => 'Informe o produto.',
            'id_produto.integer' => 'Produto inválido.',
        ]);

        $produto = Produto::where('id_produto', $dados['id_produto'])
            ->where('status_produto', 'ATIVO')
            ->whereHas('CategoriaProduto', function ($query) {
                $query->where('status_categoria', 'ATIVO');
            })
            ->first();

        if (!$produto) {
            return response()->json([
                'success' => false,
                'message' => 'Produto não encontrado.'
            ], 404);
        }

        $favorito = Favorito::firstOrNew([
            'id_cliente' => $request->user()->id_cliente,
            'id_produto' => $produto->id_produto,
        ]);

        $criado = !$favorito->exists || $favorito->status_favorito !== 'ATIVO';

        $favorito->status_favorito = 'ATIVO';
        $favorito->save();

        return response()->json([
            'success' => true,
            'message' => 'Produto adicionado aos favoritos.',
            'data' => $favorito->fresh()->load('produto.CategoriaProduto')
        ], $criado ? 201 : 200);
    }


    public function destroy(Request $request, int $idProduto): JsonResponse
    {
        $favorito = $request->user()
            ->favoritos()
            ->where('id_produto', $idProduto)
            ->where('status_favorito', 'ATIVO')
            ->first();

        if (!$favorito) {
            return response()->json([
                'success' => false,
                'message' => 'Favorito não encontrado.'
            ], 404);
        }

        $favorito->update(['status_favorito' => 'INATIVO']);

        return response()->json([
            'success' => true,
            'message' => 'Produto removido dos favoritos.'
        ]);
    }
}
