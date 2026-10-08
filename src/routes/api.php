<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\StatusController;
use App\Http\Controllers\Api\V1\BannerController;
use App\Http\Controllers\Api\V1\CategoriaController;
use App\Http\Controllers\Api\V1\ProdutoController;


use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ClienteController;

Route::prefix('v1')->group(function () {

    // LOGIN - rota pública
    Route::post('/auth/login', [AuthController::class, 'login']);

    // CADASTRO - rota pública (limite de 10 cadastros por minuto por IP)
    Route::post('/auth/cadastro', [AuthController::class, 'cadastro'])->middleware('throttle:10,1');

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
