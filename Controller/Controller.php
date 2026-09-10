<?php

namespace InfoTech\Controller; 

use InfoTech\Model\Model;

abstract class Controller
{
    final protected static function isLogged()
    {
        if( !isset($_SESSION['usuario_logado']))
            header("Location: /infotech/login");

    }

    // Para rotas chamadas via fetch: um redirect devolveria HTML e quebraria o response.json()
    final protected static function isLoggedJson(): void
    {
        if (!isset($_SESSION['usuario_logado'])) {
            $data = ['status' => 401, 'mensagem' => 'Sua sessão expirou. Faça login novamente.'];
            self::jsonResponse($data);
        }
    }

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


    // Envia uma resposta JSON e encerra o script
    final protected static function jsonResponse(array $data): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}