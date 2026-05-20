<!-- Modal  Nova Categoria-->
<div class="modal fade" id="modalNovaCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form method="POST" action="{{ route('admin.categoria.store') }}">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nome_categoria" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome_categoria" name="nome_categoria" aria-describedby="alerta-nome_categoria" Required>
                            <div id="alerta-nome_categoria" class="form-text">
                                Informe o nome da categoria
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descricao_categoria" class="form-label">Descrição</label>
                            <textarea class="form-control textarea-xzycode" id="descricao_categoria" rows="3" aria-describedby="alerta-descricao" name="descricao_categoria" Required></textarea>
                            <div id="alerta-descricao" class="form-text">
                                Descrição da categoria
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="ordem_categoria" class="form-label">Ordem</label>
                                    <input type="number" class="form-control" id="ordem_categoria" name="ordem_categoria" aria-describedby="alerta-ordem_categoria" Required>
                                    <div id="alerta-ordem_categoria" class="form-text">
                                        Informe a ordem da categoria
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="status_categoria" class="form-label">Status</label>
                                    <select class="form-select" aria-label="Selecione um status" aria-describedby="alerta-ordem_categoria" name="status_categoria" Required>
                                        <option selected>Selecione uma opção</option>
                                        <option value="ATIVO">ATIVO</option>
                                        <option value="INATIVO">INATIVO</option>
                                    </select>
                                    <div id="alerta-ordem_categoria" class="form-text">
                                        Informe o status da categoria
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer mb-3 btn-modal">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar Categoria</button>
                        </div>
                    </div>

                </form>



            </div>

        </div>
    </div>
</div>