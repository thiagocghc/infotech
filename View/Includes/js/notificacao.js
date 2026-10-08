// Elementos do sino de notificações (navbar.php)
const btnNotificacoes   = document.getElementById('btn_notificacoes');
const badgeNotificacao  = document.getElementById('notificacao_badge');
const listaNotificacao  = document.getElementById('notificacao_lista');

let ultimaCategoriaRecebida = 0; // maior id que veio do servidor
let totalNaoLidas = 0;

// "2026-10-06 14:30:00" -> "06/10 14:30"
function formatarDataNotificacao(dataSql) {
    if (!dataSql) return '';
    const data = new Date(dataSql.replace(' ', 'T'));
    return data.toLocaleString('pt-BR', {
        day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit'
    });
}

function atualizarBadge(quantidade) {
    totalNaoLidas = quantidade;
    badgeNotificacao.textContent = quantidade > 9 ? '9+' : quantidade;
    badgeNotificacao.hidden = quantidade === 0;
}

// Monta a lista usando createElement/textContent (evita XSS com o nome da categoria)
function renderizarNotificacoes(notificacoes) {
    listaNotificacao.innerHTML = '';

    if (notificacoes.length === 0) {
        const vazio = document.createElement('li');
        vazio.className = 'list-group-item text-muted small text-center py-3';
        vazio.textContent = 'Nenhuma notificação';
        listaNotificacao.appendChild(vazio);
        return;
    }

    notificacoes.forEach(notificacao => {
        const item = document.createElement('li');
        item.className = 'list-group-item d-flex align-items-start gap-2';
        if (notificacao.nova) item.classList.add('list-group-item-primary', 'notificacao-nova');

        const icone = document.createElement('i');
        icone.className = notificacao.nova ? 'bi bi-bell-fill text-primary' : 'bi bi-tag text-secondary';

        const conteudo = document.createElement('div');
        conteudo.className = 'flex-grow-1';

        const titulo = document.createElement('div');
        titulo.className = 'small fw-semibold';
        titulo.textContent = 'Nova categoria cadastrada';

        const nome = document.createElement('div');
        nome.textContent = notificacao.nome;

        const data = document.createElement('small');
        data.className = 'text-muted';
        data.textContent = formatarDataNotificacao(notificacao.data_cadastro);

        conteudo.append(titulo, nome, data);
        item.append(icone, conteudo);
        listaNotificacao.appendChild(item);
    });
}

// Busca as notificações ao carregar a página
async function carregarNotificacoes() {
    try {
        const response = await fetch('/infotech/notificacao/listar');
        const result = await response.json();

        if (result.status !== 200) return;

        ultimaCategoriaRecebida = result.data.length > 0 ? result.data[0].id_categoria : 0;
        renderizarNotificacoes(result.data);
        atualizarBadge(result.nao_lidas);
    } catch (error) {
        console.error('Erro ao carregar notificações', error);
    }
}

// Ao abrir o sino, avisa o servidor que o usuário viu até a última categoria
async function marcarNotificacoesComoLidas() {
    if (totalNaoLidas === 0) return;

    const formulario = new FormData();
    formulario.append('id_categoria', ultimaCategoriaRecebida);

    try {
        await fetch('/infotech/notificacao/marcar-lidas', { method: 'POST', body: formulario });
        atualizarBadge(0);
    } catch (error) {
        console.error('Erro ao marcar notificações como lidas', error);
    }
}

// Ao fechar o sino, tira o destaque das que acabaram de ser lidas
function removerDestaqueNotificacoes() {
    listaNotificacao.querySelectorAll('.notificacao-nova').forEach(item => {
        item.classList.remove('list-group-item-primary', 'notificacao-nova');
        const icone = item.querySelector('i');
        icone.className = 'bi bi-tag text-secondary';
    });
}

// Eventos do dropdown do Bootstrap 5
btnNotificacoes.addEventListener('show.bs.dropdown', marcarNotificacoesComoLidas);
btnNotificacoes.addEventListener('hidden.bs.dropdown', removerDestaqueNotificacoes);

carregarNotificacoes();
