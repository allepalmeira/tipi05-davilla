<!doctype html>
<html lang="pt-BR">
<body style="margin:0;padding:24px;background:#f6f1ec;font-family:Arial,Helvetica,sans-serif;color:#3b2a20;">
    <div style="max-width:480px;margin:0 auto;background:#ffffff;border-radius:8px;padding:28px;">
        <h2 style="margin-top:0;">Olá, {{ $cliente->nome_cliente }}!</h2>
        <p>Recebemos um pedido para redefinir a senha da sua conta na Confeitaria DaVilla.</p>
        <p style="text-align:center;margin:28px 0;">
            <a href="{{ $url }}" style="background:#b5651d;color:#ffffff;text-decoration:none;padding:12px 24px;border-radius:6px;display:inline-block;">Redefinir minha senha</a>
        </p>
        <p style="font-size:13px;">O link vale por 60 minutos. Se o botão não funcionar, copie e cole este endereço no navegador:</p>
        <p style="font-size:12px;word-break:break-all;color:#7a6a5f;">{{ $url }}</p>
        <p style="font-size:13px;">Se você não fez esse pedido, ignore este e-mail. Sua senha continua a mesma.</p>
    </div>
</body>
</html>
