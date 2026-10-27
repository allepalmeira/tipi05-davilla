<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cupom;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'status' => 'nullable|in:' . implode(',', array_keys(Venda::STATUS_DESCRICAO)),
            'por_pagina' => 'nullable|integer|min:1|max:50',
        ], [
            'status.in' => 'Status inválido.',
            'por_pagina.max' => 'O máximo é 50 pedidos por página.',
        ]);

        $pedidos = $request->user()
            ->vendas()
            ->when($dados['status'] ?? null, fn ($q, $status) => $q->where('status_venda', $status))
            ->with('itens.produto')
            ->orderByDesc('data_venda')
            ->orderByDesc('id_venda')
            ->paginate($dados['por_pagina'] ?? 10);

        return response()->json([
            'success' => true,
            'data' => $pedidos->items(),
            'meta' => [
                'pagina_atual' => $pedidos->currentPage(),
                'ultima_pagina' => $pedidos->lastPage(),
                'por_pagina' => $pedidos->perPage(),
                'total' => $pedidos->total(),
            ]
        ]);
    }


    public function show(Request $request, int $id): JsonResponse
    {
        $pedido = $this->buscar($request, $id)
            ->load('itens.produto', 'endereco', 'cupom');

        return response()->json([
            'success' => true,
            'data' => $pedido
        ]);
    }


    public function status(Request $request, int $id): JsonResponse
    {
        $pedido = $this->buscar($request, $id);

        return response()->json([
            'success' => true,
            'data' => [
                'id_venda' => $pedido->id_venda,
                'status_venda' => $pedido->status_venda,
                'status_descricao_venda' => $pedido->status_descricao_venda,
                'atualizado_em_venda' => $pedido->atualizado_em_venda,
            ]
        ]);
    }


    public function cancelar(Request $request, int $id): JsonResponse
    {
        $pedido = $this->buscar($request, $id);

        // O cliente só cancela enquanto a confeitaria ainda não confirmou
        if ($pedido->status_venda !== 'PENDENTE') {
            return response()->json([
                'success' => false,
                'message' => 'Este pedido não pode mais ser cancelado. Entre em contato com a confeitaria.'
            ], 422);
        }

        DB::transaction(function () use ($pedido) {
            $pedido->update(['status_venda' => 'CANCELADO']);
            $pedido->itens()->update(['status_item' => 'CANCELADO']);
        });

        return response()->json([
            'success' => true,
            'message' => 'Pedido cancelado com sucesso.',
            'data' => $pedido->fresh()->load('itens.produto', 'endereco', 'cupom')
        ]);
    }


    private function buscar(Request $request, int $id): Venda
    {
        return $request->user()
            ->vendas()
            ->where('id_venda', $id)
            ->firstOrFail();
    }


    public function store(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'itens' => 'required|array|min:1|max:50',
            'itens.*.id_produto' => 'required|integer',
            'itens.*.quantidade' => 'required|integer|min:1|max:99',
            'entrega' => 'required|in:SIM,NAO',
            'id_endereco' => 'required_if:entrega,SIM|nullable|integer',
            'forma_pagamento' => 'required|in:PIX,DINHEIRO,CARTAO',
            'data_entrega' => 'required|date|after:now',
            'observacao' => 'nullable|string|max:500',
            'codigo_cupom' => 'nullable|string|max:30',
        ], [
            'itens.required' => 'Informe ao menos um item.',
            'itens.min' => 'Informe ao menos um item.',
            'itens.max' => 'O pedido pode ter no máximo 50 itens.',
            'itens.*.id_produto.required' => 'Informe o produto de cada item.',
            'itens.*.quantidade.required' => 'Informe a quantidade de cada item.',
            'itens.*.quantidade.min' => 'A quantidade mínima é 1.',
            'itens.*.quantidade.max' => 'A quantidade máxima por item é 99.',
            'entrega.required' => 'Informe se é entrega (SIM) ou retirada (NAO).',
            'entrega.in' => 'Use SIM ou NAO em entrega.',
            'id_endereco.required_if' => 'Informe o endereço para entrega.',
            'forma_pagamento.required' => 'Informe a forma de pagamento.',
            'forma_pagamento.in' => 'Forma de pagamento inválida. Use PIX, DINHEIRO ou CARTAO.',
            'data_entrega.required' => 'Informe a data da entrega ou retirada.',
            'data_entrega.date' => 'Data inválida.',
            'data_entrega.after' => 'A data da entrega deve ser futura.',
            'observacao.max' => 'A observação deve ter no máximo 500 caracteres.',
        ]);

        $cliente = $request->user();
        $entrega = $dados['entrega'] === 'SIM';

        // Endereço: só entra se for entrega, e precisa ser do próprio cliente
        $idEndereco = null;
        if ($entrega) {
            $endereco = $cliente->enderecos()
                ->where('id_endereco', $dados['id_endereco'])
                ->where('status_endereco', 'ATIVO')
                ->first();

            if (!$endereco) {
                return response()->json([
                    'success' => false,
                    'message' => 'Endereço não encontrado.',
                    'errors' => ['id_endereco' => ['Endereço não encontrado.']]
                ], 422);
            }

            $idEndereco = $endereco->id_endereco;
        }

        // Itens repetidos são somados
        $quantidades = [];
        foreach ($dados['itens'] as $item) {
            $id = (int) $item['id_produto'];
            $quantidades[$id] = ($quantidades[$id] ?? 0) + (int) $item['quantidade'];
        }

        // O preço vem sempre do servidor, nunca do aplicativo
        $produtos = Produto::whereIn('id_produto', array_keys($quantidades))
            ->where('status_produto', 'ATIVO')
            ->whereHas('CategoriaProduto', function ($query) {
                $query->where('status_categoria', 'ATIVO');
            })
            ->get()
            ->keyBy('id_produto');

        $indisponiveis = array_values(array_diff(array_keys($quantidades), $produtos->keys()->all()));

        if ($indisponiveis) {
            return response()->json([
                'success' => false,
                'message' => 'Há produtos indisponíveis no pedido.',
                'errors' => ['itens' => ['Produtos indisponíveis: ' . implode(', ', $indisponiveis) . '.']]
            ], 422);
        }

        $subtotal = 0.0;
        foreach ($quantidades as $id => $qtde) {
            $subtotal += (float) $produtos[$id]->valor_produto * $qtde;
        }
        $subtotal = round($subtotal, 2);

        // Cupom: percentual sobre o subtotal, dentro da validade
        $cupom = null;
        $desconto = 0.0;
        $codigo = trim((string) ($dados['codigo_cupom'] ?? ''));

        if ($codigo !== '') {
            $cupom = Cupom::where('codigo_cupom', $codigo)
                ->where('status_cupom', 'ATIVO')
                ->where('data_inicio_cupom', '<=', now())
                ->where('data_fim_cupom', '>=', now())
                ->first();

            if (!$cupom) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cupom inválido ou expirado.',
                    'errors' => ['codigo_cupom' => ['Cupom inválido ou expirado.']]
                ], 422);
            }

            $percentual = min(max((float) $cupom->valor_desconto_cupom, 0), 100);
            $desconto = round($subtotal * $percentual / 100, 2);
        }

        $pedido = DB::transaction(function () use ($cliente, $dados, $idEndereco, $entrega, $cupom, $desconto, $subtotal, $quantidades, $produtos) {
            $venda = $cliente->vendas()->create([
                'id_endereco' => $idEndereco,
                'id_cupom' => $cupom?->id_cupom,
                'valor_venda' => round($subtotal - $desconto, 2),
                'forma_pagamento_venda' => $dados['forma_pagamento'],
                'entrega_venda' => $entrega ? 'SIM' : 'NAO',
                'observacao_venda' => $dados['observacao'] ?? null,
                'valor_desconto_venda' => $desconto,
                'status_venda' => 'PENDENTE',
                'data_entrega_venda' => $dados['data_entrega'],
            ]);

            foreach ($quantidades as $id => $qtde) {
                $venda->itens()->create([
                    'id_produto' => $id,
                    'valor_unit_item' => $produtos[$id]->valor_produto,
                    'qtde_item' => $qtde,
                    'status_item' => 'ATIVO',
                ]);
            }

            return $venda;
        });

        return response()->json([
            'success' => true,
            'message' => 'Pedido realizado com sucesso.',
            'data' => $pedido->fresh()->load('itens.produto', 'endereco', 'cupom')
        ], 201);
    }
}
