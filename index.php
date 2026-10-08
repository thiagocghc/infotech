<?php

include 'config.php'; //define os diretórios os o autoload vai buscar
include 'autoload.php'; // busco as classes e faço o include de todas classes no INDEX

// session_start DEPOIS do autoload: a sessão guarda um objeto Funcionario,
// e o PHP precisa da classe carregada para reconstruí-lo
session_start();
use InfoTech\Core\Router;

$router = new Router();

include './Core/routes.php';

$router->dispatch();