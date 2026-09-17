<?php

namespace InfoTech\Model; // localizando onde está a classe ClienteModel

use InfoTech\DAO\CategoriaDAO; // vou chamar um método da class DAO, use ClienteDAO

final class Categoria extends Model
{
    public ?int $id_categoria;
    public string $nome;
    public string $descricao;

    public function getAllRows()
    {   
        $objCat = new CategoriaDAO();
        $this->rows = $objCat->select();
        return $this->rows;
    }

    public static function getById($id)
    {   
        //recebemos o ID capturado via GET
        $objCat = new CategoriaDAO();
        return $objCat->selectById($id);
    }

    public function save()
    {   
        $objCat = new CategoriaDAO();
        return $objCat->save($this);
    }

    public function delete(int $id)
    {   
        $objCat = new CategoriaDAO();
        return $objCli->delete($id);
    }
}
