<?php

namespace InfoTech\Model; // localizando onde está a classe ClienteModel

use InfoTech\DAO\ClienteDAO; // vou chamar um método da class DAO, use ClienteDAO

class Cliente
{
    public ?int $id_cliente;
    public string $nome;
    public string $status_cliente;
    public string $telefone;
    public string $email;
    public ?string $data_cadastro;

    public static function getAllRows()
    {   
        $objCli = new ClienteDAO();
        return $objCli->select();
        // return new ClienteDAO()->select();
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
}
