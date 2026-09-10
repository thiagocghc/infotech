<?php

$router->add('GET',  '/infotech/', 'InicioController@index');

$router->add('GET',  '/infotech/login',  'LoginController@index');
$router->add('POST', '/infotech/login',  'LoginController@index');
$router->add('GET',  '/infotech/logout', 'LoginController@logout');

$router->add('GET',  '/infotech/cliente/listar', 'ClienteController@index');
$router->add('GET',  '/infotech/cliente/cadastro', 'ClienteController@cadastro');
$router->add('POST', '/infotech/cliente/cadastro', 'ClienteController@cadastro');
$router->add('GET',  '/infotech/cliente/exclusao', 'ClienteController@exclusao');

// Categoria (rotas usadas pelo JS via fetch, respondem JSON)
$router->add('GET',  '/infotech/categoria/listar',   'CategoriaController@listar');
$router->add('POST', '/infotech/categoria/cadastro', 'CategoriaController@cadastro');