<?php

namespace InfoTech\Controller;

use InfoTech\Model\Cliente;

class ClienteController extends Controller
{
    // ========== AÇÕES HTML ==========

    /**
     * Listar clientes (HTML)
     */
    public function index()
    {
        $model = new Cliente();
        $model->getAllRows();
        parent::render('/Cliente/listar_clientes.php', $model);
    }

    /**
     * Formulário de cadastro
     */
    public function cadastro()
    {
        $model = new Cliente();
        parent::render('/Cliente/cadastrar_cliente.php', $model);
    }

    /**
     * Salvar cliente (POST)
     * ✨ Automático: HTML ou AJAX detectado pelo Controller!
     */
    public function salvar()
    {
        $model = new Cliente();
        $model->nome = $_POST['nome'] ?? '';
        $model->email = $_POST['email'] ?? '';
        $model->telefone = $_POST['telefone'] ?? '';
        $model->status_cliente = $_POST['status_cliente'] ?? 'ativo';

        $resultado = $model->save();

        if ($resultado) {
            parent::respondOrRedirect(
                '/infotech/cliente/listar',
                ['id' => $modelo->id_cliente],
                'Cliente salvo com sucesso'
            );
        }
    }

    /**
     * Editar cliente (GET)
     */
    public function editar($id)
    {
        $cliente = Cliente::getById($id);
        parent::render('/Cliente/cadastrar_cliente.php', $cliente);
    }

    /**
     * Atualizar cliente (POST)
     */
    public function atualizar($id)
    {
        $model = Cliente::getById($id);
        $model->nome = $_POST['nome'] ?? '';
        $model->email = $_POST['email'] ?? '';
        $model->telefone = $_POST['telefone'] ?? '';

        $resultado = $model->save();

        if ($resultado) {
            parent::respondOrRedirect(
                '/infotech/cliente/listar',
                ['id' => $id],
                'Cliente atualizado com sucesso'
            );
        }
    }

    // ========== AÇÕES ESPECIAIS (AJAX + HTML) ==========

    /**
     * Deletar cliente
     * ✨ O Router passa o parâmetro automaticamente!
     * ✨ O método detecta se é AJAX ou HTML!
     */
    public function deletar($id)
    {
        try {
            $cliente = Cliente::getById($id);

            if (!$cliente) {
                if ($this->isAjax()) {
                    parent::respondJsonError(['Cliente não encontrado'], '', 404);
                } else {
                    parent::redirect('/infotech/cliente/listar');
                }
            }

            $model = new Cliente();
            $resultado = $model->delete($id);

            if ($resultado) {
                if ($this->isAjax()) {
                    // Retorna JSON para AJAX
                    parent::respondJson(
                        ['id' => $id, 'status' => 'deleted'],
                        200,
                        'Cliente deletado com sucesso'
                    );
                } else {
                    // Redireciona para HTML
                    parent::redirect('/infotech/cliente/listar');
                }
            }
        } catch (\Exception $e) {
            if ($this->isAjax()) {
                parent::respondJsonError([$e->getMessage()], '', 500);
            } else {
                parent::redirect('/infotech/cliente/listar');
            }
        }
    }

    /**
     * Retornar modal de confirmação (AJAX)
     */
    public function retornarModalConfirmacao($id)
    {
        $cliente = Cliente::getById($id);

        if (!$cliente) {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Cliente não encontrado']);
            exit;
        }

        header('Content-Type: text/html; charset=utf-8');
        include VIEW . '/Modals/confirmacao_delecao.php';
    }
}