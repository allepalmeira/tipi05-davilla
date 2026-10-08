<!-- Modal Editar Produto -->
<div class="modal fade" id="modalEditarProduto{{ $produto->id_produto }}" tabindex="-1" aria-labelledby="modalEditarProdutoLabel{{ $produto->id_produto }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarProdutoLabel{{ $produto->id_produto }}">Editar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.produto.update', $produto->id_produto) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="foto_produto{{ $produto->id_produto }}" class="form-label">Foto</label>
                                    <label for="foto_produto{{ $produto->id_produto }}" class="d-block cursor-pointer">
                                        <img
                                            src="{{ asset('davilla/images/' . $produto->foto_produto) }}"
                                            class="img-thumbnail w-100"
                                            id="preview_foto_produto{{ $produto->id_produto }}"
                                            alt="{{ $produto->nome_produto }}"
                                            style="height: 230px; object-fit: cover; cursor: pointer;">
                                    </label>
                                    <input type="file" class="form-control d-none" id="foto_produto{{ $produto->id_produto }}" name="foto_produto" aria-describedby="alerta-foto_produto{{ $produto->id_produto }}" accept="image/png,image/jpeg,image/webp">
                                    <div id="alerta-foto_produto{{ $produto->id_produto }}" class="form-text">
                                        Clique na imagem para trocar a foto (opcional)
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">

                                    <label for="nome_produto{{ $produto->id_produto }}" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome_produto{{ $produto->id_produto }}" name="nome_produto" aria-describedby="alerta-nome_produto{{ $produto->id_produto }}" required value="{{ $produto->nome_produto }}">
                                    <div id="alerta-nome_produto{{ $produto->id_produto }}" class="form-text">
                                        Informe o nome do produto
                                    </div>

                                    <label for="id_categoria{{ $produto->id_produto }}" class="form-label">Categoria</label>
                                    <select class="form-select" id="id_categoria{{ $produto->id_produto }}" name="id_categoria" aria-describedby="alerta-id_categoria{{ $produto->id_produto }}" required>
                                        <option value="">Selecione uma categoria</option>
                                        @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id_categoria }}" @selected($categoria->id_categoria == $produto->id_categoria)>{{ $categoria->nome_categoria }}</option>
                                        @endforeach
                                    </select>
                                    <div id="alerta-id_categoria{{ $produto->id_produto }}" class="form-text">
                                        Informe a categoria do produto
                                    </div>

                                    <label for="valor_produto{{ $produto->id_produto }}" class="form-label">Valor</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="valor_produto{{ $produto->id_produto }}" name="valor_produto" aria-describedby="alerta-valor_produto{{ $produto->id_produto }}" required value="{{ $produto->valor_produto }}">
                                    <div id="alerta-valor_produto{{ $produto->id_produto }}" class="form-text">
                                        Informe o valor
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descricao_produto{{ $produto->id_produto }}" class="form-label">Descricao</label>
                            <textarea class="form-control textarea-xzycode" id="descricao_produto{{ $produto->id_produto }}" rows="3" aria-describedby="alerta-descricao_produto{{ $produto->id_produto }}" name="descricao_produto" required>{{ $produto->descricao_produto }}</textarea>
                            <div id="alerta-descricao_produto{{ $produto->id_produto }}" class="form-text">
                                Descricao do produto
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="tamanho_produto{{ $produto->id_produto }}" class="form-label">Tamanho</label>
                                <input type="text" class="form-control" id="tamanho_produto{{ $produto->id_produto }}" name="tamanho_produto" aria-describedby="alerta-tamanho_produto{{ $produto->id_produto }}" required value="{{ $produto->tamanho_produto }}">
                                <div id="alerta-tamanho_produto{{ $produto->id_produto }}" class="form-text">
                                    Informe o tamanho
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="unid_med_produto{{ $produto->id_produto }}" class="form-label">Unidade de medida</label>
                                <input type="text" class="form-control" id="unid_med_produto{{ $produto->id_produto }}" name="unid_med_produto" aria-describedby="alerta-unid_med_produto{{ $produto->id_produto }}" required value="{{ $produto->unid_med_produto }}">
                                <div id="alerta-unid_med_produto{{ $produto->id_produto }}" class="form-text">
                                    Informe a unidade
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="status_produto{{ $produto->id_produto }}" class="form-label">Status</label>
                                <select class="form-select" id="status_produto{{ $produto->id_produto }}" name="status_produto" aria-describedby="alerta-status_produto{{ $produto->id_produto }}" required>
                                    <option value="ATIVO" @selected($produto->status_produto === 'ATIVO')>ATIVO</option>
                                    <option value="INATIVO" @selected($produto->status_produto === 'INATIVO')>INATIVO</option>
                                </select>
                                <div id="alerta-status_produto{{ $produto->id_produto }}" class="form-text">
                                    Informe o status do produto
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="destaque_produto{{ $produto->id_produto }}" class="form-label">Destaque</label>
                                <select class="form-select" id="destaque_produto{{ $produto->id_produto }}" name="destaque_produto" aria-describedby="alerta-destaque_produto{{ $produto->id_produto }}" required>
                                    <option value="SIM" @selected($produto->destaque_produto === 'SIM')>SIM</option>
                                    <option value="NAO" @selected($produto->destaque_produto === 'NAO')>NAO</option>
                                </select>
                                <div id="alerta-destaque_produto{{ $produto->id_produto }}" class="form-text">
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEditarProduto = document.getElementById('modalEditarProduto{{ $produto->id_produto }}');
        const inputFotoProduto = document.getElementById('foto_produto{{ $produto->id_produto }}');
        const previewFotoProduto = document.getElementById('preview_foto_produto{{ $produto->id_produto }}');
        const fotoAtualProduto = previewFotoProduto.src;

        inputFotoProduto.addEventListener('change', function() {
            const arquivo = this.files[0];

            if (!arquivo) {
                previewFotoProduto.src = fotoAtualProduto;
                return;
            }

            previewFotoProduto.src = URL.createObjectURL(arquivo);
        });

        modalEditarProduto.addEventListener('hidden.bs.modal', function() {
            inputFotoProduto.form.reset();
            previewFotoProduto.src = fotoAtualProduto;
        });
    });
</script>
@endpush
