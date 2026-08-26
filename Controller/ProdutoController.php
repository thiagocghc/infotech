<?php

namespace InfoTech\Controller;

class ProdutoController
{
    public string $nome;
    public float $preco;

    public static function hello()
    {
        include VIEW . '/Produto/listar_produto.php';
    }
}