// ---------- Elementos do formulário de cliente ----------
const selectCategoria  = document.getElementById('id_categoria');
const btnNovaCategoria = document.getElementById('btn_nova_categoria');

// ---------- Elementos do modal de categoria ----------
const modalCategoria       = document.getElementById('modal_categoria');
const formCategoria        = document.getElementById('form_categoria');
const erroCategoria        = document.getElementById('categoria_erro');
const btnCancelarCategoria = document.getElementById('btn_cancelar_categoria');
const btnSalvarCategoria   = document.getElementById('btn_salvar_categoria');

// Busca as categorias na rota /categoria/listar (que chama o getAllRows)
// e monta as opções do select. idSelecionado = categoria que deve ficar marcada.
async function carregarCategorias(idSelecionado = '') {
    try {
        const response = await fetch('/infotech/categoria/listar');
        const result = await response.json();

        if (result.status !== 200) {
            throw new Error(result.mensagem);
        }

        selectCategoria.innerHTML = ''; // limpa as opções antigas

        const placeholder = new Option(
            result.categorias.length > 0
                ? 'Selecione a categoria'
                : 'Nenhuma categoria cadastrada. Use + Categoria',
            ''
        );
        placeholder.disabled = true;
        selectCategoria.add(placeholder);

        result.categorias.forEach(categoria => {
            // new Option(texto, valor) evita montar HTML na mão
            selectCategoria.add(new Option(categoria.nome, categoria.id_categoria));
        });

        selectCategoria.value = idSelecionado;

        // se o id não existe no select, volta para o placeholder
        if (selectCategoria.selectedIndex === -1) {
            placeholder.selected = true;
        }
    } catch (error) {
        selectCategoria.innerHTML = '<option value="" disabled selected>Erro ao carregar categorias</option>';
        console.error(error);
    }
}

function mostrarErroCategoria(mensagem) {
    erroCategoria.textContent = mensagem;
    erroCategoria.hidden = false;
}

// Abre o modal limpo
btnNovaCategoria.addEventListener('click', () => {
    formCategoria.reset();
    erroCategoria.hidden = true;
    modalCategoria.showModal();
});

btnCancelarCategoria.addEventListener('click', () => {
    modalCategoria.close();
});

// Cadastra a categoria e atualiza o select
formCategoria.addEventListener('submit', async (event) => {
    event.preventDefault();
    erroCategoria.hidden = true;
    btnSalvarCategoria.disabled = true; // evita clique duplo

    try {
        // 1) POST na rota de cadastro de categoria
        const response = await fetch(formCategoria.action, {
            method: 'POST',
            body: new FormData(formCategoria)
        });
        const result = await response.json();

        if (result.status !== 200) {
            mostrarErroCategoria(result.mensagem);
            return;
        }

        // 2) recarrega o select (getAllRows) já marcando a categoria recém-criada
        await carregarCategorias(result.id_categoria);
        modalCategoria.close();
    } catch (error) {
        mostrarErroCategoria('Não foi possível falar com o servidor. Tente novamente.');
        console.error(error);
    } finally {
        btnSalvarCategoria.disabled = false;
    }
});

// Ao abrir a página: carrega as categorias (na edição, marca a do cliente)
carregarCategorias(selectCategoria.dataset.selecionado);
