<?php

namespace InfoTech\Controller; 

use InfoTech\Model\Model;

abstract class Controller
{
    final protected static function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === "POST";
    }

    final protected static function redirect(string $route): void
    {
        header("Location: $route");
    }

    final protected static function render(string $view, ?Model $model): void
    {
        include VIEW . $view;
    }
}