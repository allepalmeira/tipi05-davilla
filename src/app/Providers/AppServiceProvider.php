<?php

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
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
            $listaCategoria = Categoria::where('status_categoria', 'ATIVO')
                ->orderBy('nome_categoria')
                ->get();

            //dd($listaCategoria);
            //var_dump($listaCategoria);

            $view->with('lista', $listaCategoria);

        });

        // API: até 5 tentativas de login por minuto para o mesmo e-mail + IP
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by(
                Str::lower((string) $request->input('email')) . '|' . $request->ip()
            );
        });


    }
}
