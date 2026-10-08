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
        <a class="nav-link" href="#post-logout"><span class="method post">POST</span> Logout</a>
    </div>

    <div class="nav-group">
        <div class="nav-title">Cliente</div>
        <a class="nav-link" href="#get-cliente"><span class="method get">GET</span> Dados do cliente</a>
        <a class="nav-link" href="#put-cliente"><span class="method put">PUT</span> Atualizar cliente</a>
        <a class="nav-link" href="#put-cliente-senha"><span class="method put">PUT</span> Alterar senha</a>
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
                No React Native, centralize as chamadas no helper <code>api()</code> ao lado: ele monta a URL,
                envia os cabeçalhos e o token automaticamente e lança um erro quando o status não é 2xx.
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
                <div class="code-title">src/services/api.js</div>
                <div class="block" data-tabs>
                    <div class="block-head">
                        <button class="tab active" data-panel="0">React Native</button>
                        <button class="copy" type="button">Copiar</button>
                    </div>
                    <div class="panel active"><pre><code data-lang="js">import AsyncStorage from '@react-native-async-storage/async-storage';

// Emulador Android: http://10.0.2.2:PORTA/api/v1
// Celular físico: http://IP-DO-COMPUTADOR:PORTA/api/v1
export const API_URL = '{{BASE_URL}}';

export async function api(rota, { method = 'GET', body } = {}) {
  const token = await AsyncStorage.getItem('token');

  const resposta = await fetch(API_URL + rota, {
    method,
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
      ...(token && { Authorization: `Bearer ${token}` })
    },
    body: body ? JSON.stringify(body) : undefined
  });

  const json = await resposta.json();

  // Erros (401, 404, 422...) caem no catch de quem chamou
  if (!resposta.ok) throw { status: resposta.status, ...json };

  return json;
}</code></pre></div>
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
                    <div class="panel"><pre><code data-lang="js">import { api } from './services/api';

const json = await api('/status');
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
                    <div class="panel"><pre><code data-lang="js">import { api } from './services/api';

// O helper lê o token salvo e envia
// "Authorization: Bearer {token}" automaticamente
const { data: cliente } = await api('/cliente');</code></pre></div>
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
                        <td>Preenchida automaticamente após o login.</td>
                    </tr>
                </tbody>
            </table>

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
                Em erros de validação (<span class="status s4">422</span>), o objeto <code>errors</code>
                traz a lista de mensagens de cada campo inválido.
            </p>
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
  "message": "The email field is required. (and 1 more error)",
  "errors": {
    "email": ["The email field is required."],
    "senha": ["The senha field is required."]
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
                Campos de imagem como <code>foto_produto</code> e <code>foto_banner</code> retornam um
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
                    <div class="panel active"><pre><code data-lang="js">import { Image } from 'react-native';

const IMAGENS = '{{IMAGES_URL}}';

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
                    <div class="panel"><pre><code data-lang="js">import { api } from './services/api';

const { data } = await api('/status');</code></pre></div>
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
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from '@react-native-async-storage/async-storage';
import { api } from './services/api';

try {
  const { data } = await api('/auth/login', {
    method: 'POST',
    body: {
      email: 'maria@email.com',
      senha: '12345678',
      device_name: 'iphone-maria'
    }
  });

  await AsyncStorage.setItem('token', data.token);
} catch (erro) {
  // 401: credenciais inválidas | 403: cliente inativo | 422: validação
  alert(erro.message);
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
  "message": "The email field is required. (and 1 more error)",
  "errors": {
    "email": ["The email field is required."],
    "senha": ["The senha field is required."]
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
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from '@react-native-async-storage/async-storage';
import { api } from './services/api';

try {
  const { data } = await api('/auth/cadastro', {
    method: 'POST',
    body: {
      nome,
      email,
      telefone,
      senha,
      aceite_termo: aceitouTermo // valor do Switch/Checkbox
    }
  });

  // Já entra logado
  await AsyncStorage.setItem('token', data.token);
} catch (erro) {
  // erro.errors.email[0] -> "Este e-mail já está cadastrado."
  // erro.errors.aceite_termo[0] -> "É necessário aceitar o termo..."
  console.log(erro.errors);
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
  "message": "Este e-mail já está cadastrado. (and 1 more error)",
  "errors": {
    "email": ["Este e-mail já está cadastrado."],
    "aceite_termo": ["É necessário aceitar o termo de consentimento."]
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
                    <div class="panel"><pre><code data-lang="js">import AsyncStorage from '@react-native-async-storage/async-storage';
import { api } from './services/api';

await api('/auth/logout', { method: 'POST' });
await AsyncStorage.removeItem('token');</code></pre></div>
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
  "message": "Unauthenticated."
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
                    <div class="panel"><pre><code data-lang="js">import { api } from './services/api';

const { data: cliente } = await api('/cliente');</code></pre></div>
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
  "message": "Unauthenticated."
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
                    <div class="panel"><pre><code data-lang="js">import { api } from './services/api';

try {
  const { data: cliente } = await api('/cliente', {
    method: 'PUT',
    body: {
      nome_cliente: 'Maria Souza',
      tipo_cliente: 'PF',
      cpf_cnpj_cliente: '123.456.789-00',
      data_nasc_cliente: '1990-05-12',
      email_cliente: 'maria@email.com',
      telefone_cliente: '(11)98888-0000'
    }
  });
} catch (erro) {
  // erro.errors.email_cliente[0], erro.errors.cpf_cnpj_cliente[0]...
  console.log(erro.errors);
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
  "message": "The email cliente has already been taken.",
  "errors": {
    "email_cliente": ["The email cliente has already been taken."]
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
                    <div class="panel"><pre><code data-lang="js">import { api } from './services/api';

await api('/cliente/senha', {
  method: 'PUT',
  body: {
    senha_atual: '12345678',
    nova_senha: 'novaSenha2026',
    nova_senha_confirmation: 'novaSenha2026'
  }
});</code></pre></div>
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
  "message": "The nova senha field confirmation does not match.",
  "errors": {
    "nova_senha": ["The nova senha field confirmation does not match."]
  }
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
                    <div class="panel"><pre><code data-lang="js">import { useEffect, useState } from 'react';
import { api } from './services/api';

const [banners, setBanners] = useState([]);

useEffect(() => {
  api('/banners').then(({ data }) => setBanners(data));
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
                    <div class="panel"><pre><code data-lang="js">import { api } from './services/api';

const { data: categorias } = await api('/categorias');</code></pre></div>
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
                    <div class="panel"><pre><code data-lang="js">import { api } from './services/api';

const id = 1;
const { data } = await api(`/categorias/${id}/produtos`);

// data.categoria  -> dados da categoria
// data.produtos   -> lista de produtos</code></pre></div>
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
  "message": "No query results for model [App\\Models\\Categoria]."
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
                    <div class="panel"><pre><code data-lang="js">import { api } from './services/api';

const { data: produtos } = await api('/produtos');

// Ex.: produtos.filter(p => p.destaque_produto === 'SIM')</code></pre></div>
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
                    <div class="panel"><pre><code data-lang="js">import { api } from './services/api';

// Ex.: slug recebido pela navegação (route.params.slug)
const slug = 'bolo-banana-fit';
const { data: produto } = await api(`/produtos/${slug}`);</code></pre></div>
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
  "message": "No query results for model [App\\Models\\Produto]."
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

            return {
                method: (linha.match(/-X (\w+)/) || [, 'GET'])[1],
                url: linha.match(/curl (?:-X \w+ )?(\S+)/)[1].replace(BASE_URL, '{{base_url}}'),
                headers,
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
        function gerarColecao() {
            const pastas = {};

            endpoints.forEach((req) => {
                const caminho = req.url.replace('{{base_url}}', '').split('/').filter(Boolean);

                const item = {
                    name: req.nome,
                    request: {
                        method: req.method,
                        header: req.headers.map((h) => ({ key: h.key, value: h.value })),
                        url: { raw: req.url, host: ['{{base_url}}'], path: caminho }
                    }
                };

                if (!req.privada) item.request.auth = { type: 'noauth' };

                if (req.body) {
                    item.request.body = { mode: 'raw', raw: req.body, options: { raw: { language: 'json' } } };
                }

                // Login e cadastro salvam o token automaticamente
                if (req.url.endsWith('/auth/login') || req.url.endsWith('/auth/cadastro')) {
                    item.event = [{
                        listen: 'test',
                        script: {
                            type: 'text/javascript',
                            exec: [
                                'const json = pm.response.json();',
                                '',
                                'if (json.success) {',
                                "  pm.collectionVariables.set('token', json.data.token);",
                                '}'
                            ]
                        }
                    }];
                }

                (pastas[req.pasta] = pastas[req.pasta] || []).push(item);
            });

            return {
                info: {
                    name: 'API — Confeitaria DaVilla',
                    description: 'Coleção gerada a partir da documentação da API (' + BASE_URL + ').',
                    schema: 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json'
                },
                auth: { type: 'bearer', bearer: [{ key: 'token', value: '{{token}}', type: 'string' }] },
                variable: [
                    { key: 'base_url', value: BASE_URL },
                    { key: 'token', value: '' }
                ],
                item: Object.entries(pastas).map(([name, item]) => ({ name, item }))
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
