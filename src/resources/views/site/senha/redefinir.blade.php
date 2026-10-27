<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="no-referrer">
    <meta name="robots" content="noindex">
    <title>Redefinir senha - Confeitaria DaVilla</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 16px; background: #f6f1ec; font-family: Arial, Helvetica, sans-serif; color: #3b2a20; }
        .card { width: 100%; max-width: 400px; background: #fff; border-radius: 8px; padding: 28px; }
        h1 { margin: 0 0 8px; font-size: 22px; }
        p { margin: 0 0 16px; font-size: 14px; color: #7a6a5f; }
        label { display: block; margin-bottom: 4px; font-size: 13px; }
        input { width: 100%; padding: 11px; margin-bottom: 14px; border: 1px solid #d9cdc3; border-radius: 6px; font-size: 15px; }
        button { width: 100%; padding: 12px; border: 0; border-radius: 6px; background: #b5651d; color: #fff; font-size: 15px; cursor: pointer; }
        button:disabled { opacity: .6; cursor: default; }
        .msg { display: none; margin-bottom: 14px; padding: 10px; border-radius: 6px; font-size: 14px; }
        .msg.erro { display: block; background: #fdecea; color: #8a1f17; }
        .msg.ok { display: block; background: #e8f5e9; color: #1b5e20; }
    </style>
</head>
<body>
    <main class="card">
        <h1>Redefinir senha</h1>
        <p id="sub">Escolha uma nova senha para <strong>{{ $email }}</strong>.</p>
        <div id="msg" class="msg" role="alert"></div>
        <form id="form">
            <label for="senha">Nova senha (mín. 8 caracteres)</label>
            <input type="password" id="senha" minlength="8" required autocomplete="new-password">
            <label for="confirma">Confirmar nova senha</label>
            <input type="password" id="confirma" minlength="8" required autocomplete="new-password">
            <button type="submit" id="btn">Salvar nova senha</button>
        </form>
    </main>

    <script>
        const form = document.getElementById('form');
        const msg = document.getElementById('msg');
        const btn = document.getElementById('btn');

        function mostrar(texto, tipo) { msg.textContent = texto; msg.className = 'msg ' + tipo; }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            msg.className = 'msg';
            btn.disabled = true;

            try {
                const resposta = await fetch(@json(url('/api/v1/auth/redefinir-senha')), {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({
                        email: @json($email),
                        token: @json($token),
                        nova_senha: document.getElementById('senha').value,
                        nova_senha_confirmation: document.getElementById('confirma').value,
                    }),
                });
                const json = await resposta.json();

                if (json.success) {
                    form.style.display = 'none';
                    document.getElementById('sub').style.display = 'none';
                    mostrar(json.message + ' Volte ao aplicativo e entre com a nova senha.', 'ok');
                } else {
                    mostrar(json.message || 'Não foi possível redefinir a senha.', 'erro');
                    btn.disabled = false;
                }
            } catch (erro) {
                mostrar('Não foi possível conectar ao servidor.', 'erro');
                btn.disabled = false;
            }
        });
    </script>
</body>
</html>
