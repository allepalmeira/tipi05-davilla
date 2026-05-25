<!-- Modal Novo Produto -->
<div class="modal fade" id="modalNovoProduto" tabindex="-1" aria-labelledby="modalNovoProdutoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoProdutoLabel">Cadastro de Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.produto.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome_produto" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome_produto" name="nome_produto" aria-describedby="alerta-nome_produto" required>
                                <div id="alerta-nome_produto" class="form-text">
                                    Informe o nome do produto
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="id_categoria" class="form-label">Categoria</label>
                                <select class="form-select" id="id_categoria" name="id_categoria" aria-describedby="alerta-id_categoria" required>
                                    <option value="" selected>Selecione uma categoria</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id_categoria }}">{{ $categoria->nome_categoria }}</option>
                                    @endforeach
                                </select>
                                <div id="alerta-id_categoria" class="form-text">
                                    Informe a categoria do produto
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="foto_produto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto_produto" name="foto_produto" aria-describedby="alerta-foto_produto" accept="image/png,image/jpeg,image/webp" required>
                                <div id="alerta-foto_produto" class="form-text">
                                    Selecione a foto do produto
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descricao_produto" class="form-label">Descricao</label>
                            <textarea class="form-control textarea-xzycode" id="descricao_produto" rows="3" aria-describedby="alerta-descricao_produto" name="descricao_produto" required></textarea>
                            <div id="alerta-descricao_produto" class="form-text">
                                Descricao do produto
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="tamanho_produto" class="form-label">Tamanho</label>
                                <input type="text" class="form-control" id="tamanho_produto" name="tamanho_produto" aria-describedby="alerta-tamanho_produto" required>
                                <div id="alerta-tamanho_produto" class="form-text">
                                    Informe o tamanho
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="unid_med_produto" class="form-label">Unidade de medida</label>
                                <input type="text" class="form-control" id="unid_med_produto" name="unid_med_produto" aria-describedby="alerta-unid_med_produto" required>
                                <div id="alerta-unid_med_produto" class="form-text">
                                    Informe a unidade
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="valor_produto" class="form-label">Valor</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="valor_produto" name="valor_produto" aria-describedby="alerta-valor_produto" required>
                                <div id="alerta-valor_produto" class="form-text">
                                    Informe o valor
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="ordem_produto" class="form-label">Ordem</label>
                                <input type="number" class="form-control" id="ordem_produto" name="ordem_produto" aria-describedby="alerta-ordem_produto" required>
                                <div id="alerta-ordem_produto" class="form-text">
                                    Informe a ordem do produto
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="status_produto" class="form-label">Status</label>
                                <select class="form-select" id="status_produto" name="status_produto" aria-describedby="alerta-status_produto" required>
                                    <option value="" selected>Selecione uma opcao</option>
                                    <option value="ATIVO">ATIVO</option>
                                    <option value="INATIVO">INATIVO</option>
                                </select>
                                <div id="alerta-status_produto" class="form-text">
                                    Informe o status do produto
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="destaque_produto" class="form-label">Destaque</label>
                                <select class="form-select" id="destaque_produto" name="destaque_produto" aria-describedby="alerta-destaque_produto" required>
                                    <option value="" selected>Selecione uma opcao</option>
                                    <option value="SIM">SIM</option>
                                    <option value="NAO">NAO</option>
                                </select>
                                <div id="alerta-destaque_produto" class="form-text">
                                    Informe se o produto e destaque
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer mb-3 btn-modal">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar Produto</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
