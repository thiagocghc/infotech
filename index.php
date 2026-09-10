<?php

session_start();

include 'config.php'; //define os diretórios os o autoload vai buscar
include 'autoload.php'; // busco as classes e faço o include de todas classes no INDEX
use InfoTech\Core\Router;

$router = new Router();

include './Core/routes.php';

$router->dispatch();