<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>API Reference — Confeitaria DaVilla</title>

    <meta name="api-base" content="{{ url('/api/v1') }}">
    <meta name="app-base" content="{{ url('/') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand: #691650;
            --brand-soft: #f6eaf2;
            --text: #1a1f36;
            --text-muted: #5c6378;
            --border: #e3e8ee;
            --bg: #ffffff;
            --bg-soft: #f7f9fc;
            --code-bg: #1b1f2b;
            --code-bg-2: #232837;
            --code-border: #30364a;
            --code-text: #d6deeb;

            --get: #0f9d58;
            --post: #2563eb;
            --put: #d97706;
            --patch: #0891b2;
            --delete: #dc2626;

            --sidebar-w: 270px;
            --topbar-h: 60px;
            --font: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            --mono: 'JetBrains Mono', ui-monospace, SFMono-Regular, Consolas, monospace;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; scroll-padding-top: calc(var(--topbar-h) + 16px); }

        body {
            margin: 0;
            font-family: var(--font);
            font-size: 15px;
            line-height: 1.6;
            color: var(--text);
            background: var(--bg);
            -webkit-font-smoothing: antialiased;
        }

        a { color: var(--brand); text-decoration: none; }
        a:hover { text-decoration: underline; }

        code {
            font-family: var(--mono);
            font-size: 0.86em;
            background: var(--bg-soft);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 1px 6px;
        }

        /* ===================== TOPBAR ===================== */
        .topbar {
            position: fixed;
            inset: 0 0 auto 0;
            height: var(--topbar-h);
            z-index: 50;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--border);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 16px;
            color: var(--text);
            white-space: nowrap;
        }

        .brand:hover { text-decoration: none; }

        .brand-logo {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--brand);
            color: #fff;
            display: grid;
            place-items: center;
            font-size: 15px;
        }

        .brand small {
            font-weight: 500;
            color: var(--text-muted);
        }

        .badge-version {
            font-size: 12px;
            font-weight: 600;
            color: var(--brand);
            background: var(--brand-soft);
            border-radius: 999px;
            padding: 2px 10px;
        }

        .topbar-base {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
        }

        .server-select {
            font: 600 13px var(--font);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 5px 8px;
            background: #fff;
            cursor: pointer;
        }

        .topbar-base code {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 340px;
        }

        .menu-toggle {
            display: none;
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 18px;
            line-height: 1;
            cursor: pointer;
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            position: fixed;
            top: var(--topbar-h);
            bottom: 0;
            left: 0;
            width: var(--sidebar-w);
            overflow-y: auto;
            padding: 20px 14px 40px;
            background: var(--bg-soft);
            border-right: 1px solid var(--border);
            z-index: 40;
        }

        .search {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font: inherit;
            font-size: 14px;
            background: #fff;
            margin-bottom: 18px;
        }

        .search:focus { outline: 2px solid var(--brand-soft); border-color: var(--brand); }

        .nav-group { margin-bottom: 18px; }

        .nav-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            padding: 0 10px;
            margin-bottom: 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border-radius: 6px;
            color: var(--text);
            font-size: 14px;
        }

        .nav-link:hover { background: #eef1f6; text-decoration: none; }

        .nav-link.active {
            background: var(--brand-soft);
            color: var(--brand);
            font-weight: 600;
        }

        .nav-link .method { font-size: 9px; min-width: 42px; }

        .nav-empty {
            display: none;
            font-size: 13px;
            color: var(--text-muted);
            padding: 0 10px;
        }

        /* ===================== CONTEÚDO ===================== */
        .content {
            margin-left: var(--sidebar-w);
            padding-top: var(--topbar-h);
            /* coluna escura contínua à direita (estilo Stripe) */
            background: linear-gradient(to right, var(--bg) 50%, var(--code-bg) 50%);
        }

        .section {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            border-bottom: 1px solid var(--border);
        }

        .section:last-child { border-bottom: 0; }

        .doc {
            padding: 48px 48px 48px;
            background: var(--bg);
        }

        .code {
            padding: 48px 32px;
            background: var(--code-bg);
            color: var(--code-text);
            border-bottom: 1px solid var(--code-border);
        }

        .code-sticky { position: sticky; top: calc(var(--topbar-h) + 24px); }

        .doc h1 {
            font-size: 32px;
            line-height: 1.2;
            margin: 0 0 12px;
            letter-spacing: -0.02em;
        }

        .doc h2 {
            font-size: 24px;
            line-height: 1.3;
            margin: 0 0 8px;
            letter-spacing: -0.01em;
        }

        .doc h3 {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin: 32px 0 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border);
        }

        .doc p { margin: 0 0 14px; color: #3c4257; }

        .lead { font-size: 17px; color: var(--text-muted) !important; }

        .group-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--brand);
            margin-bottom: 6px;
        }

        /* Linha do endpoint: método + caminho */
        .endpoint-line {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin: 14px 0 18px;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--bg-soft);
        }

        .endpoint-line .path {
            font-family: var(--mono);
            font-size: 14px;
            word-break: break-all;
        }

        .path .param { color: var(--brand); font-weight: 500; }

        .method {
            display: inline-block;
            font-family: var(--mono);
            font-size: 11px;
            font-weight: 700;
            text-align: center;
            letter-spacing: 0.03em;
            color: #fff;
            border-radius: 4px;
            padding: 2px 7px;
        }

        .method.get { background: var(--get); }
        .method.post { background: var(--post); }
        .method.put { background: var(--put); }
        .method.patch { background: var(--patch); }
        .method.delete { background: var(--delete); }

        .auth-tag {
            margin-left: auto;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 999px;
            padding: 2px 10px;
        }

        .auth-tag.private { color: #92400e; background: #fef3c7; }
        .auth-tag.public { color: #065f46; background: #d1fae5; }

        /* Tabela de parâmetros */
        .params { list-style: none; margin: 0; padding: 0; }

        .params li {
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .params li:last-child { border-bottom: 0; }

        .param-head {
            display: flex;
            align-items: baseline;
            gap: 8px;
            flex-wrap: wrap;
        }

        .param-name {
            font-family: var(--mono);
            font-size: 13.5px;
            font-weight: 600;
        }

        .param-type { font-size: 12.5px; color: var(--text-muted); }

        .param-req {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #c2410c;
        }

        .param-opt {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .param-desc { font-size: 14px; color: #3c4257; margin-top: 2px; }

        /* Tabela simples */
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-bottom: 14px;
        }

        .table th,
        .table td {
            text-align: left;
            padding: 9px 10px;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
        }

        .table th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--text-muted);
        }

        .status {
            font-family: var(--mono);
            font-weight: 600;
            font-size: 13px;
        }

        .s2 { color: var(--get); }
        .s4 { color: #c2410c; }
        .s5 { color: var(--delete); }

        .callout {
            border-left: 3px solid var(--brand);
            background: var(--brand-soft);
            border-radius: 0 6px 6px 0;
            padding: 10px 14px;
            font-size: 14px;
            margin: 0 0 14px;
            color: #3c4257;
        }

        .callout.warn { border-color: #d97706; background: #fffbeb; }

        .btn-postman {
            border: 0;
            background: #ff6c37;
            color: #fff;
            font: 600 13px var(--font);
            padding: 7px 14px;
            border-radius: 6px;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-postman:hover { background: #e85a28; }

        .topbar-base + .btn-postman { margin-left: 4px; }

        .steps { margin: 0 0 14px; padding-left: 20px; color: #3c4257; }
        .steps li { margin-bottom: 6px; }

        /* ===================== BLOCOS DE CÓDIGO ===================== */
        .code-title {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #8b94ad;
            margin: 0 0 10px;
        }

        .code-title:not(:first-child) { margin-top: 28px; }

        .block {
            background: var(--code-bg-2);
            border: 1px solid var(--code-border);
            border-radius: 8px;
            overflow: hidden;
        }

        .block-head {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 6px 8px;
            border-bottom: 1px solid var(--code-border);
            background: #1f2433;
        }

        .tab {
            border: 0;
            background: transparent;
            color: #8b94ad;
            font: 500 12px var(--mono);
            padding: 4px 9px;
            border-radius: 5px;
            cursor: pointer;
        }

        .tab:hover { color: #fff; }
        .tab.active { background: #30364a; color: #fff; }

        .tab .dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-right: 6px;
            vertical-align: 1px;
        }

        .dot.s2 { background: var(--get); }
        .dot.s4 { background: #f59e0b; }

        .copy {
            margin-left: auto;
            border: 1px solid var(--code-border);
            background: transparent;
            color: #8b94ad;
            font: 500 11px var(--font);
            padding: 3px 9px;
            border-radius: 5px;
            cursor: pointer;
        }

        .copy:hover { color: #fff; border-color: #4a5270; }

        .panel { display: none; }
        .panel.active { display: block; }

        pre {
            margin: 0;
            padding: 16px;
            overflow-x: auto;
            font-family: var(--mono);
            font-size: 12.5px;
            line-height: 1.65;
            color: var(--code-text);
            max-height: 460px;
        }

        pre code {
            background: none;
            border: 0;
            padding: 0;
            font-size: inherit;
        }

        /* Syntax highlight */
        .tk-key { color: #82aaff; }
        .tk-str { color: #c3e88d; }
        .tk-num { color: #f78c6c; }
        .tk-bool { color: #c792ea; }
        .tk-null { color: #c792ea; font-style: italic; }
        .tk-cmd { color: #ffcb6b; }
        .tk-flag { color: #89ddff; }
        .tk-kw { color: #c792ea; }

        /* ===================== RESPONSIVO ===================== */
        @media (max-width: 1100px) {
            .content { background: var(--bg); }
            .section { grid-template-columns: 1fr; }
            .code { padding: 28px 24px 36px; }
            .code-sticky { position: static; }
            .doc { padding: 40px 32px 28px; }
        }

        @media (max-width: 820px) {
            .menu-toggle { display: inline-block; }
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.2s ease;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            }
            .sidebar.open { transform: translateX(0); }
            .content { margin-left: 0; }
            .topbar { gap: 10px; padding: 0 12px; }
            .topbar-base code { display: none; }
            .brand small { display: none; }
            .topbar .btn-postman { padding: 6px 10px; font-size: 12px; }
            .badge-version { display: none; }
            .doc { padding: 32px 16px 24px; }
            .code { padding: 24px 16px 32px; }
            .doc h1 { font-size: 26px; }
            .auth-tag { margin-left: 0; }
        }
    </style>
</head>

<body>
@verbatim

<!-- ===================== TOPBAR ===================== -->
<header class="topbar">
    <button class="menu-toggle" type="button" aria-label="Abrir menu" id="menuToggle">☰</button>

    <a href="#introducao" class="brand">
        <span class="brand-logo">D</span>
        DaVilla <small>API Reference</small>
    </a>

    <span class="badge-version">v1</span>

    <div class="topbar-base">
        <select id="servidor" class="server-select" aria-label="Ambiente"></select>
        <code class="js-base">{{BASE_URL}}</code>
    </div>

    <button type="button" class="btn-postman js-postman">⬇ Coleção Postman</button>
</header>

<!-- ===================== SIDEBAR ===================== -->
<nav class="sidebar" id="sidebar">
    <input type="search" class="search" id="search" placeholder="Buscar endpoint..." aria-label="Buscar endpoint">

    <div class="nav-group">
        <div class="nav-title">Primeiros passos</div>
        <a class="nav-link" href="#introducao">Introdução</a>
        <a class="nav-link" href="#autenticacao">Autenticação</a>
        <a class="nav-link" href="#postman">Testando no Postman</a>
        <a class="nav-link" href="#respostas">Respostas e erros</a>
        <a class="nav-link" href="#imagens">Imagens</a>
    </div>

    <div class="nav-group">
        <div class="nav-title">Geral</div>
        <a class="nav-link" href="#get-status"><span class="method get">GET</span> Status da API</a>
    </div>

    <div class="nav-group">
        <div class="nav-title">Autenticação</div>
        <a class="nav-link" href="#post-login"><span class="method post">POST</span> Login</a>
        <a class="nav-link" href="#post-cadastro"><span class="method post">POST</span> Cadastro</a>
        <a class="nav-link" href="#post-esqueci-senha"><span class="method post">POST</span> Esqueci minha senha</a>
        <a class="nav-link" href="#post-redefinir-senha"><span class="method post">POST</span> Redefinir senha</a>
        <a class="nav-link" href="#post-logout"><span class="method post">POST</span> Logout</a>
    </div>

    <div class="nav-group">
        <div class="nav-title">Cliente</div>
        <a class="nav-link" href="#get-cliente"><span class="method get">GET</span> Dados do cliente</a>
        <a class="nav-link" href="#put-cliente"><span class="method put">PUT</span> Atualizar cliente</a>
        <a class="nav-link" href="#put-cliente-senha"><span class="method put">PUT</span> Alterar senha</a>
        <a class="nav-link" href="#post-cliente-foto"><span class="method post">POST</span> Enviar foto</a>
        <a class="nav-link" href="#delete-cliente-foto"><span class="method delete">DELETE</span> Remover foto</a>
    </div>

    <div class="nav-group">
        <div class="nav-title">Pedidos</div>
        <a class="nav-link" href="#post-pedidos"><span class="method post">POST</span> Criar pedido</a>
        <a class="nav-link" href="#get-pedidos"><span class="method get">GET</span> Histórico de pedidos</a>
        <a class="nav-link" href="#get-pedido"><span class="method get">GET</span> Detalhar pedido</a>
        <a class="nav-link" href="#get-pedido-status"><span class="method get">GET</span> Status do pedido</a>
        <a class="nav-link" href="#put-pedido-cancelar"><span class="method put">PUT</span> Cancelar pedido</a>
    </div>

    <div class="nav-group">
        <div class="nav-title">Endereços</div>
        <a class="nav-link" href="#get-enderecos"><span class="method get">GET</span> Listar endereços</a>
        <a class="nav-link" href="#post-enderecos"><span class="method post">POST</span> Cadastrar endereço</a>
        <a class="nav-link" href="#get-endereco"><span class="method get">GET</span> Detalhar endereço</a>
        <a class="nav-link" href="#put-endereco"><span class="method put">PUT</span> Atualizar endereço</a>
        <a class="nav-link" href="#put-endereco-principal"><span class="method put">PUT</span> Definir principal</a>
        <a class="nav-link" href="#delete-endereco"><span class="method delete">DELETE</span> Remover endereço</a>
    </div>

    <div class="nav-group">
        <div class="nav-title">Favoritos</div>
        <a class="nav-link" href="#get-favoritos"><span class="method get">GET</span> Listar favoritos</a>
        <a class="nav-link" href="#post-favoritos"><span class="method post">POST</span> Favoritar produto</a>
        <a class="nav-link" href="#delete-favoritos"><span class="method delete">DELETE</span> Remover favorito</a>
    </div>

    <div class="nav-group">
        <div class="nav-title">Conteúdo</div>
        <a class="nav-link" href="#get-banners"><span class="method get">GET</span> Listar banners</a>
    </div>

    <div class="nav-group">
        <div class="nav-title">Catálogo</div>
        <a class="nav-link" href="#get-categorias"><span class="method get">GET</span> Listar categorias</a>
        <a class="nav-link" href="#get-categoria-produtos"><span class="method get">GET</span> Produtos da categoria</a>
        <a class="nav-link" href="#get-produtos"><span class="method get">GET</span> Listar produtos</a>
        <a class="nav-link" href="#get-produto"><span class="method get">GET</span> Detalhar produto</a>
    </div>

    <p class="nav-empty" id="navEmpty">Nenhum resultado.</p>
</nav>

<!-- ===================== CONTEÚDO ===================== -->
<main class="content">

    <!-- ========== INTRODUÇÃO ========== -->
    <section class="section" id="introducao">
        <div class="doc">
            <div class="group-label">API Reference</div>
            <h1>API — Confeitaria DaVilla</h1>
            <p class="lead">
                API REST utilizada pelo aplicativo da Confeitaria DaVilla para consultar o catálogo,
                os banners e gerenciar a conta do cliente.
            </p>

            <p>
                A API segue o padrão REST, recebe e retorna dados em <strong>JSON</strong> e usa
                os códigos de status HTTP para indicar sucesso ou falha de cada requisição.
            </p>

            <h3>Base URL</h3>
            <p>
                Todas as rotas desta documentação são relativas à URL base do ambiente.
                Troque o ambiente no seletor do topo para atualizar todos os exemplos.
            </p>
            <table class="table">
                <thead>
                    <tr><th>Ambiente</th><th>URL base</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Produção</td>
                        <td><code>https://xyzcode.tipi5.smpsistema.com.br/davilla/api/v1</code></td>
                    </tr>
                    <tr>
                        <td>Local (Docker)</td>
                        <td><code>http://localhost:8081/api/v1</code></td>
                    </tr>
                </tbody>
            </table>
            <p>Selecionado agora: <code class="js-base">{{BASE_URL}}</code></p>

            <h3>Consumindo a API</h3>
            <p>
                A API é consumida pelo <strong>aplicativo React Native</strong> e testada pelo
                <a href="#postman"><strong>Postman</strong></a>. Cada endpoint traz exemplos nas abas
                <em>cURL</em>, <em>React Native</em> e <em>Postman</em>.
            </p>
            <p>
                Os exemplos em React Native seguem o padrão do aplicativo: <code>fetch</code> com a URL de
                <code>@/config/api</code>, token salvo no <code>AsyncStorage</code> e navegação com
                <code>expo-router</code>.
            </p>
            <p>
                Antes de usar <code>json.data</code>, verifique sempre <code>resposta.ok</code>. Em caso de erro,
                a API devolve uma <code>message</code> em português, pronta para exibir ao usuário.
            </p>

            <div class="callout warn">
                No React Native, <code>localhost</code> aponta para o próprio celular/emulador, não para o
                computador. Use <code>10.0.2.2</code> no emulador Android ou o IP do computador na rede
                (ex.: <code>192.168.0.10</code>) em um celular físico.
            </div>

            <h3>Cabeçalhos</h3>
            <table class="table">
                <thead>
                    <tr><th>Cabeçalho</th><th>Valor</th><th>Uso</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>Accept</code></td>
                        <td><code>application/json</code></td>
                        <td>Sempre. Garante que erros também sejam retornados em JSON.</td>
                    </tr>
                    <tr>
                        <td><code>Content-Type</code></td>
                        <td><code>application/json</code></td>
                        <td>Requisições com corpo (POST, PUT, PATCH).</td>
                    </tr>
                    <tr>
                        <td><code>Authorization</code></td>
                        <td><code>Bearer {token}</code></td>
                        <td>Rotas protegidas.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">config/api.js</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="js">// Emulador Android: http://10.0.2.2:8081/api/v1
// Celular físico:   http://IP-DO-COMPUTADOR:8081/api/v1
export const API = "{{BASE_URL}}";

// Fotos de produtos e banners
export const IMAGENS = API.replace("/api/v1", "/davilla/images/");</code></pre></div>
                </div>

                <div class="code-title">Requisição de teste</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/status \
  -H "Accept: application/json"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import { API } from "@/config/api";

const resposta = await fetch(`${API}/status`, {
  headers: { Accept: "application/json" },
});

const json = await resposta.json();
console.log(json.data.status); // "online"</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== AUTENTICAÇÃO ========== -->
    <section class="section" id="autenticacao">
        <div class="doc">
            <h2>Autenticação</h2>
            <p>
                A API usa <strong>Laravel Sanctum</strong> com tokens do tipo <em>Bearer</em>.
                O token é obtido em <a href="#post-login"><code>POST /auth/login</code></a> e deve ser
                enviado no cabeçalho <code>Authorization</code> de todas as rotas protegidas.
            </p>

            <p>
                As rotas marcadas com <span class="auth-tag private" style="margin-left:0">🔒 Token</span>
                exigem autenticação. As marcadas com <span class="auth-tag public" style="margin-left:0">Pública</span>
                podem ser acessadas livremente.
            </p>

            <div class="callout">
                Cada login com o mesmo <code>device_name</code> revoga o token anterior daquele dispositivo.
                O logout revoga apenas o token usado na requisição.
            </div>

            <div class="callout warn">
                No aplicativo, salve o token após o login (ex.: <code>AsyncStorage</code> ou
                <code>expo-secure-store</code>) e remova-o no logout. Nunca o exponha em URLs ou logs.
            </div>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição autenticada</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/cliente \
  -H "Accept: application/json" \
  -H "Authorization: Bearer 1|aB3dE5fG7hI9jK1lM3nO5pQ7rS9tU1vW3xY5z"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { router } from "expo-router";
import { API } from "@/config/api";

const token = await AsyncStorage.getItem("token");

const resposta = await fetch(`${API}/cliente`, {
  headers: {
    Accept: "application/json",
    Authorization: `Bearer ${token}`,
  },
});

// Token expirado ou inválido: volta para o login
if (resposta.status === 401) {
  await AsyncStorage.removeItem("token");
  router.replace("/login");
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POSTMAN ========== -->
    <section class="section" id="postman">
        <div class="doc">
            <h2>Testando no Postman</h2>
            <p>
                A coleção do Postman é gerada a partir desta documentação, com todas as rotas já
                configuradas, separadas em pastas.
            </p>

            <p>
                <button type="button" class="btn-postman js-postman">⬇ Baixar coleção Postman</button>
            </p>

            <h3>Importar</h3>
            <ol class="steps">
                <li>Clique em <strong>Baixar coleção Postman</strong>.</li>
                <li>No Postman, clique em <strong>Import</strong> e selecione o arquivo <code>.json</code> baixado.</li>
                <li>Execute <strong>Autenticação › Login</strong> com um e-mail e senha válidos.</li>
                <li>Pronto: o token é salvo na variável <code>{{token}}</code> e usado nas rotas protegidas.</li>
            </ol>

            <h3>Variáveis da coleção</h3>
            <table class="table">
                <thead>
                    <tr><th>Variável</th><th>Valor</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>{{base_url}}</code></td>
                        <td><code class="js-base">{{BASE_URL}}</code></td>
                    </tr>
                    <tr>
                        <td><code>{{token}}</code></td>
                        <td>Preenchida automaticamente após o login ou o cadastro.</td>
                    </tr>
                    <tr>
                        <td><code>{{endereco_id}}</code></td>
                        <td>Preenchida ao executar <strong>Endereços › Cadastrar endereço</strong>. Usada nas rotas de endereço e no pedido com entrega.</td>
                    </tr>
                    <tr>
                        <td><code>{{pedido_id}}</code></td>
                        <td>Preenchida ao executar <strong>Pedidos › Criar pedido</strong>. Usada em detalhar, status e cancelar.</td>
                    </tr>
                    <tr>
                        <td><code>{{data_entrega}}</code></td>
                        <td>Calculada automaticamente (2 dias à frente, às 15h), para o pedido sempre ter uma data futura.</td>
                    </tr>
                    <tr>
                        <td><code>{{codigo_cupom}}</code></td>
                        <td>Vazia por padrão (pedido sem cupom). Preencha com um cupom válido para testar o desconto.</td>
                    </tr>
                </tbody>
            </table>

            <p>
                As pastas seguem a ordem de um fluxo completo (cadastro, endereço, favoritos, pedido), então é possível
                executar a coleção inteira no <strong>Runner</strong>. O <strong>Logout</strong> encerra o token; para
                rodar tudo de uma vez, deixe-o por último ou desmarque-o. O cadastro de exemplo usa um e-mail fixo e só
                funciona uma vez: troque o e-mail para repetir.
            </p>

            <p>
                A coleção é baixada com o <code>{{base_url}}</code> do ambiente selecionado no topo da página.
                Para trocar depois, edite a variável na aba <strong>Variables</strong> da coleção.
                As rotas protegidas herdam a autenticação da coleção (<em>Bearer Token</em> com <code>{{token}}</code>).
            </p>

            <div class="callout">
                Também é possível importar um único endpoint: copie o exemplo da aba <strong>cURL</strong> e use
                <strong>Import › Raw text</strong> no Postman.
            </div>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Login › Scripts › Post-response</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">JavaScript</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="js">// Já incluído na coleção: salva o token após o login
const json = pm.response.json();

if (json.success) {
  pm.collectionVariables.set('token', json.data.token);
}</code></pre></div>
                </div>

                <div class="code-title">Autenticação das rotas protegidas</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">Postman</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="postman">Authorization
  Auth Type: Bearer Token
  Token:     {{token}}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== RESPOSTAS E ERROS ========== -->
    <section class="section" id="respostas">
        <div class="doc">
            <h2>Respostas e erros</h2>
            <p>
                As respostas de sucesso seguem um envelope padrão com <code>success</code>,
                <code>data</code> e, em algumas operações, <code>message</code>.
            </p>

            <h3>Códigos de status</h3>
            <table class="table">
                <thead>
                    <tr><th>Status</th><th>Significado</th></tr>
                </thead>
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Requisição concluída com sucesso.</td></tr>
                    <tr><td><span class="status s2">201</span></td><td>Recurso criado (ex.: cadastro de cliente).</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente, inválido ou credenciais incorretas.</td></tr>
                    <tr><td><span class="status s4">403</span></td><td>Acesso negado (ex.: cliente inativo).</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Recurso não encontrado ou inativo.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Erro de validação nos dados enviados.</td></tr>
                    <tr><td><span class="status s4">429</span></td><td>Muitas requisições em pouco tempo. Aguarde e tente novamente.</td></tr>
                    <tr><td><span class="status s5">500</span></td><td>Erro interno no servidor.</td></tr>
                </tbody>
            </table>

            <p>
                Todo erro retorna <code>"success": false</code> e uma <code>message</code> em português,
                pronta para ser exibida ao usuário. Em erros de validação (<span class="status s4">422</span>),
                o objeto <code>errors</code> traz também a lista de mensagens de cada campo inválido.
            </p>

            <div class="callout">
                No aplicativo, verifique sempre <code>resposta.ok</code> (ou <code>json.success</code>) antes de
                usar <code>json.data</code>. Em caso de <span class="status s4">401</span> em uma rota protegida,
                apague o token salvo e leve o usuário para a tela de login.
            </div>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Formato das respostas</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>Sucesso</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>Erro</button>
                        <button class="tab" data-panel="2"><span class="dot s4"></span>Validação</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Mensagem opcional.",
  "data": { }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "E-mail ou senha inválidos."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "O campo e-mail é obrigatório.",
  "errors": {
    "email": ["O campo e-mail é obrigatório."],
    "senha": ["O campo senha é obrigatório."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== IMAGENS ========== -->
    <section class="section" id="imagens">
        <div class="doc">
            <h2>Imagens</h2>
            <p>
                Campos de imagem como <code>foto_produto</code>, <code>foto_banner</code> e <code>foto_cliente</code> retornam um
                <strong>caminho relativo</strong>. Para montar a URL completa, concatene com:
            </p>
            <p><code class="js-images">{{IMAGES_URL}}</code></p>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Montando a URL</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="js">import { Image } from "react-native";
import { IMAGENS } from "@/config/api";

// produto.foto_produto = "produto/bolo-banana-fit.png"
&lt;Image
  source={{ uri: IMAGENS + produto.foto_produto }}
  style={{ width: 120, height: 120 }}
/&gt;</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /status ========== -->
    <section class="section" id="get-status">
        <div class="doc">
            <div class="group-label">Geral</div>
            <h2>Status da API</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/status</span>
                <span class="auth-tag public">Pública</span>
            </div>

            <p>Verifica se a API está online. Útil para testes de conexão e monitoramento.</p>

            <h3>Parâmetros</h3>
            <p>Esta rota não recebe parâmetros.</p>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/status \
  -H "Accept: application/json"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import { API } from "@/config/api";

const resposta = await fetch(`${API}/status`, {
  headers: { Accept: "application/json" },
});

const json = await resposta.json();</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": {
    "aplicacao": "Confeitaria DaVilla",
    "api": "v1",
    "status": "online"
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POST /auth/login ========== -->
    <section class="section" id="post-login">
        <div class="doc">
            <div class="group-label">Autenticação</div>
            <h2>Login</h2>

            <div class="endpoint-line">
                <span class="method post">POST</span>
                <span class="path">/auth/login</span>
                <span class="auth-tag public">Pública</span>
            </div>

            <p>
                Autentica o cliente com e-mail e senha e retorna um token de acesso.
                Apenas clientes com status <code>ATIVO</code> conseguem entrar.
            </p>

            <h3>Corpo da requisição</h3>
            <ul class="params">
                <li>
                    <div class="param-head">
                        <span class="param-name">email</span>
                        <span class="param-type">string</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">E-mail do cliente.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">senha</span>
                        <span class="param-type">string</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Senha do cliente.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">device_name</span>
                        <span class="param-type">string · máx. 100</span>
                        <span class="param-opt">opcional</span>
                    </div>
                    <div class="param-desc">
                        Nome do dispositivo. Padrão: <code>app-mobile</code>. Um novo login com o mesmo
                        nome revoga o token anterior.
                    </div>
                </li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Login realizado. Retorna o token e os dados básicos do cliente.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>E-mail ou senha inválidos.</td></tr>
                    <tr><td><span class="status s4">403</span></td><td>Cliente inativo.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Campos obrigatórios ausentes ou inválidos.</td></tr>
                    <tr><td><span class="status s4">429</span></td><td>Mais de 5 tentativas por minuto para o mesmo e-mail.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X POST {{BASE_URL}}/auth/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "maria@email.com",
    "senha": "12345678",
    "device_name": "iphone-maria"
  }'</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { router } from "expo-router";
import { API } from "@/config/api";

// Nome único por instalação: evita que um aparelho
// derrube a sessão do outro
async function nomeDoDispositivo() {
  let id = await AsyncStorage.getItem("device_id");
  if (!id) {
    id = `app-${Date.now()}-${Math.random().toString(36).slice(2, 8)}`;
    await AsyncStorage.setItem("device_id", id);
  }
  return id;
}

async function fazerLogin() {
  if (!email.trim() || !senha) {
    mostrarMensagem("Informe e-mail e senha.");
    return;
  }

  setCarregando(true);

  try {
    const resposta = await fetch(`${API}/auth/login`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({
        email: email.trim(),
        senha: senha,
        device_name: await nomeDoDispositivo(),
      }),
    });

    const json = await resposta.json();

    // 401 senha errada | 403 inativo | 422 campos | 429 tentativas
    if (!resposta.ok || !json.success) {
      mostrarMensagem(json.message);
      return;
    }

    await AsyncStorage.setItem("token", json.data.token);
    await AsyncStorage.setItem("cliente", JSON.stringify(json.data.cliente));

    router.replace("/home");
  } catch (erro) {
    console.log("Erro ao realizar login:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  } finally {
    setCarregando(false);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>401</button>
                        <button class="tab" data-panel="2"><span class="dot s4"></span>403</button>
                        <button class="tab" data-panel="3"><span class="dot s4"></span>422</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Login realizado com sucesso.",
  "data": {
    "token": "1|aB3dE5fG7hI9jK1lM3nO5pQ7rS9tU1vW3xY5z",
    "cliente": {
      "id_cliente": 1,
      "nome_cliente": "Maria Souza",
      "email_cliente": "maria@email.com",
      "telefone_cliente": "(11)99999-0000"
    }
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "E-mail ou senha inválidos."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Cliente inativo."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "O campo e-mail é obrigatório.",
  "errors": {
    "email": ["O campo e-mail é obrigatório."],
    "senha": ["O campo senha é obrigatório."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POST /auth/cadastro ========== -->
    <section class="section" id="post-cadastro">
        <div class="doc">
            <div class="group-label">Autenticação</div>
            <h2>Cadastro de cliente</h2>

            <div class="endpoint-line">
                <span class="method post">POST</span>
                <span class="path">/auth/cadastro</span>
                <span class="auth-tag public">Pública</span>
            </div>

            <p>
                Cria a conta do cliente e já retorna um token de acesso, para o aplicativo entrar logado
                logo após o cadastro. O cliente é criado com status <code>ATIVO</code> e a data/hora do
                aceite do termo é registrada em <code>termo_aceito_em_cliente</code>.
            </p>

            <div class="callout">
                CPF/CNPJ, tipo de cliente e data de nascimento não são pedidos no cadastro.
                O cliente completa esses dados depois em <a href="#put-cliente"><code>PUT /cliente</code></a>.
            </div>

            <h3>Corpo da requisição</h3>
            <ul class="params">
                <li>
                    <div class="param-head">
                        <span class="param-name">nome</span>
                        <span class="param-type">string · máx. 50</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Nome do cliente.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">email</span>
                        <span class="param-type">email · máx. 80</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">E-mail de acesso. Não pode estar cadastrado.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">telefone</span>
                        <span class="param-type">string · máx. 14</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Telefone de contato.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">senha</span>
                        <span class="param-type">string · mín. 8</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Senha de acesso. É armazenada criptografada (bcrypt).</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">aceite_termo</span>
                        <span class="param-type">boolean</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">
                        Aceite do termo de consentimento. Deve ser <code>true</code>
                        (também aceita <code>1</code>, <code>"yes"</code> ou <code>"on"</code>).
                    </div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">device_name</span>
                        <span class="param-type">string · máx. 100</span>
                        <span class="param-opt">opcional</span>
                    </div>
                    <div class="param-desc">Nome do dispositivo. Padrão: <code>app-mobile</code>.</div>
                </li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">201</span></td><td>Cliente criado. Retorna o token e os dados básicos do cliente.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Campos inválidos, e-mail já cadastrado ou termo não aceito.</td></tr>
                    <tr><td><span class="status s4">429</span></td><td>Muitas tentativas. Limite de 10 cadastros por minuto.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X POST {{BASE_URL}}/auth/cadastro \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "nome": "Maria Souza",
    "email": "maria@email.com",
    "telefone": "(11)99999-0000",
    "senha": "12345678",
    "aceite_termo": true,
    "device_name": "iphone-maria"
  }'</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { router } from "expo-router";
import { API } from "@/config/api";

async function cadastrar() {
  if (!aceitouTermo) {
    mostrarMensagem("Aceite o termo de consentimento para continuar.");
    return;
  }

  setCarregando(true);

  try {
    const resposta = await fetch(`${API}/auth/cadastro`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({
        nome: nome.trim(),
        email: email.trim(),
        telefone: telefone.trim(),
        senha: senha,
        aceite_termo: aceitouTermo, // valor do Switch/Checkbox
        device_name: await nomeDoDispositivo(), // veja o Login
      }),
    });

    const json = await resposta.json();

    // 422: e-mail já cadastrado, senha curta, campo vazio...
    if (!resposta.ok || !json.success) {
      mostrarMensagem(json.message);
      return;
    }

    // Já entra logado
    await AsyncStorage.setItem("token", json.data.token);
    await AsyncStorage.setItem("cliente", JSON.stringify(json.data.cliente));

    router.replace("/home");
  } catch (erro) {
    console.log("Erro ao cadastrar:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  } finally {
    setCarregando(false);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>201</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>422</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Cadastro realizado com sucesso.",
  "data": {
    "token": "1|aB3dE5fG7hI9jK1lM3nO5pQ7rS9tU1vW3xY5z",
    "cliente": {
      "id_cliente": 2,
      "nome_cliente": "Maria Souza",
      "email_cliente": "maria@email.com",
      "telefone_cliente": "(11)99999-0000"
    }
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Este e-mail já está cadastrado.",
  "errors": {
    "email": ["Este e-mail já está cadastrado."],
    "aceite_termo": ["É necessário aceitar o termo de consentimento."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POST /auth/esqueci-senha ========== -->
    <section class="section" id="post-esqueci-senha">
        <div class="doc">
            <div class="group-label">Autenticação</div>
            <h2>Esqueci minha senha</h2>

            <div class="endpoint-line">
                <span class="method post">POST</span>
                <span class="path">/auth/esqueci-senha</span>
                <span class="auth-tag public">Público</span>
            </div>

            <p>Envia ao e-mail do cliente um link para redefinir a senha. O link abre uma página web onde o cliente digita a nova senha, e vale por <strong>60 minutos</strong>.</p>
            <p>A resposta é <strong>sempre a mesma</strong>, exista o e-mail ou não, para não revelar quem é cliente. Só é enviado e-mail a clientes ativos. Limite de 5 pedidos por minuto, e o mesmo cliente só recebe um novo link a cada 60 segundos.</p>
            <p>Este fluxo é diferente de <a href="#put-cliente-senha">Alterar senha</a>, que exige estar logado e conhecer a senha atual.</p>

            <h3>Corpo da requisição</h3>
            <ul class="params">
                <li>
                    <div class="param-head">
                        <span class="param-name">email</span>
                        <span class="param-type">string</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">E-mail cadastrado do cliente.</div>
                </li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Pedido recebido (o e-mail só é enviado se o cadastro existir).</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>E-mail ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">429</span></td><td>Muitas tentativas. Aguarde um minuto.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X POST {{BASE_URL}}/auth/esqueci-senha \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "maria@email.com"
  }'</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import { API } from "@/config/api";

async function esqueciSenha(email) {
  try {
    const resposta = await fetch(`${API}/auth/esqueci-senha`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({ email }),
    });

    const json = await resposta.json();

    // Mostre sempre esta mensagem: ela não revela se o e-mail existe
    mostrarMensagem(json.message);
  } catch (erro) {
    console.log("Erro ao solicitar redefinição:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>422</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Se o e-mail estiver cadastrado, enviaremos um link para redefinir a senha."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Informe um e-mail válido.",
  "errors": {
    "email": ["Informe um e-mail válido."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POST /auth/redefinir-senha ========== -->
    <section class="section" id="post-redefinir-senha">
        <div class="doc">
            <div class="group-label">Autenticação</div>
            <h2>Redefinir senha</h2>

            <div class="endpoint-line">
                <span class="method post">POST</span>
                <span class="path">/auth/redefinir-senha</span>
                <span class="auth-tag public">Público</span>
            </div>

            <p>Define a nova senha usando o <code>token</code> recebido no link do e-mail. Normalmente <strong>quem chama este endpoint é a página web do link</strong> (<code>/redefinir-senha?token=…&amp;email=…</code>), que já vem pronta e não exige trabalho do aplicativo.</p>
            <p>O token vale por 60 minutos e só pode ser usado uma vez. Ao redefinir, todas as sessões abertas do cliente são encerradas (é preciso fazer login de novo, em todos os aparelhos).</p>

            <h3>Corpo da requisição</h3>
            <ul class="params">
                <li><div class="param-head"><span class="param-name">email</span><span class="param-type">string</span><span class="param-req">obrigatório</span></div><div class="param-desc">E-mail do cliente (vem no link).</div></li>
                <li><div class="param-head"><span class="param-name">token</span><span class="param-type">string</span><span class="param-req">obrigatório</span></div><div class="param-desc">Token do link.</div></li>
                <li><div class="param-head"><span class="param-name">nova_senha</span><span class="param-type">string · mín. 8</span><span class="param-req">obrigatório</span></div><div class="param-desc">Nova senha.</div></li>
                <li><div class="param-head"><span class="param-name">nova_senha_confirmation</span><span class="param-type">string</span><span class="param-req">obrigatório</span></div><div class="param-desc">Repetição da nova senha.</div></li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Senha redefinida.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Link inválido, expirado ou já usado; ou senha inválida / não confirmada.</td></tr>
                    <tr><td><span class="status s4">429</span></td><td>Muitas tentativas. Aguarde um minuto.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X POST {{BASE_URL}}/auth/redefinir-senha \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "maria@email.com",
    "token": "ebc27342699be2520f8da7b6537d0b68...",
    "nova_senha": "novaSenha2026",
    "nova_senha_confirmation": "novaSenha2026"
  }'</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>422 link</button>
                        <button class="tab" data-panel="2"><span class="dot s4"></span>422 senha</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Senha redefinida com sucesso."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Link inválido ou expirado. Solicite um novo."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "A confirmação da nova senha não confere.",
  "errors": {
    "nova_senha": ["A confirmação da nova senha não confere."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POST /auth/logout ========== -->
    <section class="section" id="post-logout">
        <div class="doc">
            <div class="group-label">Autenticação</div>
            <h2>Logout</h2>

            <div class="endpoint-line">
                <span class="method post">POST</span>
                <span class="path">/auth/logout</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Revoga o token usado na requisição. Os tokens de outros dispositivos continuam válidos.</p>

            <h3>Parâmetros</h3>
            <p>Esta rota não recebe parâmetros.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Logout realizado.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X POST {{BASE_URL}}/auth/logout \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { router } from "expo-router";
import { API } from "@/config/api";

async function sair() {
  const token = await AsyncStorage.getItem("token");

  try {
    await fetch(`${API}/auth/logout`, {
      method: "POST",
      headers: {
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
    });
  } catch (erro) {
    console.log("Erro ao sair:", erro);
  } finally {
    // Mesmo sem internet, remove a sessão do aparelho
    await AsyncStorage.multiRemove(["token", "cliente"]);
    router.replace("/login");
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>401</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Logout realizado com sucesso."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Sessão expirada. Faça login novamente."
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /cliente ========== -->
    <section class="section" id="get-cliente">
        <div class="doc">
            <div class="group-label">Cliente</div>
            <h2>Dados do cliente</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/cliente</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Retorna os dados do cliente dono do token. A senha nunca é retornada.</p>

            <h3>Parâmetros</h3>
            <p>Esta rota não recebe parâmetros.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Dados do cliente.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/cliente \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function carregarCliente() {
  const token = await AsyncStorage.getItem("token");

  try {
    const resposta = await fetch(`${API}/cliente`, {
      headers: {
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
    });

    const json = await resposta.json();

    // 401: "Sessão expirada. Faça login novamente."
    if (!resposta.ok) {
      mostrarMensagem(json.message);
      return;
    }

    setCliente(json.data);
  } catch (erro) {
    console.log("Erro ao carregar cliente:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>401</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": {
    "id_cliente": 1,
    "nome_cliente": "Maria Souza",
    "tipo_cliente": "PF",
    "cpf_cnpj_cliente": "123.456.789-00",
    "data_nasc_cliente": "1990-05-12T00:00:00.000000Z",
    "email_cliente": "maria@email.com",
    "telefone_cliente": "(11)99999-0000",
    "foto_cliente": "cliente/maria.png",
    "status_cliente": "ATIVO",
    "termo_aceito_em_cliente": "2026-09-08T14:00:00.000000Z",
    "criado_em_cliente": "2026-09-08T14:00:00.000000Z",
    "atualizado_em_cliente": "2026-10-08T12:00:00.000000Z"
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Sessão expirada. Faça login novamente."
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== PUT /cliente ========== -->
    <section class="section" id="put-cliente">
        <div class="doc">
            <div class="group-label">Cliente</div>
            <h2>Atualizar cliente</h2>

            <div class="endpoint-line">
                <span class="method put">PUT</span>
                <span class="method patch">PATCH</span>
                <span class="path">/cliente</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>
                Atualiza os dados cadastrais do cliente dono do token. A rota aceita os métodos
                <code>PUT</code> e <code>PATCH</code>, que têm o mesmo comportamento.
            </p>

            <div class="callout warn">
                Atualmente <strong>todos os campos são obrigatórios</strong>, inclusive no <code>PATCH</code>.
                Envie o cadastro completo, mesmo que apenas um campo tenha mudado.
            </div>

            <h3>Corpo da requisição</h3>
            <ul class="params">
                <li>
                    <div class="param-head">
                        <span class="param-name">nome_cliente</span>
                        <span class="param-type">string · máx. 50</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Nome completo.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">tipo_cliente</span>
                        <span class="param-type">string · máx. 2</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Tipo de pessoa: <code>PF</code> ou <code>PJ</code>.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">cpf_cnpj_cliente</span>
                        <span class="param-type">string · máx. 18</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">CPF ou CNPJ. Deve ser único entre os clientes.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">data_nasc_cliente</span>
                        <span class="param-type">date</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Data de nascimento no formato <code>AAAA-MM-DD</code>.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">email_cliente</span>
                        <span class="param-type">email · máx. 80</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">E-mail de acesso. Deve ser único entre os clientes.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">telefone_cliente</span>
                        <span class="param-type">string · máx. 14</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Telefone de contato.</div>
                </li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Dados atualizados. Retorna o cliente atualizado.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Campos inválidos, ou e-mail / CPF-CNPJ já cadastrados.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X PUT {{BASE_URL}}/cliente \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {token}" \
  -d '{
    "nome_cliente": "Maria Souza",
    "tipo_cliente": "PF",
    "cpf_cnpj_cliente": "123.456.789-00",
    "data_nasc_cliente": "1990-05-12",
    "email_cliente": "maria@email.com",
    "telefone_cliente": "(11)98888-0000"
  }'</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function salvarPerfil() {
  setCarregando(true);
  const token = await AsyncStorage.getItem("token");

  try {
    const resposta = await fetch(`${API}/cliente`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({
        nome_cliente: nome.trim(),
        tipo_cliente: "PF",
        cpf_cnpj_cliente: cpf,
        data_nasc_cliente: dataNascimento, // "1990-05-12"
        email_cliente: email.trim(),
        telefone_cliente: telefone.trim(),
      }),
    });

    const json = await resposta.json();

    // 422: e-mail ou CPF já usados, campo vazio...
    if (!resposta.ok || !json.success) {
      mostrarMensagem(json.message);
      return;
    }

    setCliente(json.data);
    mostrarMensagem(json.message); // "Dados atualizados com sucesso."
  } catch (erro) {
    console.log("Erro ao salvar perfil:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  } finally {
    setCarregando(false);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>422</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Dados atualizados com sucesso.",
  "data": {
    "id_cliente": 1,
    "nome_cliente": "Maria Souza",
    "tipo_cliente": "PF",
    "cpf_cnpj_cliente": "123.456.789-00",
    "data_nasc_cliente": "1990-05-12T00:00:00.000000Z",
    "email_cliente": "maria@email.com",
    "telefone_cliente": "(11)98888-0000",
    "foto_cliente": "cliente/maria.png",
    "status_cliente": "ATIVO",
    "criado_em_cliente": "2026-09-08T14:00:00.000000Z",
    "atualizado_em_cliente": "2026-10-08T12:30:00.000000Z"
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "O valor informado em e-mail já está em uso.",
  "errors": {
    "email_cliente": ["O valor informado em e-mail já está em uso."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== PUT /cliente/senha ========== -->
    <section class="section" id="put-cliente-senha">
        <div class="doc">
            <div class="group-label">Cliente</div>
            <h2>Alterar senha</h2>

            <div class="endpoint-line">
                <span class="method put">PUT</span>
                <span class="path">/cliente/senha</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Altera a senha do cliente. É necessário informar a senha atual e confirmar a nova senha.</p>

            <h3>Corpo da requisição</h3>
            <ul class="params">
                <li>
                    <div class="param-head">
                        <span class="param-name">senha_atual</span>
                        <span class="param-type">string</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Senha usada atualmente.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">nova_senha</span>
                        <span class="param-type">string · mín. 8</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Nova senha.</div>
                </li>
                <li>
                    <div class="param-head">
                        <span class="param-name">nova_senha_confirmation</span>
                        <span class="param-type">string</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Repetição da nova senha. Deve ser igual a <code>nova_senha</code>.</div>
                </li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Senha atualizada.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Senha atual incorreta, ou nova senha inválida / não confirmada.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X PUT {{BASE_URL}}/cliente/senha \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {token}" \
  -d '{
    "senha_atual": "12345678",
    "nova_senha": "novaSenha2026",
    "nova_senha_confirmation": "novaSenha2026"
  }'</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function alterarSenha() {
  setCarregando(true);
  const token = await AsyncStorage.getItem("token");

  try {
    const resposta = await fetch(`${API}/cliente/senha`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({
        senha_atual: senhaAtual,
        nova_senha: novaSenha,
        nova_senha_confirmation: confirmarSenha,
      }),
    });

    const json = await resposta.json();

    // 422: "Senha atual incorreta." ou confirmação diferente
    mostrarMensagem(json.message);
  } catch (erro) {
    console.log("Erro ao alterar senha:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  } finally {
    setCarregando(false);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>422 senha</button>
                        <button class="tab" data-panel="2"><span class="dot s4"></span>422 validação</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Senha atualizada com sucesso."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Senha atual incorreta."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "A confirmação do campo nova senha não confere.",
  "errors": {
    "nova_senha": ["A confirmação do campo nova senha não confere."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POST /cliente/foto ========== -->
    <section class="section" id="post-cliente-foto">
        <div class="doc">
            <div class="group-label">Cliente</div>
            <h2>Enviar foto</h2>

            <div class="endpoint-line">
                <span class="method post">POST</span>
                <span class="path">/cliente/foto</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Define a foto de perfil do cliente autenticado. Se já havia uma foto, ela é substituída (e o arquivo antigo é apagado). O campo <code>foto_cliente</code> retorna um caminho relativo; veja <a href="#imagens">Imagens</a> para montar a URL.</p>
            <p>Use <code>multipart/form-data</code>. Não envie JSON e não defina o <code>Content-Type</code> manualmente (o cliente HTTP inclui o <em>boundary</em>).</p>

            <h3>Corpo da requisição (form-data)</h3>
            <ul class="params">
                <li>
                    <div class="param-head">
                        <span class="param-name">foto_cliente</span>
                        <span class="param-type">arquivo · JPG, PNG ou WEBP · máx. 2 MB</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Imagem de perfil.</div>
                </li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Foto atualizada. Retorna o cliente.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Arquivo ausente, não é imagem, formato inválido ou maior que 2 MB.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X POST {{BASE_URL}}/cliente/foto \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}" \
  -F "foto_cliente=@/caminho/foto.png"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import * as ImagePicker from "expo-image-picker";
import { API } from "@/config/api";

async function enviarFoto() {
  const escolha = await ImagePicker.launchImageLibraryAsync({
    mediaTypes: ImagePicker.MediaTypeOptions.Images,
    quality: 0.7,
  });
  if (escolha.canceled) return;

  const imagem = escolha.assets[0];
  const token = await AsyncStorage.getItem("token");

  const form = new FormData();
  form.append("foto_cliente", {
    uri: imagem.uri,
    name: "foto.jpg",
    type: imagem.mimeType ?? "image/jpeg",
  });

  try {
    // Não defina Content-Type: o fetch inclui o boundary sozinho
    const resposta = await fetch(`${API}/cliente/foto`, {
      method: "POST",
      headers: {
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: form,
    });

    const json = await resposta.json();
    mostrarMensagem(json.message);
  } catch (erro) {
    console.log("Erro ao enviar foto:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>422</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Foto atualizada com sucesso.",
  "data": {
    "id_cliente": 7,
    "nome_cliente": "Maria Silva",
    "email_cliente": "maria@email.com",
    "foto_cliente": "cliente/cliente-7-kd4rvg1b.png"
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "A foto deve ter no máximo 2 MB.",
  "errors": {
    "foto_cliente": ["A foto deve ter no máximo 2 MB."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== DELETE /cliente/foto ========== -->
    <section class="section" id="delete-cliente-foto">
        <div class="doc">
            <div class="group-label">Cliente</div>
            <h2>Remover foto</h2>

            <div class="endpoint-line">
                <span class="method delete">DELETE</span>
                <span class="path">/cliente/foto</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Remove a foto de perfil do cliente autenticado. <code>foto_cliente</code> volta a <code>null</code>. Pode ser chamado mesmo sem foto cadastrada.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Foto removida. Retorna o cliente.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X DELETE {{BASE_URL}}/cliente/foto \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function removerFoto() {
  const token = await AsyncStorage.getItem("token");

  const resposta = await fetch(`${API}/cliente/foto`, {
    method: "DELETE",
    headers: {
      Accept: "application/json",
      Authorization: `Bearer ${token}`,
    },
  });

  const json = await resposta.json();
  mostrarMensagem(json.message);
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Foto removida com sucesso.",
  "data": {
    "id_cliente": 7,
    "nome_cliente": "Maria Silva",
    "email_cliente": "maria@email.com",
    "foto_cliente": null
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POST /pedidos ========== -->
    <section class="section" id="post-pedidos">
        <div class="doc">
            <div class="group-label">Pedidos</div>
            <h2>Criar pedido</h2>

            <div class="endpoint-line">
                <span class="method post">POST</span>
                <span class="path">/pedidos</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Cria um pedido (com seus itens) para o cliente autenticado. O pedido nasce com status <code>PENDENTE</code>.</p>
            <p><strong>Os preços são sempre os do servidor.</strong> O app envia apenas o produto e a quantidade; o valor unitário é lido do cadastro do produto e gravado no item no momento do pedido, então reajustes futuros não alteram pedidos antigos. Itens com o mesmo produto são somados.</p>
            <p>O <strong>cupom</strong> é um percentual aplicado sobre o subtotal. <code>valor_venda</code> é o total já com desconto, e <code>valor_desconto_venda</code> é o valor em R$ concedido.</p>

            <h3>Corpo da requisição</h3>
            <ul class="params">
                <li><div class="param-head"><span class="param-name">itens</span><span class="param-type">array · 1 a 50</span><span class="param-req">obrigatório</span></div><div class="param-desc">Lista de produtos do pedido.</div></li>
                <li><div class="param-head"><span class="param-name">itens[].id_produto</span><span class="param-type">integer</span><span class="param-req">obrigatório</span></div><div class="param-desc">Produto ativo, de categoria ativa.</div></li>
                <li><div class="param-head"><span class="param-name">itens[].quantidade</span><span class="param-type">integer · 1 a 99</span><span class="param-req">obrigatório</span></div><div class="param-desc">Quantidade.</div></li>
                <li><div class="param-head"><span class="param-name">entrega</span><span class="param-type">SIM | NAO</span><span class="param-req">obrigatório</span></div><div class="param-desc"><code>SIM</code> para entrega, <code>NAO</code> para retirada na loja.</div></li>
                <li><div class="param-head"><span class="param-name">id_endereco</span><span class="param-type">integer</span><span class="param-req">obrigatório se entrega = SIM</span></div><div class="param-desc">Endereço do próprio cliente (veja <a href="#get-enderecos">Endereços</a>). Ignorado na retirada.</div></li>
                <li><div class="param-head"><span class="param-name">forma_pagamento</span><span class="param-type">PIX | DINHEIRO | CARTAO</span><span class="param-req">obrigatório</span></div><div class="param-desc">Forma de pagamento.</div></li>
                <li><div class="param-head"><span class="param-name">data_entrega</span><span class="param-type">datetime</span><span class="param-req">obrigatório</span></div><div class="param-desc">Data e hora desejadas para a entrega ou retirada. Deve ser futura. Ex.: <code>2026-11-01 15:00</code>.</div></li>
                <li><div class="param-head"><span class="param-name">observacao</span><span class="param-type">string · máx. 500</span></div><div class="param-desc">Opcional.</div></li>
                <li><div class="param-head"><span class="param-name">codigo_cupom</span><span class="param-type">string</span></div><div class="param-desc">Opcional. Cupom ativo e dentro da validade.</div></li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">201</span></td><td>Pedido criado.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Dados inválidos, produto indisponível, endereço que não é do cliente, cupom inválido ou expirado, ou data passada.</td></tr>
                    <tr><td><span class="status s4">429</span></td><td>Muitas tentativas. Limite de 20 por minuto.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X POST {{BASE_URL}}/pedidos \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {token}" \
  -d '{
    "itens": [
      { "id_produto": 1, "quantidade": 3 },
      { "id_produto": 2, "quantidade": 1 }
    ],
    "entrega": "SIM",
    "id_endereco": 6,
    "forma_pagamento": "PIX",
    "data_entrega": "2026-11-01 15:00",
    "observacao": "Sem granulado",
    "codigo_cupom": "TESTE10"
  }'</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function finalizarPedido(carrinho, enderecoId) {
  setCarregando(true);
  const token = await AsyncStorage.getItem("token");

  try {
    const resposta = await fetch(`${API}/pedidos`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({
        // Só produto e quantidade: o preço vem do servidor
        itens: carrinho.map((i) => ({
          id_produto: i.id_produto,
          quantidade: i.quantidade,
        })),
        entrega: enderecoId ? "SIM" : "NAO",
        id_endereco: enderecoId,
        forma_pagamento: "PIX",
        data_entrega: "2026-11-01 15:00",
        codigo_cupom: cupom || undefined,
      }),
    });

    const json = await resposta.json();

    if (resposta.status === 201) {
      limparCarrinho();
      irParaPedido(json.data.id_venda);
    } else {
      // 422: json.errors traz o erro de cada campo
      mostrarMensagem(json.message);
    }
  } catch (erro) {
    console.log("Erro ao finalizar pedido:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  } finally {
    setCarregando(false);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>201</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>422 cupom</button>
                        <button class="tab" data-panel="2"><span class="dot s4"></span>422 validação</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Pedido realizado com sucesso.",
  "data": {
    "id_venda": 3,
    "id_cliente": 8,
    "id_usuario": null,
    "id_endereco": 6,
    "id_cupom": 1,
    "data_venda": "2026-10-27T14:20:11.000000Z",
    "valor_venda": 54.54,
    "forma_pagamento_venda": "PIX",
    "entrega_venda": "SIM",
    "observacao_venda": "Sem granulado",
    "valor_desconto_venda": 6.06,
    "status_venda": "PENDENTE",
    "data_entrega_venda": "2026-11-01T15:00:00.000000Z",
    "subtotal_venda": 60.6,
    "status_descricao_venda": "Aguardando confirmação",
    "itens": [
      {
        "id_item": 1,
        "id_produto": 1,
        "valor_unit_item": 14.9,
        "qtde_item": 3,
        "status_item": "ATIVO",
        "produto": { "id_produto": 1, "nome_produto": "…", "slug_produto": "…", "foto_produto": "produto/…" }
      },
      {
        "id_item": 2,
        "id_produto": 2,
        "valor_unit_item": 15.9,
        "qtde_item": 1,
        "status_item": "ATIVO",
        "produto": { "id_produto": 2, "nome_produto": "…", "slug_produto": "…", "foto_produto": "produto/…" }
      }
    ],
    "endereco": { "id_endereco": 6, "nome_endereco": "Casa", "endereco": "Rua A", "numero": "1" },
    "cupom": { "id_cupom": 1, "codigo_cupom": "TESTE10", "valor_desconto_cupom": 10 }
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Cupom inválido ou expirado.",
  "errors": {
    "codigo_cupom": ["Cupom inválido ou expirado."]
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Informe ao menos um item.",
  "errors": {
    "itens": ["Informe ao menos um item."],
    "forma_pagamento": ["Forma de pagamento inválida. Use PIX, DINHEIRO ou CARTAO."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /pedidos ========== -->
    <section class="section" id="get-pedidos">
        <div class="doc">
            <div class="group-label">Pedidos</div>
            <h2>Histórico de pedidos</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/pedidos</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Lista os pedidos do cliente autenticado, do mais recente para o mais antigo, com paginação. Cada pedido traz seus itens e o produto de cada item. Para endereço e cupom, use <a href="#get-pedido">Detalhar pedido</a>.</p>

            <h3>Parâmetros de consulta</h3>
            <ul class="params">
                <li><div class="param-head"><span class="param-name">status</span><span class="param-type">string</span></div><div class="param-desc">Opcional. Filtra por <code>PENDENTE</code>, <code>CONFIRMADO</code>, <code>EM_PREPARO</code>, <code>PRONTO</code>, <code>EM_ENTREGA</code>, <code>ENTREGUE</code> ou <code>CANCELADO</code>.</div></li>
                <li><div class="param-head"><span class="param-name">page</span><span class="param-type">integer</span></div><div class="param-desc">Opcional. Página (padrão 1).</div></li>
                <li><div class="param-head"><span class="param-name">por_pagina</span><span class="param-type">integer · 1 a 50</span></div><div class="param-desc">Opcional. Pedidos por página (padrão 10).</div></li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Lista de pedidos (vazia se não houver nenhum). O campo <code>meta</code> traz a paginação.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Status ou <code>por_pagina</code> inválido.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl "{{BASE_URL}}/pedidos?status=PENDENTE&page=1" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function carregarPedidos(pagina = 1) {
  const token = await AsyncStorage.getItem("token");

  try {
    const resposta = await fetch(`${API}/pedidos?page=${pagina}`, {
      headers: {
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
    });

    const json = await resposta.json();
    setPedidos((atuais) => (pagina === 1 ? json.data : [...atuais, ...json.data]));
    setTemMais(json.meta.pagina_atual < json.meta.ultima_pagina);
  } catch (erro) {
    console.log("Erro ao carregar pedidos:", erro);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": [
    {
      "id_venda": 8,
      "data_venda": "2026-10-27T14:20:11.000000Z",
      "valor_venda": 18,
      "valor_desconto_venda": 0,
      "subtotal_venda": 18,
      "entrega_venda": "NAO",
      "status_venda": "PENDENTE",
      "status_descricao_venda": "Aguardando confirmação",
      "data_entrega_venda": "2026-11-01T15:00:00.000000Z",
      "itens": [
        {
          "id_item": 12,
          "id_produto": 5,
          "valor_unit_item": 4.5,
          "qtde_item": 4,
          "status_item": "ATIVO",
          "produto": { "id_produto": 5, "nome_produto": "…", "foto_produto": "produto/…" }
        }
      ]
    }
  ],
  "meta": {
    "pagina_atual": 1,
    "ultima_pagina": 1,
    "por_pagina": 10,
    "total": 1
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /pedidos/{id} ========== -->
    <section class="section" id="get-pedido">
        <div class="doc">
            <div class="group-label">Pedidos</div>
            <h2>Detalhar pedido</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/pedidos/{id}</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Retorna um pedido do cliente autenticado, com itens, endereço de entrega (se houver) e cupom (se houver). Pedido de outro cliente retorna <code>404</code>. O <code>{id}</code> é o <code>id_venda</code>.</p>
            <p><code>subtotal_venda</code> é o total antes do desconto. <code>valor_venda</code> é o total cobrado, já com desconto.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Pedido encontrado.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Pedido não encontrado.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/pedidos/3 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function carregarPedido(id) {
  const token = await AsyncStorage.getItem("token");

  const resposta = await fetch(`${API}/pedidos/${id}`, {
    headers: {
      Accept: "application/json",
      Authorization: `Bearer ${token}`,
    },
  });

  const json = await resposta.json();
  if (json.success) setPedido(json.data);
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>404</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": {
    "id_venda": 3,
    "id_endereco": 6,
    "id_cupom": 1,
    "data_venda": "2026-10-27T14:20:11.000000Z",
    "valor_venda": 54.54,
    "valor_desconto_venda": 6.06,
    "subtotal_venda": 60.6,
    "forma_pagamento_venda": "PIX",
    "entrega_venda": "SIM",
    "observacao_venda": "Sem granulado",
    "status_venda": "PENDENTE",
    "status_descricao_venda": "Aguardando confirmação",
    "data_entrega_venda": "2026-11-01T15:00:00.000000Z",
    "itens": [
      {
        "id_item": 1,
        "id_produto": 1,
        "valor_unit_item": 14.9,
        "qtde_item": 3,
        "status_item": "ATIVO",
        "produto": { "id_produto": 1, "nome_produto": "…", "foto_produto": "produto/…" }
      }
    ],
    "endereco": { "id_endereco": 6, "nome_endereco": "Casa", "endereco": "Rua A", "numero": "1" },
    "cupom": { "id_cupom": 1, "codigo_cupom": "TESTE10", "valor_desconto_cupom": 10 }
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Recurso não encontrado."
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /pedidos/{id}/status ========== -->
    <section class="section" id="get-pedido-status">
        <div class="doc">
            <div class="group-label">Pedidos</div>
            <h2>Status do pedido</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/pedidos/{id}/status</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Consulta leve para acompanhar o andamento do pedido (por exemplo, atualizando a tela de tempos em tempos). Retorna só o status.</p>

            <h3>Status possíveis</h3>
            <table class="table">
                <tbody>
                    <tr><td><code>PENDENTE</code></td><td>Aguardando confirmação (o cliente ainda pode cancelar).</td></tr>
                    <tr><td><code>CONFIRMADO</code></td><td>Pedido confirmado pela confeitaria.</td></tr>
                    <tr><td><code>EM_PREPARO</code></td><td>Em preparo.</td></tr>
                    <tr><td><code>PRONTO</code></td><td>Pronto para retirada ou envio.</td></tr>
                    <tr><td><code>EM_ENTREGA</code></td><td>Saiu para entrega.</td></tr>
                    <tr><td><code>ENTREGUE</code></td><td>Concluído.</td></tr>
                    <tr><td><code>CANCELADO</code></td><td>Cancelado.</td></tr>
                </tbody>
            </table>
            <p>A confeitaria altera o status pelo painel administrativo. O aplicativo só consulta e, enquanto <code>PENDENTE</code>, pode <a href="#put-pedido-cancelar">cancelar</a>.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Status do pedido.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Pedido não encontrado.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/pedidos/3/status \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function consultarStatus(id) {
  const token = await AsyncStorage.getItem("token");

  const resposta = await fetch(`${API}/pedidos/${id}/status`, {
    headers: {
      Accept: "application/json",
      Authorization: `Bearer ${token}`,
    },
  });

  const json = await resposta.json();
  if (json.success) setStatus(json.data.status_descricao_venda);
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": {
    "id_venda": 3,
    "status_venda": "CONFIRMADO",
    "status_descricao_venda": "Pedido confirmado",
    "atualizado_em_venda": "2026-10-27T15:02:40.000000Z"
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== PUT /pedidos/{id}/cancelar ========== -->
    <section class="section" id="put-pedido-cancelar">
        <div class="doc">
            <div class="group-label">Pedidos</div>
            <h2>Cancelar pedido</h2>

            <div class="endpoint-line">
                <span class="method put">PUT</span>
                <span class="path">/pedidos/{id}/cancelar</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Cancela um pedido do cliente autenticado. Só é possível enquanto o status é <code>PENDENTE</code>; depois da confirmação, o cancelamento deve ser combinado com a confeitaria. Os itens também ficam como <code>CANCELADO</code>. Não precisa de corpo.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Pedido cancelado. Retorna o pedido.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Pedido não encontrado.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>O pedido não está mais <code>PENDENTE</code> (inclusive se já foi cancelado).</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X PUT {{BASE_URL}}/pedidos/3/cancelar \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function cancelarPedido(id) {
  const token = await AsyncStorage.getItem("token");

  const resposta = await fetch(`${API}/pedidos/${id}/cancelar`, {
    method: "PUT",
    headers: {
      Accept: "application/json",
      Authorization: `Bearer ${token}`,
    },
  });

  const json = await resposta.json();

  // 422: o pedido já foi confirmado ou cancelado
  mostrarMensagem(json.message);
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>422</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Pedido cancelado com sucesso.",
  "data": {
    "id_venda": 3,
    "status_venda": "CANCELADO",
    "status_descricao_venda": "Cancelado",
    "itens": [
      { "id_item": 1, "status_item": "CANCELADO" }
    ]
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Este pedido não pode mais ser cancelado. Entre em contato com a confeitaria."
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /enderecos ========== -->
    <section class="section" id="get-enderecos">
        <div class="doc">
            <div class="group-label">Endereços</div>
            <h2>Listar endereços</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/enderecos</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Lista os endereços ativos do cliente autenticado. O endereço principal vem primeiro.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Lista de endereços (vazia se não houver nenhum).</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/enderecos \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function carregarEnderecos() {
  const token = await AsyncStorage.getItem("token");

  try {
    const resposta = await fetch(`${API}/enderecos`, {
      headers: {
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
    });

    const json = await resposta.json();
    setEnderecos(json.data);
  } catch (erro) {
    console.log("Erro ao carregar endereços:", erro);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": [
    {
      "id_endereco": 5,
      "id_cliente": 4,
      "nome_endereco": "Casa",
      "endereco": "Rua A",
      "numero": "10",
      "complemento": null,
      "bairro": "Centro",
      "cidade": "São Paulo",
      "uf": "SP",
      "cep": "01001-000",
      "principal_endereco": "SIM",
      "status_endereco": "ATIVO"
    }
  ]
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POST /enderecos ========== -->
    <section class="section" id="post-enderecos">
        <div class="doc">
            <div class="group-label">Endereços</div>
            <h2>Cadastrar endereço</h2>

            <div class="endpoint-line">
                <span class="method post">POST</span>
                <span class="path">/enderecos</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Cadastra um endereço para o cliente autenticado. O primeiro endereço do cliente é sempre o principal. Nos demais, envie <code>principal_endereco: "SIM"</code> para torná-lo o principal (o anterior deixa de ser).</p>

            <h3>Corpo da requisição</h3>
            <ul class="params">
                <li><div class="param-head"><span class="param-name">nome_endereco</span><span class="param-type">string · máx. 30</span><span class="param-req">obrigatório</span></div><div class="param-desc">Apelido do endereço. Ex.: Casa, Trabalho.</div></li>
                <li><div class="param-head"><span class="param-name">endereco</span><span class="param-type">string · máx. 40</span><span class="param-req">obrigatório</span></div><div class="param-desc">Rua / logradouro.</div></li>
                <li><div class="param-head"><span class="param-name">numero</span><span class="param-type">string · máx. 6</span><span class="param-req">obrigatório</span></div><div class="param-desc">Número.</div></li>
                <li><div class="param-head"><span class="param-name">complemento</span><span class="param-type">string · máx. 50</span></div><div class="param-desc">Opcional.</div></li>
                <li><div class="param-head"><span class="param-name">bairro</span><span class="param-type">string · máx. 40</span><span class="param-req">obrigatório</span></div><div class="param-desc">Bairro.</div></li>
                <li><div class="param-head"><span class="param-name">cidade</span><span class="param-type">string · máx. 40</span><span class="param-req">obrigatório</span></div><div class="param-desc">Cidade.</div></li>
                <li><div class="param-head"><span class="param-name">uf</span><span class="param-type">string · 2 letras</span><span class="param-req">obrigatório</span></div><div class="param-desc">Estado. Salvo em maiúsculas.</div></li>
                <li><div class="param-head"><span class="param-name">cep</span><span class="param-type">string</span><span class="param-req">obrigatório</span></div><div class="param-desc"><code>00000-000</code> ou <code>00000000</code>.</div></li>
                <li><div class="param-head"><span class="param-name">principal_endereco</span><span class="param-type">SIM | NAO</span></div><div class="param-desc">Opcional. Padrão <code>NAO</code> (exceto no primeiro endereço).</div></li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">201</span></td><td>Endereço cadastrado.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Dados inválidos.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X POST {{BASE_URL}}/enderecos \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {token}" \
  -d '{
    "nome_endereco": "Casa",
    "endereco": "Rua A",
    "numero": "10",
    "complemento": "Apto 2",
    "bairro": "Centro",
    "cidade": "São Paulo",
    "uf": "SP",
    "cep": "01001-000"
  }'</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function salvarEndereco(form) {
  const token = await AsyncStorage.getItem("token");

  try {
    const resposta = await fetch(`${API}/enderecos`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify(form),
    });

    const json = await resposta.json();

    // 422: json.errors traz o erro de cada campo
    mostrarMensagem(json.message);
  } catch (erro) {
    console.log("Erro ao salvar endereço:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>201</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>422</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Endereço cadastrado com sucesso.",
  "data": {
    "id_endereco": 5,
    "id_cliente": 4,
    "nome_endereco": "Casa",
    "endereco": "Rua A",
    "numero": "10",
    "complemento": "Apto 2",
    "bairro": "Centro",
    "cidade": "São Paulo",
    "uf": "SP",
    "cep": "01001-000",
    "principal_endereco": "SIM",
    "status_endereco": "ATIVO"
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "O campo endereco é obrigatório.",
  "errors": {
    "endereco": ["O campo endereco é obrigatório."],
    "cep": ["CEP inválido. Use 00000-000 ou 00000000."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /enderecos/{id} ========== -->
    <section class="section" id="get-endereco">
        <div class="doc">
            <div class="group-label">Endereços</div>
            <h2>Detalhar endereço</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/enderecos/{id}</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Retorna um endereço ativo do cliente autenticado. Endereços de outros clientes retornam <code>404</code>.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Endereço encontrado.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Endereço não encontrado.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/enderecos/5 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function carregarEndereco(id) {
  const token = await AsyncStorage.getItem("token");

  const resposta = await fetch(`${API}/enderecos/${id}`, {
    headers: {
      Accept: "application/json",
      Authorization: `Bearer ${token}`,
    },
  });

  const json = await resposta.json();
  if (json.success) setEndereco(json.data);
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>404</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": {
    "id_endereco": 5,
    "id_cliente": 4,
    "nome_endereco": "Casa",
    "endereco": "Rua A",
    "numero": "10",
    "complemento": null,
    "bairro": "Centro",
    "cidade": "São Paulo",
    "uf": "SP",
    "cep": "01001-000",
    "principal_endereco": "SIM",
    "status_endereco": "ATIVO"
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Recurso não encontrado."
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== PUT /enderecos/{id} ========== -->
    <section class="section" id="put-endereco">
        <div class="doc">
            <div class="group-label">Endereços</div>
            <h2>Atualizar endereço</h2>

            <div class="endpoint-line">
                <span class="method put">PUT</span>
                <span class="method patch">PATCH</span>
                <span class="path">/enderecos/{id}</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Atualiza um endereço do cliente autenticado. Aceita <code>PUT</code> ou <code>PATCH</code>, e basta enviar os campos que mudam. Enviar <code>principal_endereco: "SIM"</code> torna este endereço o principal; <code>"NAO"</code> é ignorado (para mudar o principal, marque outro como <code>SIM</code>).</p>

            <h3>Corpo da requisição</h3>
            <p>Os mesmos campos de <a href="#post-enderecos">Cadastrar endereço</a>, todos opcionais.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Endereço atualizado.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Endereço não encontrado.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td>Dados inválidos.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X PATCH {{BASE_URL}}/enderecos/5 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {token}" \
  -d '{
    "numero": "99"
  }'</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function atualizarEndereco(id, campos) {
  const token = await AsyncStorage.getItem("token");

  const resposta = await fetch(`${API}/enderecos/${id}`, {
    method: "PATCH",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
      Authorization: `Bearer ${token}`,
    },
    body: JSON.stringify(campos),
  });

  const json = await resposta.json();
  mostrarMensagem(json.message);
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Endereço atualizado com sucesso.",
  "data": {
    "id_endereco": 5,
    "nome_endereco": "Casa",
    "numero": "99",
    "principal_endereco": "SIM",
    "status_endereco": "ATIVO"
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== PUT /enderecos/{id}/principal ========== -->
    <section class="section" id="put-endereco-principal">
        <div class="doc">
            <div class="group-label">Endereços</div>
            <h2>Definir endereço principal</h2>

            <div class="endpoint-line">
                <span class="method put">PUT</span>
                <span class="path">/enderecos/{id}/principal</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Marca o endereço como principal. O principal anterior passa a <code>NAO</code>. Não precisa de corpo.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Principal atualizado.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Endereço não encontrado.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X PUT {{BASE_URL}}/enderecos/5/principal \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function definirPrincipal(id) {
  const token = await AsyncStorage.getItem("token");

  const resposta = await fetch(`${API}/enderecos/${id}/principal`, {
    method: "PUT",
    headers: {
      Accept: "application/json",
      Authorization: `Bearer ${token}`,
    },
  });

  const json = await resposta.json();
  mostrarMensagem(json.message);
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Endereço principal atualizado.",
  "data": {
    "id_endereco": 5,
    "nome_endereco": "Casa",
    "principal_endereco": "SIM",
    "status_endereco": "ATIVO"
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== DELETE /enderecos/{id} ========== -->
    <section class="section" id="delete-endereco">
        <div class="doc">
            <div class="group-label">Endereços</div>
            <h2>Remover endereço</h2>

            <div class="endpoint-line">
                <span class="method delete">DELETE</span>
                <span class="path">/enderecos/{id}</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Remove o endereço do cliente autenticado. A remoção é lógica (o registro fica <code>INATIVO</code>, preservando pedidos antigos). Se o endereço removido era o principal, o endereço ativo mais recente assume como principal.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Endereço removido.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Endereço não encontrado.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X DELETE {{BASE_URL}}/enderecos/5 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function removerEndereco(id) {
  const token = await AsyncStorage.getItem("token");

  const resposta = await fetch(`${API}/enderecos/${id}`, {
    method: "DELETE",
    headers: {
      Accept: "application/json",
      Authorization: `Bearer ${token}`,
    },
  });

  const json = await resposta.json();
  mostrarMensagem(json.message);
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Endereço removido com sucesso."
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /favoritos ========== -->
    <section class="section" id="get-favoritos">
        <div class="doc">
            <div class="group-label">Favoritos</div>
            <h2>Listar favoritos</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/favoritos</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Lista os produtos favoritados pelo cliente autenticado, do mais recente para o mais antigo. Produtos ou categorias inativos não aparecem. Cada item traz o produto completo, com a categoria.</p>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Lista de favoritos (vazia se não houver nenhum).</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/favoritos \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function carregarFavoritos() {
  const token = await AsyncStorage.getItem("token");

  try {
    const resposta = await fetch(`${API}/favoritos`, {
      headers: {
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
    });

    const json = await resposta.json();
    setFavoritos(json.data);
  } catch (erro) {
    console.log("Erro ao carregar favoritos:", erro);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": [
    {
      "id_favorito": 1,
      "id_cliente": 3,
      "id_produto": 7,
      "criado_em_favorito": "2026-10-27 12:58:38",
      "status_favorito": "ATIVO",
      "produto": {
        "id_produto": 7,
        "nome_produto": "Torta Limão Fit",
        "slug_produto": "torta-limao-fit",
        "id_categoria": 3,
        "categoria_produto": { "id_categoria": 3 }
      }
    }
  ]
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POST /favoritos ========== -->
    <section class="section" id="post-favoritos">
        <div class="doc">
            <div class="group-label">Favoritos</div>
            <h2>Favoritar produto</h2>

            <div class="endpoint-line">
                <span class="method post">POST</span>
                <span class="path">/favoritos</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Adiciona um produto aos favoritos do cliente autenticado. Se o produto já foi favoritado e removido antes, ele é reativado. Se já está favoritado, nada muda e a resposta é <code>200</code>.</p>

            <h3>Corpo da requisição</h3>
            <ul class="params">
                <li>
                    <div class="param-head">
                        <span class="param-name">id_produto</span>
                        <span class="param-type">integer</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">ID de um produto ativo, de categoria ativa.</div>
                </li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">201</span></td><td>Produto adicionado (ou reativado).</td></tr>
                    <tr><td><span class="status s2">200</span></td><td>Produto já estava nos favoritos.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Produto não encontrado ou inativo.</td></tr>
                    <tr><td><span class="status s4">422</span></td><td><code>id_produto</code> ausente ou inválido.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X POST {{BASE_URL}}/favoritos \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {token}" \
  -d '{
    "id_produto": 7
  }'</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function favoritar(idProduto) {
  const token = await AsyncStorage.getItem("token");

  try {
    const resposta = await fetch(`${API}/favoritos`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({ id_produto: idProduto }),
    });

    const json = await resposta.json();
    mostrarMensagem(json.message);
  } catch (erro) {
    console.log("Erro ao favoritar:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>201</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>404</button>
                        <button class="tab" data-panel="2"><span class="dot s4"></span>422</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Produto adicionado aos favoritos.",
  "data": {
    "id_favorito": 1,
    "id_cliente": 3,
    "id_produto": 7,
    "criado_em_favorito": "2026-10-27 12:58:38",
    "status_favorito": "ATIVO",
    "produto": {
      "id_produto": 7,
      "nome_produto": "Torta Limão Fit",
      "slug_produto": "torta-limao-fit"
    }
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Produto não encontrado."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Informe o produto.",
  "errors": {
    "id_produto": ["Informe o produto."]
  }
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== DELETE /favoritos/{id_produto} ========== -->
    <section class="section" id="delete-favoritos">
        <div class="doc">
            <div class="group-label">Favoritos</div>
            <h2>Remover favorito</h2>

            <div class="endpoint-line">
                <span class="method delete">DELETE</span>
                <span class="path">/favoritos/{id_produto}</span>
                <span class="auth-tag private">🔒 Token</span>
            </div>

            <p>Remove o produto dos favoritos do cliente autenticado. A remoção é lógica: o registro fica como <code>INATIVO</code> e pode ser reativado com <code>POST /favoritos</code>.</p>

            <h3>Parâmetros da URL</h3>
            <ul class="params">
                <li>
                    <div class="param-head">
                        <span class="param-name">id_produto</span>
                        <span class="param-type">integer</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">ID do produto (não o ID do favorito).</div>
                </li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Favorito removido.</td></tr>
                    <tr><td><span class="status s4">401</span></td><td>Token ausente ou inválido.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>O produto não está nos favoritos do cliente.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl -X DELETE {{BASE_URL}}/favoritos/7 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from "@react-native-async-storage/async-storage";
import { API } from "@/config/api";

async function desfavoritar(idProduto) {
  const token = await AsyncStorage.getItem("token");

  try {
    const resposta = await fetch(`${API}/favoritos/${idProduto}`, {
      method: "DELETE",
      headers: {
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
    });

    const json = await resposta.json();
    mostrarMensagem(json.message);
  } catch (erro) {
    console.log("Erro ao remover favorito:", erro);
    mostrarMensagem("Não foi possível conectar ao servidor.");
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>404</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "message": "Produto removido dos favoritos."
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Favorito não encontrado."
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /banners ========== -->
    <section class="section" id="get-banners">
        <div class="doc">
            <div class="group-label">Conteúdo</div>
            <h2>Listar banners</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/banners</span>
                <span class="auth-tag public">Pública</span>
            </div>

            <p>
                Retorna os banners com status <code>ATIVO</code>, ordenados por <code>ordem_banner</code>.
                Use para montar o carrossel da tela inicial.
            </p>

            <h3>Atributos retornados</h3>
            <ul class="params">
                <li>
                    <div class="param-head"><span class="param-name">titulo_banner</span><span class="param-type">string</span></div>
                    <div class="param-desc">Título principal.</div>
                </li>
                <li>
                    <div class="param-head"><span class="param-name">subtitulo_banner</span><span class="param-type">string | null</span></div>
                    <div class="param-desc">Texto de apoio.</div>
                </li>
                <li>
                    <div class="param-head"><span class="param-name">texto_botao_banner</span><span class="param-type">string | null</span></div>
                    <div class="param-desc">Texto do botão de ação.</div>
                </li>
                <li>
                    <div class="param-head"><span class="param-name">link_botao_banner</span><span class="param-type">string | null</span></div>
                    <div class="param-desc">Destino do botão (ex.: <code>/cardapio</code>).</div>
                </li>
                <li>
                    <div class="param-head"><span class="param-name">foto_banner</span><span class="param-type">string</span></div>
                    <div class="param-desc">Caminho relativo da imagem. Veja <a href="#imagens">Imagens</a>.</div>
                </li>
            </ul>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/banners \
  -H "Accept: application/json"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import { useEffect, useState } from "react";
import { API } from "@/config/api";

const [banners, setBanners] = useState([]);

useEffect(() =&gt; {
  async function carregarBanners() {
    try {
      const resposta = await fetch(`${API}/banners`, {
        headers: { Accept: "application/json" },
      });

      const json = await resposta.json();

      if (resposta.ok) {
        setBanners(json.data);
      }
    } catch (erro) {
      console.log("Erro ao carregar banners:", erro);
    }
  }

  carregarBanners();
}, []);</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": [
    {
      "id_banner": 1,
      "nome_banner": "home-vitrine",
      "titulo_banner": "Confeitaria saudável com sabor de verdade",
      "subtitulo_banner": "Bolos, doces e kits especiais para momentos que merecem carinho",
      "descricao_banner": "Uma experiência artesanal pensada para quem quer comer bem.",
      "texto_botao_banner": "Ver cardápio",
      "link_botao_banner": "/cardapio",
      "ordem_banner": 1,
      "foto_banner": "banner/home-vitrine.png",
      "status_banner": "ATIVO"
    }
  ]
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /categorias ========== -->
    <section class="section" id="get-categorias">
        <div class="doc">
            <div class="group-label">Catálogo</div>
            <h2>Listar categorias</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/categorias</span>
                <span class="auth-tag public">Pública</span>
            </div>

            <p>Retorna as categorias com status <code>ATIVO</code>, em ordem alfabética.</p>

            <h3>Parâmetros</h3>
            <p>Esta rota não recebe parâmetros.</p>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/categorias \
  -H "Accept: application/json"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import { API } from "@/config/api";

async function carregarCategorias() {
  try {
    const resposta = await fetch(`${API}/categorias`, {
      headers: { Accept: "application/json" },
    });

    const json = await resposta.json();

    if (resposta.ok) {
      setCategorias(json.data);
    }
  } catch (erro) {
    console.log("Erro ao carregar categorias:", erro);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": [
    {
      "id_categoria": 1,
      "nome_categoria": "Bolos Fit",
      "descricao_categoria": "Bolos artesanais com proposta mais leve.",
      "status_categoria": "ATIVO",
      "criado_em_categoria": "2026-04-30T11:59:52.000000Z",
      "atualizado_em_categoria": "2026-05-28T13:18:51.000000Z"
    },
    {
      "id_categoria": 2,
      "nome_categoria": "Doces Fit",
      "descricao_categoria": "Doces delicados para presentear ou celebrar.",
      "status_categoria": "ATIVO",
      "criado_em_categoria": "2026-04-30T11:59:52.000000Z",
      "atualizado_em_categoria": "2026-04-30T11:59:52.000000Z"
    }
  ]
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /categorias/{id}/produtos ========== -->
    <section class="section" id="get-categoria-produtos">
        <div class="doc">
            <div class="group-label">Catálogo</div>
            <h2>Produtos da categoria</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/categorias/<span class="param">{id}</span>/produtos</span>
                <span class="auth-tag public">Pública</span>
            </div>

            <p>
                Retorna a categoria e seus produtos com status <code>ATIVO</code>, em ordem alfabética.
                Se a categoria não existir ou estiver inativa, retorna <span class="status s4">404</span>.
            </p>

            <h3>Parâmetros de rota</h3>
            <ul class="params">
                <li>
                    <div class="param-head">
                        <span class="param-name">id</span>
                        <span class="param-type">integer</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">ID da categoria (<code>id_categoria</code>).</div>
                </li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Categoria e lista de produtos.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Categoria não encontrada ou inativa.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/categorias/1/produtos \
  -H "Accept: application/json"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import { useLocalSearchParams } from "expo-router";
import { API } from "@/config/api";

// Rota do app: /categoria/[id]
const { id } = useLocalSearchParams();

async function carregarProdutos() {
  try {
    const resposta = await fetch(`${API}/categorias/${id}/produtos`, {
      headers: { Accept: "application/json" },
    });

    const json = await resposta.json();

    // 404: "Recurso não encontrado."
    if (!resposta.ok) {
      mostrarMensagem(json.message);
      return;
    }

    setCategoria(json.data.categoria);
    setProdutos(json.data.produtos);
  } catch (erro) {
    console.log("Erro ao carregar produtos:", erro);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>404</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": {
    "categoria": {
      "id_categoria": 1,
      "nome_categoria": "Bolos Fit",
      "descricao_categoria": "Bolos artesanais com proposta mais leve.",
      "status_categoria": "ATIVO",
      "criado_em_categoria": "2026-04-30T11:59:52.000000Z",
      "atualizado_em_categoria": "2026-05-28T13:18:51.000000Z"
    },
    "produtos": [
      {
        "id_produto": 1,
        "nome_produto": "Bolo Banana Fit",
        "slug_produto": "bolo-banana-fit",
        "id_categoria": 1,
        "descricao_produto": "Fatia de bolo de banana com canela.",
        "tamanho_produto": "Médio",
        "unid_med_produto": "FT",
        "valor_produto": 14.9,
        "foto_produto": "produto/bolo-banana-fit.png",
        "status_produto": "ATIVO",
        "destaque_produto": "SIM",
        "criado_em_produto": "2026-04-30T11:58:59.000000Z",
        "atualizado_em_produto": "2026-04-30T11:59:07.000000Z"
      }
    ]
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Recurso não encontrado."
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /produtos ========== -->
    <section class="section" id="get-produtos">
        <div class="doc">
            <div class="group-label">Catálogo</div>
            <h2>Listar produtos</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/produtos</span>
                <span class="auth-tag public">Pública</span>
            </div>

            <p>
                Retorna os produtos com status <code>ATIVO</code> que pertencem a uma categoria ativa,
                em ordem alfabética. Cada produto inclui sua categoria em <code>categoria_produto</code>.
            </p>

            <h3>Atributos retornados</h3>
            <ul class="params">
                <li>
                    <div class="param-head"><span class="param-name">slug_produto</span><span class="param-type">string</span></div>
                    <div class="param-desc">Identificador amigável, usado em <a href="#get-produto"><code>GET /produtos/{slug}</code></a>.</div>
                </li>
                <li>
                    <div class="param-head"><span class="param-name">valor_produto</span><span class="param-type">number</span></div>
                    <div class="param-desc">Preço em reais.</div>
                </li>
                <li>
                    <div class="param-head"><span class="param-name">unid_med_produto</span><span class="param-type">string</span></div>
                    <div class="param-desc">Unidade de venda (ex.: <code>FT</code> = fatia, <code>UN</code> = unidade).</div>
                </li>
                <li>
                    <div class="param-head"><span class="param-name">destaque_produto</span><span class="param-type">"SIM" | "NAO"</span></div>
                    <div class="param-desc">Indica se o produto aparece em destaque.</div>
                </li>
                <li>
                    <div class="param-head"><span class="param-name">categoria_produto</span><span class="param-type">object</span></div>
                    <div class="param-desc">Categoria à qual o produto pertence.</div>
                </li>
            </ul>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/produtos \
  -H "Accept: application/json"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import { API } from "@/config/api";

async function carregarProdutos() {
  try {
    const resposta = await fetch(`${API}/produtos`, {
      headers: { Accept: "application/json" },
    });

    const json = await resposta.json();

    if (resposta.ok) {
      setProdutos(json.data);

      // Ex.: só os destaques
      setDestaques(json.data.filter((p) =&gt; p.destaque_produto === "SIM"));
    }
  } catch (erro) {
    console.log("Erro ao carregar produtos:", erro);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": [
    {
      "id_produto": 1,
      "nome_produto": "Bolo Banana Fit",
      "slug_produto": "bolo-banana-fit",
      "id_categoria": 1,
      "descricao_produto": "Fatia de bolo de banana com canela.",
      "tamanho_produto": "Médio",
      "unid_med_produto": "FT",
      "valor_produto": 14.9,
      "foto_produto": "produto/bolo-banana-fit.png",
      "status_produto": "ATIVO",
      "destaque_produto": "SIM",
      "criado_em_produto": "2026-04-30T11:58:59.000000Z",
      "atualizado_em_produto": "2026-04-30T11:59:07.000000Z",
      "categoria_produto": {
        "id_categoria": 1,
        "nome_categoria": "Bolos Fit",
        "descricao_categoria": "Bolos artesanais com proposta mais leve.",
        "status_categoria": "ATIVO",
        "criado_em_categoria": "2026-04-30T11:59:52.000000Z",
        "atualizado_em_categoria": "2026-05-28T13:18:51.000000Z"
      }
    }
  ]
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GET /produtos/{slug} ========== -->
    <section class="section" id="get-produto">
        <div class="doc">
            <div class="group-label">Catálogo</div>
            <h2>Detalhar produto</h2>

            <div class="endpoint-line">
                <span class="method get">GET</span>
                <span class="path">/produtos/<span class="param">{slug}</span></span>
                <span class="auth-tag public">Pública</span>
            </div>

            <p>
                Retorna um produto ativo pelo seu slug, com a categoria incluída. Se o produto não existir,
                estiver inativo ou pertencer a uma categoria inativa, retorna <span class="status s4">404</span>.
            </p>

            <h3>Parâmetros de rota</h3>
            <ul class="params">
                <li>
                    <div class="param-head">
                        <span class="param-name">slug</span>
                        <span class="param-type">string</span>
                        <span class="param-req">obrigatório</span>
                    </div>
                    <div class="param-desc">Slug do produto (<code>slug_produto</code>), ex.: <code>bolo-banana-fit</code>.</div>
                </li>
            </ul>

            <h3>Respostas</h3>
            <table class="table">
                <tbody>
                    <tr><td><span class="status s2">200</span></td><td>Detalhes do produto.</td></tr>
                    <tr><td><span class="status s4">404</span></td><td>Produto não encontrado ou inativo.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="code">
            <div class="code-sticky">
                <div class="code-title">Requisição</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">cURL</button>
                        <button class="tab" data-panel="1">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="bash">curl {{BASE_URL}}/produtos/bolo-banana-fit \
  -H "Accept: application/json"</code></pre></div>
                    <div class="panel"><pre><code data-lang="js">import { useLocalSearchParams } from "expo-router";
import { API } from "@/config/api";

// Rota do app: /produto/[slug]
const { slug } = useLocalSearchParams();

async function carregarProduto() {
  try {
    const resposta = await fetch(`${API}/produtos/${slug}`, {
      headers: { Accept: "application/json" },
    });

    const json = await resposta.json();

    // 404: "Recurso não encontrado."
    if (!resposta.ok) {
      mostrarMensagem(json.message);
      return;
    }

    setProduto(json.data);
  } catch (erro) {
    console.log("Erro ao carregar produto:", erro);
  }
}</code></pre></div>
                </div>

                <div class="code-title">Resposta</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0"><span class="dot s2"></span>200</button>
                        <button class="tab" data-panel="1"><span class="dot s4"></span>404</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="json">{
  "success": true,
  "data": {
    "id_produto": 1,
    "nome_produto": "Bolo Banana Fit",
    "slug_produto": "bolo-banana-fit",
    "id_categoria": 1,
    "descricao_produto": "Fatia de bolo de banana com canela, textura macia e preparo artesanal.",
    "tamanho_produto": "Médio",
    "unid_med_produto": "FT",
    "valor_produto": 14.9,
    "foto_produto": "produto/bolo-banana-fit.png",
    "status_produto": "ATIVO",
    "destaque_produto": "SIM",
    "criado_em_produto": "2026-04-30T11:58:59.000000Z",
    "atualizado_em_produto": "2026-04-30T11:59:07.000000Z",
    "categoria_produto": {
      "id_categoria": 1,
      "nome_categoria": "Bolos Fit",
      "descricao_categoria": "Bolos artesanais com proposta mais leve.",
      "status_categoria": "ATIVO",
      "criado_em_categoria": "2026-04-30T11:59:52.000000Z",
      "atualizado_em_categoria": "2026-05-28T13:18:51.000000Z"
    }
  }
}</code></pre></div>
                    <div class="panel"><pre><code data-lang="json">{
  "success": false,
  "message": "Recurso não encontrado."
}</code></pre></div>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    (function () {
        // ---------- Ambientes (servidores) ----------
        const URL_ATUAL = document.querySelector('meta[name="api-base"]').content;
        const URL_PRODUCAO = 'https://xyzcode.tipi5.smpsistema.com.br/davilla/api/v1';

        const SERVIDORES = URL_ATUAL === URL_PRODUCAO
            ? [{ nome: 'Produção', url: URL_PRODUCAO }]
            : [{ nome: 'Local', url: URL_ATUAL }, { nome: 'Produção', url: URL_PRODUCAO }];

        let BASE_URL = URL_ATUAL;
        try {
            const salvo = localStorage.getItem('davilla-api-servidor');
            if (SERVIDORES.some((s) => s.url === salvo)) BASE_URL = salvo;
        } catch (e) { }

        // Imagens ficam em {APP_URL}/davilla/images/
        const urlImagens = () => BASE_URL.replace(/\/api\/v1\/?$/, '') + '/davilla/images/';

        const preencher = (texto) => texto
            .replaceAll('{{BASE_URL}}', BASE_URL)
            .replaceAll('{{IMAGES_URL}}', urlImagens());

        // Guarda o texto original (com os marcadores) para poder trocar de ambiente
        document.querySelectorAll('.js-base, .js-images, pre code[data-lang]').forEach((el) => {
            el.dataset.tpl = el.textContent;
        });

        // ---------- Syntax highlight ----------
        const escapar = (s) => s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

        function destacarJson(codigo) {
            return escapar(codigo).replace(
                /("(?:\\.|[^"\\])*")(\s*:)?|\b(true|false)\b|\bnull\b|-?\b\d+(?:\.\d+)?\b/g,
                (m, str, doisPontos, bool) => {
                    if (str) return doisPontos
                        ? `<span class="tk-key">${str}</span>${doisPontos}`
                        : `<span class="tk-str">${str}</span>`;
                    if (bool) return `<span class="tk-bool">${m}</span>`;
                    if (m === 'null') return `<span class="tk-null">${m}</span>`;
                    return `<span class="tk-num">${m}</span>`;
                }
            );
        }

        function destacarBash(codigo) {
            return escapar(codigo).replace(
                /('(?:[^'])*'|"(?:\\.|[^"\\])*")|(^|\s)(curl)\b|(\s)(-[A-Za-z]+)\b/gm,
                (m, str, pre1, cmd, pre2, flag) => {
                    if (str) return `<span class="tk-str">${str}</span>`;
                    if (cmd) return `${pre1}<span class="tk-cmd">${cmd}</span>`;
                    return `${pre2}<span class="tk-flag">${flag}</span>`;
                }
            );
        }

        function destacarJs(codigo) {
            return escapar(codigo).replace(
                /('(?:\\.|[^'\\])*'|`(?:\\.|[^`\\])*`|"(?:\\.|[^"\\])*")|(\/\/.*$)|\b(const|let|await|async|return|true|false|null)\b|\b(\d+)\b/gm,
                (m, str, comentario, kw, num) => {
                    if (str) return `<span class="tk-str">${str}</span>`;
                    if (comentario) return `<span style="color:#697098">${comentario}</span>`;
                    if (kw) return `<span class="tk-kw">${kw}</span>`;
                    return `<span class="tk-num">${num}</span>`;
                }
            );
        }

        function destacarPostman(codigo) {
            return escapar(codigo)
                .replace(/^(GET|POST|PUT|PATCH|DELETE)\b/m, '<span class="tk-cmd">$1</span>')
                .replace(/^(Authorization|Headers|Body.*|Params)$/gm, '<span class="tk-key">$1</span>')
                .replace(/\{\{\w+\}\}/g, '<span class="tk-num">$&</span>');
        }

        const destacar = { json: destacarJson, bash: destacarBash, js: destacarJs, postman: destacarPostman };

        // ---------- Postman: lê os exemplos cURL de cada endpoint ----------
        function lerCurl(texto) {
            const linha = texto.replace(/\\\n\s*/g, ' ');
            const corpo = linha.match(/-d '([\s\S]*?)'/);
            const headers = [...linha.matchAll(/-H "([^:]+): ([^"]+)"/g)]
                .map(([, key, value]) => ({ key, value }))
                .filter((h) => h.key !== 'Authorization');

            // Upload de arquivo: -F "campo=@/caminho/arquivo"
            const formulario = [...linha.matchAll(/-F "([^=]+)=(@?)([^"]*)"/g)]
                .map(([, key, arquivo, value]) => ({ key, arquivo: arquivo === '@', value }));

            return {
                method: (linha.match(/-X (\w+)/) || [, formulario.length ? 'POST' : 'GET'])[1],
                url: linha.match(/curl (?:-X \w+ )?"?([^"\s]+)"?/)[1].replace(BASE_URL, '{{base_url}}'),
                headers,
                formulario,
                body: corpo ? JSON.stringify(JSON.parse(corpo[1]), null, 2) : null
            };
        }

        const endpoints = [];

        document.querySelectorAll('.section').forEach((secao) => {
            const codigoCurl = secao.querySelector('.endpoint-line') && secao.querySelector('code[data-lang="bash"]');
            if (!codigoCurl) return;

            const req = lerCurl(preencher(codigoCurl.dataset.tpl));
            req.nome = secao.querySelector('h2').textContent.trim();
            req.pasta = secao.querySelector('.group-label').textContent.trim();
            req.privada = !!secao.querySelector('.auth-tag.private');
            endpoints.push(req);

            // Aba "Postman" no bloco de requisição
            let texto = `${req.method} ${req.url}\n\nAuthorization\n`;
            texto += req.privada ? '  Bearer Token: {{token}}\n' : '  No Auth\n';
            texto += '\nHeaders\n' + req.headers.map((h) => `  ${h.key}: ${h.value}`).join('\n') + '\n';
            if (req.body) texto += '\nBody › raw › JSON\n' + req.body;
            if (req.formulario.length) {
                texto += '\nBody › form-data\n' + req.formulario
                    .map((f) => `  ${f.key} (${f.arquivo ? 'File' : 'Text'})`).join('\n');
            }

            const bloco = codigoCurl.closest('[data-tabs]');
            const indice = bloco.querySelectorAll('.panel').length;

            const aba = document.createElement('button');
            aba.className = 'tab';
            aba.dataset.panel = indice;
            aba.textContent = 'Postman';
            bloco.querySelector('.copy').before(aba);

            const painel = document.createElement('div');
            painel.className = 'panel';
            painel.innerHTML = '<pre><code data-lang="postman"></code></pre>';
            painel.querySelector('code').dataset.tpl = texto;
            bloco.appendChild(painel);
        });

        // ---------- Postman: coleção para download ----------
        // Troca valores fixos dos exemplos por variáveis da coleção, para o teste funcionar de verdade:
        // ids criados pelo próprio teste, data futura e cupom opcional.
        function comVariaveis(texto) {
            return texto
                .replace(/\/pedidos\/\d+/g, '/pedidos/{{pedido_id}}')
                .replace(/\/enderecos\/\d+/g, '/enderecos/{{endereco_id}}')
                .replace(/("id_endereco":\s*)\d+/g, '$1{{endereco_id}}')
                .replace(/("data_entrega":\s*)"[^"]*"/g, '$1"{{data_entrega}}"')
                .replace(/("codigo_cupom":\s*)"[^"]*"/g, '$1"{{codigo_cupom}}"');
        }

        // Guarda no Postman o id devolvido por uma criação, para as próximas requisições usarem
        function salvarCampo(variavel, caminho) {
            return [
                'const json = pm.response.json();',
                '',
                `if (json.success) {`,
                `  pm.collectionVariables.set('${variavel}', json.data.${caminho});`,
                '}'
            ];
        }

        function gerarColecao() {
            const pastas = {};

            endpoints.forEach((req) => {
                let urlCompleta = comVariaveis(req.url);

                // Remover endereço apaga um endereço criado só para esse teste, preservando o que os pedidos usam
                const removeEndereco = req.method === 'DELETE' && /\/enderecos\//.test(req.url);
                if (removeEndereco) urlCompleta = urlCompleta.replace('{{endereco_id}}', '{{endereco_remover_id}}');

                const [rota, consulta] = urlCompleta.split('?');
                const caminho = rota.replace('{{base_url}}', '').split('/').filter(Boolean);

                const url = { raw: urlCompleta, host: ['{{base_url}}'], path: caminho };
                if (consulta) {
                    url.query = consulta.split('&').map((par) => {
                        const [key, value = ''] = par.split('=');
                        return { key, value };
                    });
                }

                const item = {
                    name: req.nome,
                    request: {
                        method: req.method,
                        header: req.headers.map((h) => ({ key: h.key, value: h.value })),
                        url
                    }
                };

                if (!req.privada) item.request.auth = { type: 'noauth' };

                if (req.body) {
                    item.request.body = { mode: 'raw', raw: comVariaveis(req.body), options: { raw: { language: 'json' } } };
                }

                if (req.formulario.length) {
                    item.request.body = {
                        mode: 'formdata',
                        formdata: req.formulario.map((f) => (
                            f.arquivo
                                ? { key: f.key, type: 'file', src: [] }
                                : { key: f.key, type: 'text', value: f.value }
                        ))
                    };
                }

                // Login e cadastro salvam o token; criar pedido e endereço salvam o id para os testes seguintes
                let script = null;
                if (req.url.endsWith('/auth/login') || req.url.endsWith('/auth/cadastro')) {
                    script = salvarCampo('token', 'token');
                } else if (req.method === 'POST' && req.url.endsWith('/pedidos')) {
                    script = salvarCampo('pedido_id', 'id_venda');
                } else if (req.method === 'POST' && req.url.endsWith('/enderecos')) {
                    script = salvarCampo('endereco_id', 'id_endereco');
                }

                item.event = [];
                if (script) {
                    item.event.push({ listen: 'test', script: { type: 'text/javascript', exec: script } });
                }

                if (removeEndereco) {
                    item.event.push({
                        listen: 'prerequest',
                        script: {
                            type: 'text/javascript',
                            exec: [
                                '// Cria um endereço descartável para este teste remover',
                                'pm.sendRequest({',
                                "  url: pm.collectionVariables.get('base_url') + '/enderecos',",
                                "  method: 'POST',",
                                '  header: {',
                                "    Accept: 'application/json',",
                                "    'Content-Type': 'application/json',",
                                "    Authorization: 'Bearer ' + pm.collectionVariables.get('token')",
                                '  },',
                                '  body: {',
                                "    mode: 'raw',",
                                "    raw: JSON.stringify({ nome_endereco: 'Temporario', endereco: 'Rua B', numero: '2', bairro: 'Centro', cidade: 'Sao Paulo', uf: 'SP', cep: '01001-000' })",
                                '  }',
                                '}, (erro, resposta) => {',
                                '  if (!erro) {',
                                "    pm.collectionVariables.set('endereco_remover_id', resposta.json().data.id_endereco);",
                                '  }',
                                '});'
                            ]
                        }
                    });
                }

                if (!item.event.length) delete item.event;

                (pastas[req.pasta] = pastas[req.pasta] || []).push(item);
            });

            return {
                info: {
                    name: 'API — Confeitaria DaVilla',
                    description: 'Coleção gerada a partir da documentação da API (' + BASE_URL + ').',
                    schema: 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json'
                },
                auth: { type: 'bearer', bearer: [{ key: 'token', value: '{{token}}', type: 'string' }] },
                // Antes de cada requisição, calcula uma data de entrega futura (2 dias à frente, às 15h)
                event: [{
                    listen: 'prerequest',
                    script: {
                        type: 'text/javascript',
                        exec: [
                            'const data = new Date();',
                            'data.setDate(data.getDate() + 2);',
                            "const dois = (n) => String(n).padStart(2, '0');",
                            "pm.collectionVariables.set('data_entrega', data.getFullYear() + '-' + dois(data.getMonth() + 1) + '-' + dois(data.getDate()) + ' 15:00');"
                        ]
                    }
                }],
                variable: [
                    { key: 'base_url', value: BASE_URL },
                    { key: 'token', value: '' },
                    { key: 'pedido_id', value: '' },
                    { key: 'endereco_id', value: '' },
                    { key: 'endereco_remover_id', value: '' },
                    { key: 'data_entrega', value: '' },
                    { key: 'codigo_cupom', value: '' }
                ],
                // Ordem pensada para rodar a coleção inteira: endereço e favoritos antes de fazer o pedido
                item: Object.entries(pastas)
                    .sort(([a], [b]) => {
                        const ordem = ['Geral', 'Autenticação', 'Cliente', 'Endereços', 'Favoritos', 'Pedidos', 'Conteúdo', 'Catálogo'];
                        const pos = (n) => (ordem.indexOf(n) === -1 ? ordem.length : ordem.indexOf(n));
                        return pos(a) - pos(b);
                    })
                    .map(([name, item]) => ({ name, item }))
            };
        }

        document.querySelectorAll('.js-postman').forEach((botao) => {
            botao.addEventListener('click', () => {
                const arquivo = new Blob([JSON.stringify(gerarColecao(), null, 2)], { type: 'application/json' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(arquivo);
                link.download = 'DaVilla-API.postman_collection.json';
                link.click();
                URL.revokeObjectURL(link.href);
            });
        });

        // ---------- Renderiza URLs e exemplos do ambiente escolhido ----------
        function renderizar() {
            document.querySelectorAll('.js-base, .js-images').forEach((el) => {
                el.textContent = preencher(el.dataset.tpl);
            });

            document.querySelectorAll('pre code[data-lang]').forEach((el) => {
                const bruto = preencher(el.dataset.tpl);
                el.dataset.raw = bruto;
                el.innerHTML = (destacar[el.dataset.lang] || escapar)(bruto);
            });
        }

        const seletor = document.getElementById('servidor');

        SERVIDORES.forEach((s) => {
            const opcao = document.createElement('option');
            opcao.value = s.url;
            opcao.textContent = s.nome;
            opcao.selected = s.url === BASE_URL;
            seletor.appendChild(opcao);
        });

        seletor.addEventListener('change', () => {
            BASE_URL = seletor.value;
            try { localStorage.setItem('davilla-api-servidor', BASE_URL); } catch (e) { }
            renderizar();
        });

        renderizar();

        // ---------- Abas ----------
        document.querySelectorAll('[data-tabs]').forEach((bloco) => {
            const abas = bloco.querySelectorAll('.tab');
            const paineis = bloco.querySelectorAll('.panel');

            abas.forEach((aba) => {
                aba.addEventListener('click', () => {
                    abas.forEach((a) => a.classList.remove('active'));
                    paineis.forEach((p) => p.classList.remove('active'));
                    aba.classList.add('active');
                    paineis[aba.dataset.panel].classList.add('active');
                });
            });

            // ---------- Copiar ----------
            const botaoCopiar = bloco.querySelector('.copy');
            botaoCopiar.addEventListener('click', async () => {
                const codigo = bloco.querySelector('.panel.active code').dataset.raw;
                try {
                    await navigator.clipboard.writeText(codigo);
                    botaoCopiar.textContent = 'Copiado!';
                } catch (e) {
                    botaoCopiar.textContent = 'Erro';
                }
                setTimeout(() => (botaoCopiar.textContent = 'Copiar'), 1500);
            });
        });

        // ---------- Menu ativo conforme a rolagem ----------
        const links = [...document.querySelectorAll('.nav-link')];
        const secoes = links
            .map((l) => document.querySelector(l.getAttribute('href')))
            .filter(Boolean);

        const observer = new IntersectionObserver((entradas) => {
            entradas.forEach((entrada) => {
                if (!entrada.isIntersecting) return;
                links.forEach((l) => l.classList.toggle('active', l.getAttribute('href') === '#' + entrada.target.id));
            });
        }, { rootMargin: '-80px 0px -70% 0px' });

        secoes.forEach((s) => observer.observe(s));

        // ---------- Busca ----------
        const busca = document.getElementById('search');
        const vazio = document.getElementById('navEmpty');

        busca.addEventListener('input', () => {
            const termo = busca.value.trim().toLowerCase();
            let total = 0;

            document.querySelectorAll('.nav-group').forEach((grupo) => {
                let visiveis = 0;
                grupo.querySelectorAll('.nav-link').forEach((link) => {
                    const secao = document.querySelector(link.getAttribute('href'));
                    const caminho = secao ? (secao.querySelector('.path')?.textContent || '') : '';
                    const alvo = (link.textContent + ' ' + caminho).toLowerCase();
                    const mostrar = !termo || alvo.includes(termo);
                    link.style.display = mostrar ? '' : 'none';
                    if (mostrar) visiveis++;
                });
                grupo.style.display = visiveis ? '' : 'none';
                total += visiveis;
            });

            vazio.style.display = total ? 'none' : 'block';
        });

        // ---------- Menu mobile ----------
        const sidebar = document.getElementById('sidebar');
        document.getElementById('menuToggle').addEventListener('click', () => sidebar.classList.toggle('open'));
        links.forEach((l) => l.addEventListener('click', () => sidebar.classList.remove('open')));
    })();
</script>

@endverbatim
</body>
</html>
