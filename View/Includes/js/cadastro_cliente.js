// Os nomes das constantes são diferentes dos do categoria.js de propósito:
// scripts comuns compartilham o escopo global, e dois "const modal" dariam erro.
const formCliente  = document.getElementById('form_cliente');
// const modalCliente = document.getElementById('modal_cliente');

formCliente.addEventListener('submit', async (event) => {
    event.preventDefault(); // impede o envio normal (que recarregaria a página)

    try {
        const response = await fetch('/infotech/cliente/cadastro', {
            method: 'POST',
            body: new FormData(formCliente) // já inclui o id_categoria do select
        });
        const result = await response.json();

        if (result.status === 200) {
            alert("Cadastrado com sucesso!!");
            // modalCliente.showModal();
        } else {
            alert(result.mensagem);
        }
    } catch (error) {
        alert('Não foi possível falar com o servidor. Tente novamente.');
        console.error(error);
    }
});

// Ao clicar OK no modal de sucesso, volta para a listagem
modalCliente.addEventListener('close', () => {
    window.location.href = '/infotech/cliente/listar';
});
