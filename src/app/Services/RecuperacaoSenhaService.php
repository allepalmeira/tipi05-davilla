<?php

namespace App\Services;

use App\Mail\RedefinirSenhaMail;
use App\Models\Cliente;
use App\Models\CodigoRecuperacao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Recuperação de senha pelo aplicativo:
 * código de 4 dígitos por e-mail -> reset_token temporário -> nova senha.
 */
class RecuperacaoSenhaService
{
    const VALIDADE_CODIGO_MINUTOS = 5;
    const VALIDADE_RESET_MINUTOS = 10;
    const MAX_TENTATIVAS = 5;

    /**
     * Gera um código novo, invalida os anteriores e envia o e-mail.
     */
    public function solicitar(Cliente $cliente): void
    {
        $codigo = str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        DB::transaction(function () use ($cliente, $codigo) {
            // Registros antigos já encerrados não precisam ficar no banco
            CodigoRecuperacao::where('id_cliente', $cliente->id_cliente)
                ->where('created_at', '<', now()->subDay())
                ->delete();

            // O novo código invalida qualquer recuperação ainda aberta
            CodigoRecuperacao::where('id_cliente', $cliente->id_cliente)
                ->whereNull('consumido_em')
                ->update(['consumido_em' => now()]);

            CodigoRecuperacao::create([
                'id_cliente' => $cliente->id_cliente,
                'codigo_hash' => $this->hashCodigo($cliente->id_cliente, $codigo),
                'tentativas' => 0,
                'expira_em' => now()->addMinutes(self::VALIDADE_CODIGO_MINUTOS),
            ]);
        });

        Mail::to($cliente->email_cliente)->send(
            new RedefinirSenhaMail($cliente, $codigo, self::VALIDADE_CODIGO_MINUTOS)
        );
    }

    /**
     * Confere o código digitado. Se estiver certo, devolve o reset_token (em texto,
     * somente nesta resposta). Se estiver errado, expirado ou bloqueado, devolve null.
     */
    public function validarCodigo(Cliente $cliente, string $codigo): ?string
    {
        return DB::transaction(function () use ($cliente, $codigo) {
            // Bloqueia a linha: tentativas em paralelo não podem burlar o limite
            $registro = CodigoRecuperacao::where('id_cliente', $cliente->id_cliente)
                ->whereNull('consumido_em')
                ->whereNull('validado_em')
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            if (!$registro || $registro->expira_em->isPast() || $registro->tentativas >= self::MAX_TENTATIVAS) {
                return null;
            }

            if (!hash_equals($registro->codigo_hash, $this->hashCodigo($cliente->id_cliente, $codigo))) {
                $registro->increment('tentativas');

                return null;
            }

            $resetToken = bin2hex(random_bytes(32));

            $registro->update([
                'validado_em' => now(),
                'reset_token_hash' => hash('sha256', $resetToken),
                'reset_expira_em' => now()->addMinutes(self::VALIDADE_RESET_MINUTOS),
            ]);

            return $resetToken;
        });
    }

    /**
     * Troca a senha usando o reset_token. Uso único. Encerra todas as sessões do cliente.
     */
    public function redefinir(string $resetToken, string $novaSenha): bool
    {
        return DB::transaction(function () use ($resetToken, $novaSenha) {
            $registro = CodigoRecuperacao::where('reset_token_hash', hash('sha256', $resetToken))
                ->whereNotNull('validado_em')
                ->whereNull('consumido_em')
                ->where('reset_expira_em', '>', now())
                ->lockForUpdate()
                ->first();

            if (!$registro) {
                return false;
            }

            $cliente = Cliente::where('id_cliente', $registro->id_cliente)
                ->where('status_cliente', 'ATIVO')
                ->lockForUpdate()
                ->first();

            if (!$cliente) {
                return false;
            }

            $cliente->senha_cliente = Hash::make($novaSenha);
            $cliente->save();

            // Encerra qualquer outra recuperação aberta e o próprio registro
            CodigoRecuperacao::where('id_cliente', $cliente->id_cliente)
                ->whereNull('consumido_em')
                ->update(['consumido_em' => now()]);

            // Exige novo login em todos os aparelhos
            $cliente->tokens()->delete();

            return true;
        });
    }

    /**
     * Hash do código com a chave da aplicação (HMAC): como são só 10.000 códigos possíveis,
     * quem obtivesse o banco conseguiria testar todos contra um hash comum. Com a chave do
     * servidor isso deixa de ser possível sem acesso ao .env.
     */
    private function hashCodigo(int $idCliente, string $codigo): string
    {
        return hash_hmac('sha256', $idCliente . '|' . $codigo, (string) config('app.key'));
    }
}
