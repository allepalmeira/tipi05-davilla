<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
            'device_name' => 'nullable|string|max:100',
        ]);

        $cliente = Cliente::where(
            'email_cliente',
            $dados['email']
        )->first();

        if (
            !$cliente ||
            !Hash::check($dados['senha'], $cliente->senha_cliente)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'E-mail ou senha inválidos.'
            ], 401);
        }

        if ($cliente->status_cliente !== 'ATIVO') {
            return response()->json([
                'success' => false,
                'message' => 'Cliente inativo.'
            ], 403);
        }

        $nomeToken = $dados['device_name'] ?? 'app-mobile';

        // Evita acumular vários tokens com o mesmo nome.
        $cliente->tokens()
            ->where('name', $nomeToken)
            ->delete();

        $token = $cliente
            ->createToken($nomeToken)
            ->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login realizado com sucesso.',
            'data' => [
                'token' => $token,
                'cliente' => [
                    'id_cliente' => $cliente->id_cliente,
                    'nome_cliente' => $cliente->nome_cliente,
                    'email_cliente' => $cliente->email_cliente,
                    'telefone_cliente' => $cliente->telefone_cliente,
                ]
            ]
        ]);
    }


    public function logout(Request $request): JsonResponse
    {
        $request->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout realizado com sucesso.'
        ]);
    }
}