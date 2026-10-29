<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\StatusController;
use App\Http\Controllers\Api\V1\BannerController;
use App\Http\Controllers\Api\V1\CategoriaController;
use App\Http\Controllers\Api\V1\ProdutoController;


use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ClienteController;
use App\Http\Controllers\Api\V1\FavoritoController;
use App\Http\Controllers\Api\V1\EnderecoController;
use App\Http\Controllers\Api\V1\PedidoController;

Route::prefix('v1')->group(function () {

    // LOGIN - rota pública
    Route::post('/auth/login', [AuthController::class, 'login'])->middleware('throttle:login');

    // CADASTRO - rota pública (limite de 10 cadastros por minuto por IP)
    Route::post('/auth/cadastro', [AuthController::class, 'cadastro'])->middleware('throttle:10,1');

    // RECUPERAÇÃO DE SENHA - rotas públicas
    // Fluxo no aplicativo: código de 4 dígitos por e-mail -> reset_token -> nova senha
    Route::post('/auth/esqueci-senha', [AuthController::class, 'esqueciSenha'])->middleware('throttle:recuperacao-solicitar');
    Route::post('/auth/validar-codigo', [AuthController::class, 'validarCodigo'])->middleware('throttle:recuperacao-validar');
    Route::post('/auth/redefinir-senha', [AuthController::class, 'redefinirSenha'])->middleware('throttle:recuperacao-redefinir');

    // ROTAS COM CREDENCIAL
    Route::middleware('auth:sanctum')->group(function () {

        // Cliente logado
        Route::get('/cliente', [ClienteController::class, 'show']);

        // Atualizar os dados
        Route::put('/cliente', [ClienteController::class, 'update']);

        // Também permite atualização parcial
        Route::patch('/cliente', [ClienteController::class, 'update']);

        // Atualizar senha
        Route::put(
            '/cliente/senha',
            [ClienteController::class, 'updateSenha']
        );

        // Favoritos
        Route::get('/favoritos', [FavoritoController::class, 'index']);
        Route::post('/favoritos', [FavoritoController::class, 'store']);
        Route::delete('/favoritos/{id_produto}', [FavoritoController::class, 'destroy'])->whereNumber('id_produto');

        // Pedidos
        Route::get('/pedidos', [PedidoController::class, 'index']);
        Route::post('/pedidos', [PedidoController::class, 'store'])->middleware('throttle:20,1');
        Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->whereNumber('id');
        Route::get('/pedidos/{id}/status', [PedidoController::class, 'status'])->whereNumber('id');
        Route::put('/pedidos/{id}/cancelar', [PedidoController::class, 'cancelar'])->whereNumber('id');

        // Foto do cliente (POST porque envia arquivo via multipart/form-data)
        Route::post('/cliente/foto', [ClienteController::class, 'updateFoto']);
        Route::delete('/cliente/foto', [ClienteController::class, 'destroyFoto']);

        // Endereços
        Route::get('/enderecos', [EnderecoController::class, 'index']);
        Route::post('/enderecos', [EnderecoController::class, 'store']);
        Route::get('/enderecos/{id}', [EnderecoController::class, 'show'])->whereNumber('id');
        Route::put('/enderecos/{id}', [EnderecoController::class, 'update'])->whereNumber('id');
        Route::patch('/enderecos/{id}', [EnderecoController::class, 'update'])->whereNumber('id');
        Route::put('/enderecos/{id}/principal', [EnderecoController::class, 'principal'])->whereNumber('id');
        Route::delete('/enderecos/{id}', [EnderecoController::class, 'destroy'])->whereNumber('id');

        // Logout
        Route::post('/auth/logout', [AuthController::class, 'logout']);
    });
    

    // Status da API
    Route::get('/status', [StatusController::class, 'index']);

    // Banners
    Route::get('/banners', [BannerController::class, 'index']);

    // Categorias
    Route::get('/categorias', [CategoriaController::class, 'index']);
    Route::get('/categorias/{id}/produtos', [CategoriaController::class, 'produtos']);

    // Produtos
    Route::get('/produtos', [ProdutoController::class, 'index']);
    Route::get('/produtos/{slug}', [ProdutoController::class, 'show']);
});
