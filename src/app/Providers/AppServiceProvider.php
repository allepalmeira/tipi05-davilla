<?php

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Categoria;
//use Illuminate\View\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         View::composer('partials.header', function ($view) {

            // Buscar todas as categorias ordenar por nome
            $categorias = Categoria::orderBy('nome_categoria')->get();

            dd($categorias);
            //var_dump($categorias);

            $view->with('categorias', $categorias);

        });
       

    }
}
