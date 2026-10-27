<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnderecoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $enderecos = $request->user()
            ->enderecos()
            ->where('status_endereco', 'ATIVO')
            ->orderByRaw("principal_endereco = 'SIM' DESC")
            ->orderBy('nome_endereco')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $enderecos
        ]);
    }


    public function show(Request $request, int $id): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->buscar($request, $id)
        ]);
    }


    public function store(Request $request): JsonResponse
    {
        $dados = $request->validate($this->regras(), $this->mensagens());

        $cliente = $request->user();

        $endereco = DB::transaction(function () use ($cliente, $dados) {
            $temAtivo = $cliente->enderecos()
                ->where('status_endereco', 'ATIVO')
                ->exists();

            // O primeiro endereço sempre é o principal
            $principal = !$temAtivo || ($dados['principal_endereco'] ?? 'NAO') === 'SIM';

            if ($principal) {
                $this->limparPrincipal($cliente->id_cliente);
            }

            $dados['uf'] = strtoupper($dados['uf']);
            $dados['principal_endereco'] = $principal ? 'SIM' : 'NAO';
            $dados['status_endereco'] = 'ATIVO';

            return $cliente->enderecos()->create($dados);
        });

        return response()->json([
            'success' => true,
            'message' => 'Endereço cadastrado com sucesso.',
            'data' => $endereco->fresh()
        ], 201);
    }


    public function update(Request $request, int $id): JsonResponse
    {
        $endereco = $this->buscar($request, $id);

        $dados = $request->validate($this->regras(true), $this->mensagens());

        DB::transaction(function () use ($endereco, $dados) {
            if (isset($dados['uf'])) {
                $dados['uf'] = strtoupper($dados['uf']);
            }

            // "NAO" é ignorado: o principal só muda ao marcar outro como "SIM"
            if (($dados['principal_endereco'] ?? null) === 'SIM') {
                $this->limparPrincipal($endereco->id_cliente);
            } else {
                unset($dados['principal_endereco']);
            }

            $endereco->update($dados);
        });

        return response()->json([
            'success' => true,
            'message' => 'Endereço atualizado com sucesso.',
            'data' => $endereco->fresh()
        ]);
    }


    public function principal(Request $request, int $id): JsonResponse
    {
        $endereco = $this->buscar($request, $id);

        DB::transaction(function () use ($endereco) {
            $this->limparPrincipal($endereco->id_cliente);
            $endereco->update(['principal_endereco' => 'SIM']);
        });

        return response()->json([
            'success' => true,
            'message' => 'Endereço principal atualizado.',
            'data' => $endereco->fresh()
        ]);
    }


    public function destroy(Request $request, int $id): JsonResponse
    {
        $endereco = $this->buscar($request, $id);

        DB::transaction(function () use ($endereco) {
            $eraPrincipal = $endereco->principal_endereco === 'SIM';

            $endereco->update([
                'status_endereco' => 'INATIVO',
                'principal_endereco' => 'NAO',
            ]);

            // Se o principal foi removido, o endereço ativo mais recente assume
            if ($eraPrincipal) {
                Endereco::where('id_cliente', $endereco->id_cliente)
                    ->where('status_endereco', 'ATIVO')
                    ->orderByDesc('id_endereco')
                    ->first()
                    ?->update(['principal_endereco' => 'SIM']);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Endereço removido com sucesso.'
        ]);
    }


    private function buscar(Request $request, int $id): Endereco
    {
        return $request->user()
            ->enderecos()
            ->where('id_endereco', $id)
            ->where('status_endereco', 'ATIVO')
            ->firstOrFail();
    }

    private function limparPrincipal(int $idCliente): void
    {
        Endereco::where('id_cliente', $idCliente)
            ->where('principal_endereco', 'SIM')
            ->update(['principal_endereco' => 'NAO']);
    }

    private function regras(bool $parcial = false): array
    {
        $obrigatorio = $parcial ? 'sometimes|required' : 'required';

        return [
            'nome_endereco' => "$obrigatorio|string|max:30",
            'endereco' => "$obrigatorio|string|max:40",
            'numero' => "$obrigatorio|string|max:6",
            'complemento' => 'nullable|string|max:50',
            'bairro' => "$obrigatorio|string|max:40",
            'cidade' => "$obrigatorio|string|max:40",
            'uf' => "$obrigatorio|string|size:2|alpha",
            'cep' => ["$obrigatorio", 'string', 'regex:/^\d{5}-?\d{3}$/'],
            'principal_endereco' => 'sometimes|in:SIM,NAO',
        ];
    }

    private function mensagens(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'uf.size' => 'A UF deve ter 2 letras.',
            'uf.alpha' => 'A UF deve ter 2 letras.',
            'cep.regex' => 'CEP inválido. Use 00000-000 ou 00000000.',
            'principal_endereco.in' => 'Use SIM ou NAO.',
        ];
    }
}
