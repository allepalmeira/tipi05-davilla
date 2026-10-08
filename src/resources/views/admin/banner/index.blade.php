@extends('layout.admin')

@section('title', 'Banner | Confeitaria Dashboard')

@section('pg-titulo', 'Banner')

@section('link-topo', 'Banner')

@section('content')

<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">

            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <strong>Atenção!</strong> verifique os campos do formulário.
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gerenciamento de Banners</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalNovoBanner">
                            <i class="bi bi-plus-circle"></i>
                            Novo Banner
                        </button>
                    </div>
                </div>
                <!-- /.card-header

                Columns:
                    id_banner
                    nome_banner
                    titulo_banner
                    subtitulo_banner
                    descricao_banner
                    texto_botao_banner
                    link_botao_banner
                    ordem_banner
                    foto_banner
                    status_banner

                -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 200px;">Foto</th>
                                <th>Título e Subtítulo</th>
                                <th>Botão</th>
                                <th>Ordem</th>
                                <th>Status</th>
                                <th style="width: 200px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($banners as $linha)
                            <tr class="align-middle">
                                <td>
                                    <a href="{{ asset('davilla/images/' . $linha->foto_banner) }}"
                                        data-lightbox="galeria"
                                        data-title="{{ $linha->titulo_banner }}">

                                        <img src="{{ asset('davilla/images/' . $linha->foto_banner) }}"
                                            class="img-thumbnail"
                                            alt="{{ $linha->titulo_banner }}">
                                    </a>
                                </td>
                                <td>
                                    <div class="tblProduto">
                                        <div class="tituloProduto">
                                            {{ $linha->titulo_banner }}
                                        </div>
                                        <div class="descProduto">
                                            {{ $linha->subtitulo_banner }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($linha->texto_botao_banner)
                                    {{ $linha->texto_botao_banner }}
                                    <br><small class="text-secondary">{{ $linha->link_botao_banner }}</small>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>{{ $linha->ordem_banner }}</td>
                                <td>
                                    @if($linha->status_banner === 'ATIVO')
                                    <span class="badge text-bg-success">Ativo</span>
                                    @else
                                    <span class="badge text-bg-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- EDITAR -->
                                    <button type="button"
                                        class="btn btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditarBanner{{ $linha->id_banner }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- DESATIVAR ou ATIVAR -->
                                    @if($linha->status_banner === 'ATIVO')
                                    <form action="{{ route('admin.banner.desativar', $linha->id_banner) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('admin.banner.ativar', $linha->id_banner) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </form>
                                    @endif

                                </td>
                            </tr>

                            @include('admin.banner.modal.editar', ['banner' => $linha])
                            @empty
                            <tr>
                                <td>Nenhum banner cadastrado</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>


        </div>
    </div>
</div>


@include('admin.banner.modal.criar')

@endsection
