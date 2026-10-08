<!-- Modal Editar Banner -->
<div class="modal fade" id="modalEditarBanner{{ $banner->id_banner }}" tabindex="-1" aria-labelledby="modalEditarBannerLabel{{ $banner->id_banner }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarBannerLabel{{ $banner->id_banner }}">Editar Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.banner.update', $banner->id_banner) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="foto_banner{{ $banner->id_banner }}" class="form-label">Foto</label>
                                    <label for="foto_banner{{ $banner->id_banner }}" class="d-block cursor-pointer">
                                        <img
                                            src="{{ asset('davilla/images/' . $banner->foto_banner) }}"
                                            class="img-thumbnail w-100"
                                            id="preview_foto_banner{{ $banner->id_banner }}"
                                            alt="{{ $banner->titulo_banner }}"
                                            style="height: 230px; object-fit: cover; cursor: pointer;">
                                    </label>
                                    <input type="file" class="form-control d-none" id="foto_banner{{ $banner->id_banner }}" name="foto_banner" aria-describedby="alerta-foto_banner{{ $banner->id_banner }}" accept="image/png,image/jpeg,image/webp">
                                    <div id="alerta-foto_banner{{ $banner->id_banner }}" class="form-text">
                                        Clique na imagem para trocar a foto (opcional)
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">

                                    <label for="nome_banner{{ $banner->id_banner }}" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome_banner{{ $banner->id_banner }}" name="nome_banner" maxlength="30" aria-describedby="alerta-nome_banner{{ $banner->id_banner }}" required value="{{ $banner->nome_banner }}">
                                    <div id="alerta-nome_banner{{ $banner->id_banner }}" class="form-text">
                                        Nome interno do banner (ex.: home-vitrine)
                                    </div>

                                    <label for="titulo_banner{{ $banner->id_banner }}" class="form-label">Título</label>
                                    <input type="text" class="form-control" id="titulo_banner{{ $banner->id_banner }}" name="titulo_banner" maxlength="80" aria-describedby="alerta-titulo_banner{{ $banner->id_banner }}" required value="{{ $banner->titulo_banner }}">
                                    <div id="alerta-titulo_banner{{ $banner->id_banner }}" class="form-text">
                                        Informe o título do banner
                                    </div>

                                    <label for="subtitulo_banner{{ $banner->id_banner }}" class="form-label">Subtítulo</label>
                                    <input type="text" class="form-control" id="subtitulo_banner{{ $banner->id_banner }}" name="subtitulo_banner" maxlength="120" aria-describedby="alerta-subtitulo_banner{{ $banner->id_banner }}" value="{{ $banner->subtitulo_banner }}">
                                    <div id="alerta-subtitulo_banner{{ $banner->id_banner }}" class="form-text">
                                        Informe o subtítulo (opcional)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descricao_banner{{ $banner->id_banner }}" class="form-label">Descricao</label>
                            <textarea class="form-control textarea-xzycode" id="descricao_banner{{ $banner->id_banner }}" rows="3" aria-describedby="alerta-descricao_banner{{ $banner->id_banner }}" name="descricao_banner">{{ $banner->descricao_banner }}</textarea>
                            <div id="alerta-descricao_banner{{ $banner->id_banner }}" class="form-text">
                                Descricao do banner (opcional)
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="texto_botao_banner{{ $banner->id_banner }}" class="form-label">Texto do botão</label>
                                <input type="text" class="form-control" id="texto_botao_banner{{ $banner->id_banner }}" name="texto_botao_banner" maxlength="30" aria-describedby="alerta-texto_botao_banner{{ $banner->id_banner }}" value="{{ $banner->texto_botao_banner }}">
                                <div id="alerta-texto_botao_banner{{ $banner->id_banner }}" class="form-text">
                                    Ex.: Ver cardápio
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="link_botao_banner{{ $banner->id_banner }}" class="form-label">Link do botão</label>
                                <input type="text" class="form-control" id="link_botao_banner{{ $banner->id_banner }}" name="link_botao_banner" maxlength="120" aria-describedby="alerta-link_botao_banner{{ $banner->id_banner }}" value="{{ $banner->link_botao_banner }}">
                                <div id="alerta-link_botao_banner{{ $banner->id_banner }}" class="form-text">
                                    Ex.: /cardapio
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ordem_banner{{ $banner->id_banner }}" class="form-label">Ordem</label>
                                <input type="number" min="0" class="form-control" id="ordem_banner{{ $banner->id_banner }}" name="ordem_banner" aria-describedby="alerta-ordem_banner{{ $banner->id_banner }}" required value="{{ $banner->ordem_banner }}">
                                <div id="alerta-ordem_banner{{ $banner->id_banner }}" class="form-text">
                                    Posição de exibição
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="status_banner{{ $banner->id_banner }}" class="form-label">Status</label>
                                <select class="form-select" id="status_banner{{ $banner->id_banner }}" name="status_banner" aria-describedby="alerta-status_banner{{ $banner->id_banner }}" required>
                                    <option value="ATIVO" @selected($banner->status_banner === 'ATIVO')>ATIVO</option>
                                    <option value="INATIVO" @selected($banner->status_banner === 'INATIVO')>INATIVO</option>
                                </select>
                                <div id="alerta-status_banner{{ $banner->id_banner }}" class="form-text">
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
        const modalEditarBanner = document.getElementById('modalEditarBanner{{ $banner->id_banner }}');
        const inputFotoBanner = document.getElementById('foto_banner{{ $banner->id_banner }}');
        const previewFotoBanner = document.getElementById('preview_foto_banner{{ $banner->id_banner }}');
        const fotoAtualBanner = previewFotoBanner.src;

        inputFotoBanner.addEventListener('change', function() {
            const arquivo = this.files[0];

            if (!arquivo) {
                previewFotoBanner.src = fotoAtualBanner;
                return;
            }

            previewFotoBanner.src = URL.createObjectURL(arquivo);
        });

        modalEditarBanner.addEventListener('hidden.bs.modal', function() {
            inputFotoBanner.form.reset();
            previewFotoBanner.src = fotoAtualBanner;
        });
    });
</script>
@endpush
