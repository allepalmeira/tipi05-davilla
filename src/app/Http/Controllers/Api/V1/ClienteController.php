<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
   
    public function show(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ]);
    }


    public function update(Request $request): JsonResponse
    {
        $cliente = $request->user();

        $dados = $request->validate([
            'nome_cliente' => 'required|string|max:50',

            'tipo_cliente' => 'required|string|max:2',

            'cpf_cnpj_cliente' => [
                'required',
                'string',
                'max:18',
                Rule::unique(
                    'tbl_clientes',
                    'cpf_cnpj_cliente'
                )->ignore(
                    $cliente->id_cliente,
                    'id_cliente'
                ),
            ],

            'data_nasc_cliente' => 'required|date',

            'email_cliente' => [
                'required',
                'email',
                'max:80',
                Rule::unique(
                    'tbl_clientes',
                    'email_cliente'
                )->ignore(
                    $cliente->id_cliente,
                    'id_cliente'
                ),
            ],

            'telefone_cliente' => 'required|string|max:14',
        ]);

        $cliente->update($dados);

        return response()->json([
            'success' => true,
            'message' => 'Dados atualizados com sucesso.',
            'data' => $cliente->fresh()
        ]);
    }


    public function updateSenha(Request $request): JsonResponse
    {
        $cliente = $request->user();

        $dados = $request->validate([
            'senha_atual' => 'required|string',

            'nova_senha' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ]);

        if (
            !Hash::check(
                $dados['senha_atual'],
                $cliente->senha_cliente
            )
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Senha atual incorreta.'
            ], 422);
        }

        $cliente->senha_cliente = Hash::make(
            $dados['nova_senha']
        );

        $cliente->save();

        return response()->json([
            'success' => true,
            'message' => 'Senha atualizada com sucesso.'
        ]);
    }

    public function updateFoto(Request $request): JsonResponse
    {
        $request->validate([
            'foto_cliente' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'foto_cliente.required' => 'Envie a foto.',
            'foto_cliente.image' => 'O arquivo deve ser uma imagem.',
            'foto_cliente.mimes' => 'A foto deve ser JPG, PNG ou WEBP.',
            'foto_cliente.max' => 'A foto deve ter no máximo 2 MB.',
            'foto_cliente.uploaded' => 'Não foi possível enviar a foto. Verifique o tamanho (máx. 2 MB).',
        ]);

        $cliente = $request->user();
        $arquivo = $request->file('foto_cliente');

        $nome = 'cliente-' . $cliente->id_cliente . '-' . Str::lower(Str::random(8))
            . '.' . $arquivo->guessExtension();
        $pasta = public_path('davilla/images/cliente/');
        File::ensureDirectoryExists($pasta, 0775);
        $arquivo->move($pasta, $nome);

        $this->apagarFoto($cliente->foto_cliente);

        $cliente->update(['foto_cliente' => 'cliente/' . $nome]);

        return response()->json([
            'success' => true,
            'message' => 'Foto atualizada com sucesso.',
            'data' => $cliente->fresh()
        ]);
    }


    public function destroyFoto(Request $request): JsonResponse
    {
        $cliente = $request->user();

        $this->apagarFoto($cliente->foto_cliente);

        $cliente->update(['foto_cliente' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Foto removida com sucesso.',
            'data' => $cliente->fresh()
        ]);
    }


    // Só apaga arquivos da pasta de clientes, nunca de outras pastas
    private function apagarFoto(?string $caminho): void
    {
        if ($caminho && str_starts_with($caminho, 'cliente/') && !str_contains($caminho, '..')) {
            @unlink(public_path('davilla/images/' . $caminho));
        }
    }
}
