<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Redirect;

class CategoriaController extends Controller
{
    public function index()
    {

        $categorias = Categoria::orderBy('nome_categoria')
            //->where('status_categoria', 'ATIVO')
            ->get();

        //dd($categorias);
        return view('admin.categoria.index', compact('categorias'));
    }

    // METODO CRIAR
    public function store(Request $request)
    {

        //dd($request);

        $request->validate([
            'nome_categoria'        => 'required|string|max:30',
            'descricao_categoria'   => 'required|string',
            'status_categoria'      => 'required|in:ATIVO,INATIVO',
        ]);

        Categoria::create([
            'nome_categoria'        => $request->nome_categoria,
            'descricao_categoria'   => $request->descricao_categoria,
            'status_categoria'      => $request->status_categoria,
        ]);

        return redirect()
            ->route('admin.categoria.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }

    // METODO DESATIVAR
    public function desativar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->status_categoria = 'INATIVO';
        $categoria->update([
            'status_categoria' => 'INATIVO',
        ]);

        return redirect()
            ->route('admin.categoria.index')
            ->with('success', 'Categoria desativada com sucesso');
    }

    // METODO ATIVAR
    public function ativar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->status_categoria = 'ATIVO';
        $categoria->update([
            'status_categoria' => 'ATIVO',
        ]);

        return redirect()
            ->route('admin.categoria.index')
            ->with('success', 'Categoria ativada com sucesso');
    }

    // METODO ATUALIZAR
    public function update(Request $request, $id)
    {

        $request->validate([
            'nome_categoria'        => 'required|string|max:30',
            'descricao_categoria'   => 'required|string',
            'status_categoria'      => 'required|in:ATIVO,INATIVO',
        ]);

        $categoria = Categoria::findOrFail($id);

        $categoria->update([
            'nome_categoria'        => $request->nome_categoria,
            'descricao_categoria'   => $request->descricao_categoria,
            'status_categoria'      => $request->status_categoria,
        ]);

        return redirect()
            ->route('admin.categoria.index')
            ->with('success', 'Categoria atualizada com sucesso');
    }
}
