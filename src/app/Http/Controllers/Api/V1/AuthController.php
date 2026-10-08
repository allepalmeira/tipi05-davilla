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


    public function cadastro(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:50',
            'email' => 'required|email|max:80|unique:tbl_clientes,email_cliente',
            'telefone' => 'required|string|max:14',
            'senha' => 'required|string|min:8',
            'aceite_termo' => 'accepted',
            'device_name' => 'nullable|string|max:100',
        ], [
            'email.unique' => 'Este e-mail já está cadastrado.',
            'aceite_termo.accepted' => 'É necessário aceitar o termo de consentimento.',
        ]);

        $cliente = Cliente::create([
            'nome_cliente' => $dados['nome'],
            'email_cliente' => $dados['email'],
            'telefone_cliente' => $dados['telefone'],
            'senha_cliente' => Hash::make($dados['senha']),
            'status_cliente' => 'ATIVO',
            'termo_aceito_em_cliente' => now(),
        ]);

        // Já devolve o token para o app entrar logado após o cadastro.
        $token = $cliente
            ->createToken($dados['device_name'] ?? 'app-mobile')
            ->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Cadastro realizado com sucesso.',
            'data' => [
                'token' => $token,
                'cliente' => [
                    'id_cliente' => $cliente->id_cliente,
                    'nome_cliente' => $cliente->nome_cliente,
                    'email_cliente' => $cliente->email_cliente,
                    'telefone_cliente' => $cliente->telefone_cliente,
                ]
            ]
        ], 201);
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