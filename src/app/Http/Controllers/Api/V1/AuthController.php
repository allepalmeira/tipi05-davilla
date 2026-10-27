<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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


    public function esqueciSenha(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email' => 'Informe um e-mail válido.',
        ]);

        $cliente = Cliente::where('email_cliente', $dados['email'])
            ->where('status_cliente', 'ATIVO')
            ->first();

        // A resposta é sempre a mesma, exista o e-mail ou não (evita descobrir quem é cliente)
        if ($cliente) {
            try {
                Password::broker('clientes')->sendResetLink(['email_cliente' => $cliente->email_cliente]);
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Se o e-mail estiver cadastrado, enviaremos um link para redefinir a senha.'
        ]);
    }


    public function redefinirSenha(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'nova_senha' => 'required|string|min:8|confirmed',
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'token.required' => 'Link inválido ou expirado. Solicite um novo.',
            'nova_senha.required' => 'Informe a nova senha.',
            'nova_senha.min' => 'A nova senha deve ter no mínimo 8 caracteres.',
            'nova_senha.confirmed' => 'A confirmação da nova senha não confere.',
        ]);

        $status = Password::broker('clientes')->reset(
            [
                'email_cliente' => $dados['email'],
                'password' => $dados['nova_senha'],
                'token' => $dados['token'],
            ],
            function (Cliente $cliente, string $senha) {
                $cliente->senha_cliente = Hash::make($senha);
                $cliente->save();

                // Encerra as sessões abertas em todos os aparelhos
                $cliente->tokens()->delete();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return response()->json([
                'success' => false,
                'message' => 'Link inválido ou expirado. Solicite um novo.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Senha redefinida com sucesso.'
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