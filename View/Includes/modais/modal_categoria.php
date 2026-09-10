<!-- Modal de cadastro de categoria (aberto pelo botão "+ Categoria") -->
<dialog id="modal_categoria" class="modal-app">
    <form id="form_categoria" action="/infotech/categoria/cadastro">
        <h5 class="mb-3">Nova categoria</h5>

        <div class="mb-3">
            <label for="categoria_nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="categoria_nome" name="nome"
                   maxlength="50" placeholder="Ex.: Premium" required>
        </div>

        <div class="mb-3">
            <label for="categoria_descricao" class="form-label">Descrição (opcional)</label>
            <input type="text" class="form-control" id="categoria_descricao" name="descricao" maxlength="255">
        </div>

        <p id="categoria_erro" class="text-danger small" hidden></p>

        <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-outline-secondary" id="btn_cancelar_categoria">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="btn_salvar_categoria">Salvar categoria</button>
        </div>
    </form>
</dialog>
