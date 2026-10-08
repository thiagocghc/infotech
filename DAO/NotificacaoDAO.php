<?php

namespace InfoTech\DAO;

use PDO;

class NotificacaoDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    // Últimas categorias cadastradas, da mais nova para a mais antiga
    public function selectCategoriasRecentes(int $limite): array
    {
        $sql = "SELECT id_categoria, nome, data_cadastro
                  FROM categoria
                 ORDER BY id_categoria DESC
                 LIMIT ?";
        $stmt = parent::$connection->prepare($sql);
        $stmt->bindValue(1, $limite, PDO::PARAM_INT); // LIMIT precisa ser INT
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Id da última categoria que o funcionário já viu
    public function selectUltimaVista(int $id_funcionario): int
    {
        $sql = "SELECT ultima_categoria_vista FROM funcionario WHERE id_funcionario = ?";
        $stmt = parent::$connection->prepare($sql);
        $stmt->bindValue(1, $id_funcionario, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    // Quantas categorias foram cadastradas depois da última vista
    public function countNaoLidas(int $ultima_vista): int
    {
        $sql = "SELECT COUNT(*) FROM categoria WHERE id_categoria > ?";
        $stmt = parent::$connection->prepare($sql);
        $stmt->bindValue(1, $ultima_vista, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    // GREATEST evita "voltar" o marcador caso chegue um id menor
    public function updateUltimaVista(int $id_funcionario, int $id_categoria): bool
    {
        $sql = "UPDATE funcionario
                   SET ultima_categoria_vista = GREATEST(ultima_categoria_vista, ?)
                 WHERE id_funcionario = ?";
        $stmt = parent::$connection->prepare($sql);
        $stmt->bindValue(1, $id_categoria, PDO::PARAM_INT);
        $stmt->bindValue(2, $id_funcionario, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
