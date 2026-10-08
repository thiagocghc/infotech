<?php

namespace InfoTech\Model;

use InfoTech\DAO\NotificacaoDAO;

final class Notificacao extends Model
{
    public int $id_funcionario;
    public int $ultima_vista = 0;
    public int $nao_lidas = 0;

    public function getRecentes(int $limite = 10): array
    {
        $objNot = new NotificacaoDAO();
        $this->ultima_vista = $objNot->selectUltimaVista($this->id_funcionario);
        $this->nao_lidas    = $objNot->countNaoLidas($this->ultima_vista);
        $this->rows         = $objNot->selectCategoriasRecentes($limite);

        return $this->rows;
    }

    public function marcarComoLidas(int $id_categoria): bool
    {
        $objNot = new NotificacaoDAO();
        return $objNot->updateUltimaVista($this->id_funcionario, $id_categoria);
    }
}
