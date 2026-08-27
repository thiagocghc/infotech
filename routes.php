<?php

use InfoTech\Controller\{ 
                        VendedorController, 
                        ClienteController, 
                        ProdutoController,
                    InicioController  };


$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// echo $url;

switch($url)
{
    case "/infotech/":
        InicioController::index();
    break;

    case "/infotech/cliente/listar":
        ClienteController::index();
    break;

    case "/infotech/cliente/cadastro":
        ClienteController::cadastro();
    break;

    case "/infotech/cliente/exclusao":
        ClienteController::exclusao();
    break;

    case "/infotech/admin":
        InicioController::notFound();
    break;
}