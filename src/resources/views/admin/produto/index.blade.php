@extends('layout.admin')

@section('title', 'Produto | Confeitaria Dashboard')

@section('pg-titulo', 'Produto')

@section('link-topo', 'Produto')

@section('content')

<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gerenciamento de Produtos</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalNovoProduto">
                            <i class="bi bi-plus-circle"></i>
                            Novo Produto
                        </button>
                    </div>
                </div>
                <!-- /.card-header 
                 
                Columns:
                    id_produto 
                    nome_produto  
                    slug_produto 
                    id_categoria 
                    descricao_produto 
                    tamanho_produto
                    unid_med_produto
                    valor_produto 
                    foto_produto  
                    status_produto  
                    destaque_produto 
                    ordem_produto 
                
                -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 150px;">Foto</th>
                                <th>Nome e Descrição</th>
                                <th>Tamanho</th>
                                <th>Unid. Medida</th>
                                <th>Valor</th>
                                <th>Destaque</th>
                                <th>Status</th>
                                <th style="width: 200px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produtos as $linha)
                            <tr class="align-middle">
                                <td>
                                    <a href="{{ asset('davilla/images/'. $linha->foto_produto) }}"data-lightbox="galeria">
                                        <img src="{{ asset('davilla/images/'. $linha->foto_produto) }}" class="img-thumbnail" alt=" {{ $linha->nome_produto }}" data-lightbox="roadtrip">
                                    </a>
                                </td>
                                <td>
                                    <div class="tblProduto">
                                        <div class="tituloProduto">
                                            {{ $linha->nome_produto }}
                                        </div>
                                        <div class="descProduto">
                                            {{ $linha->descricao_produto }}
                                        </div>
                                    </div>

                                </td>
                                <td>{{ $linha->tamanho_produto }}</td>
                                <td>{{ $linha->unid_med_produto }}</td>
                                <td>{{ $linha->valor_produto }}</td>
                                <td>{{ $linha->destaque_produto }}</td>
                                <td>
                                    @if($linha->status_produto === 'ATIVO')
                                    <span class="badge text-bg-success">Ativo</span>
                                    @else
                                    <span class="badge text-bg-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditarproduto{{ $linha->id_produto }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger">
                                        <i class="bi bi-trash3"></i>
                                    </button>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>Nenhuma produto cadastrada</td>
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


@include('admin.produto.modal.criar')

@endsection