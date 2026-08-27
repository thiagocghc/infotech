<?php

namespace InfoTech\Model; // localizando onde está a classe ClienteModel

use InfoTech\DAO\ClienteDAO; // vou chamar um método da class DAO, use ClienteDAO

final class Cliente extends Model
{
    public ?int $id_cliente;
    public string $nome;
    public string $status_cliente;
    public string $telefone;
    public string $email;
    public ?string $data_cadastro;

    public function getAllRows()
    {   
        $objCli = new ClienteDAO();
        $this->rows = $objCli->select();
        return $this->rows;
    }

    public static function getById($id)
    {   
        //recebemos o ID capturado via GET
        $objCli = new ClienteDAO();
        return $objCli->selectById($id);
    }

    public function save()
    {   
        $objCli = new ClienteDAO();
        return $objCli->save($this);
    }

    public function delete(int $id)
    {   
        $objCli = new ClienteDAO();
        return $objCli->delete($id);
    }
}
