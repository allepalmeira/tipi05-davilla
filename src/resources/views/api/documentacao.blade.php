<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>API — Confeitaria DaVilla</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
            margin: 0;
        }

        header {
            background: #691650;
            color: white;
            padding: 30px;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .endpoint {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .method {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            background: #198754;
            color: white;
            font-weight: bold;
        }

        code {
            background: #eee;
            padding: 4px 8px;
            border-radius: 4px;
        }

        pre {
            background: #1e1e1e;
            color: #eee;
            padding: 16px;
            overflow-x: auto;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<header>
    <h1>API — Confeitaria DaVilla</h1>

    <p>
        Documentação da API utilizada pelo aplicativo.
    </p>
</header>

<main>

    <h2>Informações</h2>

    <p>
        Versão:
        <strong>v1</strong>
    </p>

    <p>
        Base da API:
        <code>{{ url('/api/v1') }}</code>
    </p>


    <h2>Endpoints</h2>


    <div class="endpoint">

        <span class="method">GET</span>

        <code>/api/v1/status</code>

        <p>
            Verifica se a API está funcionando.
        </p>

    </div>


    <div class="endpoint">

        <span class="method">GET</span>

        <code>/api/v1/banners</code>

        <p>
            Retorna os banners ativos.
        </p>

    </div>


    <div class="endpoint">

        <span class="method">GET</span>

        <code>/api/v1/categorias</code>

        <p>
            Retorna as categorias ativas.
        </p>

    </div>


    <div class="endpoint">

        <span class="method">GET</span>

        <code>/api/v1/categorias/{id}/produtos</code>

        <p>
            Retorna os produtos ativos de uma categoria.
        </p>

    </div>


    <div class="endpoint">

        <span class="method">GET</span>

        <code>/api/v1/produtos</code>

        <p>
            Retorna todos os produtos ativos.
        </p>

    </div>


    <div class="endpoint">

        <span class="method">GET</span>

        <code>/api/v1/produtos/{slug}</code>

        <p>
            Retorna os detalhes de um produto.
        </p>

    </div>


    <h2>Exemplo de resposta</h2>

    <pre>
{
    "success": true,
    "data": {
        "aplicacao": "Confeitaria DaVilla",
        "api": "v1",
        "status": "online"
    }
}
    </pre>


    <h2>Próximas etapas</h2>

    <p>
        A API será expandida para autenticação,
        clientes, endereços, favoritos,
        depoimentos, cupons e pedidos.
    </p>

</main>

</body>
</html>