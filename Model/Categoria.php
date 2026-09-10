<?php

namespace InfoTech\Model;

use InfoTech\DAO\CategoriaDAO;

final class Categoria extends Model
{
    public ?int $id_categoria = null;
    public string $nome;
    public ?string $descricao = null;

    public function getAllRows()
    {
        $objCat = new CategoriaDAO();
        $this->rows = $objCat->select();
        return $this->rows;
    }

    public function save()
    {
        $objCat = new CategoriaDAO();
        return $objCat->save($this);
    }
}
