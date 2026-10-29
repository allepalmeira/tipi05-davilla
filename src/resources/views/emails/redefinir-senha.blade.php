<!doctype html>
<html lang="pt-BR">
<body style="margin:0;padding:24px;background:#f6f1ec;font-family:Arial,Helvetica,sans-serif;color:#3b2a20;">
    <div style="max-width:480px;margin:0 auto;background:#ffffff;border-radius:8px;padding:28px;">
        <h2 style="margin-top:0;">Olá, {{ $cliente->nome_cliente }}!</h2>
        <p>Recebemos uma solicitação para redefinir a senha da sua conta na Confeitaria DaVilla.</p>
        <p style="margin-bottom:8px;">Seu código de verificação é:</p>
        <p style="text-align:center;margin:8px 0 20px;">
            <span style="display:inline-block;background:#f6f1ec;border:2px dashed #b5651d;border-radius:8px;padding:12px 28px;font-size:36px;font-weight:bold;letter-spacing:10px;color:#b5651d;">{{ $codigo }}</span>
        </p>
        <p>Este código é válido por {{ $validadeMinutos }} minutos.</p>
        <p>Digite este código no aplicativo para continuar.</p>
        <p style="font-size:13px;color:#7a6a5f;">Se você não solicitou esta alteração, ignore este e-mail. Sua senha continuará a mesma.</p>
    </div>
</body>
</html>
