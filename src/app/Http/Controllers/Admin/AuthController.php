<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function login()
    {

        return view('admin.auth.login');
    }

    public function autenticar(Request $request)
    {

        $request->validate([
            'email_usuario' => 'required|email',
            'senha_usuario' => 'required',
        ]);

        // Credenciais nescessarias para o USER/FUNCIONARIO logar na aplicação:
        $user = [
            'email_usuario'     => $request->email_usuario,
            'password'          => $request->senha_usuario,
            'status_usuario'    => 'Ativo'
        ];

        //dd($user);

        if (Auth::guard('admin')->attempt($user,  $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('admin.dash');
        }



        return back()->withInput()->with('error', 'E-mail ou senha invalido');
    }

    public function logout() {}
}
