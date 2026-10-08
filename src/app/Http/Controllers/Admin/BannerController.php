<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banner;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('ordem_banner')->get();

        return view('admin.banner.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_banner'         => 'required|string|max:30',
            'titulo_banner'       => 'required|string|max:80',
            'subtitulo_banner'    => 'nullable|string|max:120',
            'descricao_banner'    => 'nullable|string',
            'texto_botao_banner'  => 'nullable|string|max:30',
            'link_botao_banner'   => 'nullable|string|max:120',
            'ordem_banner'        => 'required|integer|min:0',
            'foto_banner'         => 'required|image|mimes:jpg,jpeg,png,webp|max:8192',
            'status_banner'       => 'required|in:ATIVO,INATIVO',
        ]);

        $fotoBanner = $request->file('foto_banner');
        $slugBanner = Str::slug($request->nome_banner);
        $nomeFoto = $slugBanner . '.' . $fotoBanner->getClientOriginalExtension();
        $fotoBanner->move(public_path('davilla/images/banner/'), $nomeFoto);
        $caminhoFoto = 'banner/' . $nomeFoto;

        Banner::create([
            'nome_banner'         => $slugBanner,
            'titulo_banner'       => $request->titulo_banner,
            'subtitulo_banner'    => $request->subtitulo_banner,
            'descricao_banner'    => $request->descricao_banner,
            'texto_botao_banner'  => $request->texto_botao_banner,
            'link_botao_banner'   => $request->link_botao_banner,
            'ordem_banner'        => $request->ordem_banner,
            'foto_banner'         => $caminhoFoto,
            'status_banner'       => $request->status_banner,
        ]);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner cadastrado com sucesso!');
    }

    // METODO DESATIVAR
    public function desativar($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update([
            'status_banner' => 'INATIVO',
        ]);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner desativado com sucesso');
    }

    // METODO ATIVAR
    public function ativar($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update([
            'status_banner' => 'ATIVO',
        ]);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner ativado com sucesso');
    }

    // METODO ATUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_banner'         => 'required|string|max:30',
            'titulo_banner'       => 'required|string|max:80',
            'subtitulo_banner'    => 'nullable|string|max:120',
            'descricao_banner'    => 'nullable|string',
            'texto_botao_banner'  => 'nullable|string|max:30',
            'link_botao_banner'   => 'nullable|string|max:120',
            'ordem_banner'        => 'required|integer|min:0',
            'foto_banner'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'status_banner'       => 'required|in:ATIVO,INATIVO',
        ]);

        $banner = Banner::findOrFail($id);

        $slugBanner = Str::slug($request->nome_banner);
        $caminhoFoto = $banner->foto_banner;

        // Troca a foto somente se uma nova for enviada
        if ($request->hasFile('foto_banner')) {
            $fotoBanner = $request->file('foto_banner');
            $nomeFoto = $slugBanner . '.' . $fotoBanner->getClientOriginalExtension();
            $fotoBanner->move(public_path('davilla/images/banner/'), $nomeFoto);
            $caminhoFoto = 'banner/' . $nomeFoto;
        }

        $banner->update([
            'nome_banner'         => $slugBanner,
            'titulo_banner'       => $request->titulo_banner,
            'subtitulo_banner'    => $request->subtitulo_banner,
            'descricao_banner'    => $request->descricao_banner,
            'texto_botao_banner'  => $request->texto_botao_banner,
            'link_botao_banner'   => $request->link_botao_banner,
            'ordem_banner'        => $request->ordem_banner,
            'foto_banner'         => $caminhoFoto,
            'status_banner'       => $request->status_banner,
        ]);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner atualizado com sucesso');
    }
}
