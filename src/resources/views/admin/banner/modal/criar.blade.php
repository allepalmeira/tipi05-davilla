<!-- Modal Novo Banner -->
<div class="modal fade" id="modalNovoBanner" tabindex="-1" aria-labelledby="modalNovoBannerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoBannerLabel">Cadastro de Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row">

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="foto_banner" class="form-label">Foto</label>
                                    <label for="foto_banner" class="d-block cursor-pointer">
                                        <img
                                            src="{{ asset('davilla/images/sem-foto.png') }}"
                                            class="img-thumbnail w-100"
                                            id="preview_foto_banner"
                                            alt="Selecione a foto do banner"
                                            style="height: 230px; object-fit: cover; cursor: pointer;">
                                    </label>
                                    <input type="file" class="form-control d-none" id="foto_banner" name="foto_banner" aria-describedby="alerta-foto_banner" accept="image/png,image/jpeg,image/webp" required>
                                    <div id="alerta-foto_banner" class="form-text">
                                        Clique na imagem para selecionar a foto do banner
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">

                                    <label for="nome_banner" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome_banner" name="nome_banner" maxlength="30" aria-describedby="alerta-nome_banner" required>
                                    <div id="alerta-nome_banner" class="form-text">
                                        Nome interno do banner (ex.: home-vitrine)
                                    </div>

                                    <label for="titulo_banner" class="form-label">Título</label>
                                    <input type="text" class="form-control" id="titulo_banner" name="titulo_banner" maxlength="80" aria-describedby="alerta-titulo_banner" required>
                                    <div id="alerta-titulo_banner" class="form-text">
                                        Informe o título do banner
                                    </div>

                                    <label for="subtitulo_banner" class="form-label">Subtítulo</label>
                                    <input type="text" class="form-control" id="subtitulo_banner" name="subtitulo_banner" maxlength="120" aria-describedby="alerta-subtitulo_banner">
                                    <div id="alerta-subtitulo_banner" class="form-text">
                                        Informe o subtítulo (opcional)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descricao_banner" class="form-label">Descricao</label>
                            <textarea class="form-control textarea-xzycode" id="descricao_banner" rows="3" aria-describedby="alerta-descricao_banner" name="descricao_banner"></textarea>
                            <div id="alerta-descricao_banner" class="form-text">
                                Descricao do banner (opcional)
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="texto_botao_banner" class="form-label">Texto do botão</label>
                                <input type="text" class="form-control" id="texto_botao_banner" name="texto_botao_banner" maxlength="30" aria-describedby="alerta-texto_botao_banner">
                                <div id="alerta-texto_botao_banner" class="form-text">
                                    Ex.: Ver cardápio
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="link_botao_banner" class="form-label">Link do botão</label>
                                <input type="text" class="form-control" id="link_botao_banner" name="link_botao_banner" maxlength="120" aria-describedby="alerta-link_botao_banner">
                                <div id="alerta-link_botao_banner" class="form-text">
                                    Ex.: /cardapio
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ordem_banner" class="form-label">Ordem</label>
                                <input type="number" min="0" class="form-control" id="ordem_banner" name="ordem_banner" aria-describedby="alerta-ordem_banner" value="0" required>
                                <div id="alerta-ordem_banner" class="form-text">
                                    Posição de exibição
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="status_banner" class="form-label">Status</label>
                                <select class="form-select" id="status_banner" name="status_banner" aria-describedby="alerta-status_banner" required>
                                    <option value="" selected>Selecione uma opcao</option>
                                    <option value="ATIVO">ATIVO</option>
                                    <option value="INATIVO">INATIVO</option>
                                </select>
                                <div id="alerta-status_banner" class="form-text">
                                    Informe o status do banner
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer mb-3 btn-modal">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar Banner</button>
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
        const modalNovoBanner = document.getElementById('modalNovoBanner');
        const inputFotoBanner = document.getElementById('foto_banner');
        const previewFotoBanner = document.getElementById('preview_foto_banner');
        const fotoPadraoBanner = previewFotoBanner.src;

        inputFotoBanner.addEventListener('change', function() {
            const arquivo = this.files[0];

            if (!arquivo) {
                previewFotoBanner.src = fotoPadraoBanner;
                return;
            }

            previewFotoBanner.src = URL.createObjectURL(arquivo);
        });

        modalNovoBanner.addEventListener('hidden.bs.modal', function() {
            inputFotoBanner.form.reset();
            previewFotoBanner.src = fotoPadraoBanner;
        });
    });
</script>
@endpush
