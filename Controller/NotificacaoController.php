<?php

namespace InfoTech\Controller;

use InfoTech\Model\Notificacao;

// Esta CLASSE só responde em JSON (usada pelo notificacao.js)

class NotificacaoController extends Controller
{
    // Retorna o id do funcionário logado ou encerra com 401
    private static function idFuncionarioLogado(): int
    {
        $id = $_SESSION['usuario_logado']->id_funcionario ?? null;

        if (!$id) {
            parent::jsonResponse(['status' => 401, 'msg' => 'Usuário não autenticado']);
        }

        return (int) $id;
    }

    public static function listar()
    {
        $id_funcionario = self::idFuncionarioLogado();

        try {
            $model = new Notificacao();
            $model->id_funcionario = $id_funcionario;
            $model->getRecentes(10);

            $notificacoes = array_map(fn($categoria) => [
                'id_categoria'  => (int) $categoria['id_categoria'],
                'nome'          => $categoria['nome'],
                'data_cadastro' => $categoria['data_cadastro'],
                'nova'          => (int) $categoria['id_categoria'] > $model->ultima_vista,
            ], $model->rows);

            $result = [
                'status'    => 200,
                'nao_lidas' => $model->nao_lidas,
                'data'      => $notificacoes,
            ];
        } catch (\Throwable $e) {
            $result = ['status' => 400, 'msg' => 'Erro ao consultar as notificações'];
        }

        parent::jsonResponse($result);
    }

    public static function marcarLidas()
    {
        $id_funcionario = self::idFuncionarioLogado();
        $id_categoria   = (int) ($_POST['id_categoria'] ?? 0);

        try {
            $model = new Notificacao();
            $model->id_funcionario = $id_funcionario;
            $model->marcarComoLidas($id_categoria);

            $result = ['status' => 200, 'msg' => 'Notificações marcadas como lidas'];
        } catch (\Throwable $e) {
            $result = ['status' => 400, 'msg' => 'Erro ao atualizar as notificações'];
        }

        parent::jsonResponse($result);
    }
}
