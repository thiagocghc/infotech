<?php

define('BASE_DIR', dirname(__FILE__, 2)); // VARIÁVEL CONSTANTE E GLOBAL
define('VIEW', BASE_DIR .  '/InfoTech/View'); // VARIÁVEL CONSTANTE E GLOBAL
define('URL_BASE', '/InfoTech');

$_ENV['db']['host'] = 'localhost';
$_ENV['db']['user'] = 'root';
$_ENV['db']['pass'] = '';
$_ENV['db']['database'] = 'infotech';
?>