<?php

namespace InfoTech\Core;

class Router
{
    private array $routes = [];
    private array $middleware = [];
    private string $prefix = '';
    private string $namespace = 'InfoTech\Controller';
    private bool $isAjax = false;

    public function __construct()
    {
        // Detectar se é requisição AJAX
        $this->isAjax = $this->detectAjax();
    }

    /**
     * Detectar se é requisição AJAX
     */
    private function detectAjax(): bool
    {
        return (
            (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
             strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
            (!empty($_POST['_ajax']) || !empty($_GET['_ajax']))
        );
    }

    /**
     * Registrar rota GET
     */
    public function get(string $path, string $controller, array $middleware = []): self
    {
        return $this->addRoute('GET', $path, $controller, $middleware);
    }

    /**
     * Registrar rota POST
     */
    public function post(string $path, string $controller, array $middleware = []): self
    {
        return $this->addRoute('POST', $path, $controller, $middleware);
    }

    /**
     * Registrar rota PUT
     */
    public function put(string $path, string $controller, array $middleware = []): self
    {
        return $this->addRoute('PUT', $path, $controller, $middleware);
    }

    /**
     * Registrar rota DELETE
     */
    public function delete(string $path, string $controller, array $middleware = []): self
    {
        return $this->addRoute('DELETE', $path, $controller, $middleware);
    }

    /**
     * Registrar para qualquer método
     */
    public function any(string $path, string $controller, array $middleware = []): self
    {
        foreach (['GET', 'POST', 'PUT', 'DELETE'] as $method) {
            $this->addRoute($method, $path, $controller, $middleware);
        }
        return $this;
    }

    /**
     * Agrupar rotas
     */
    public function group(string $prefix, callable $callback, array $middleware = []): void
    {
        $previousPrefix = $this->prefix;
        $previousMiddleware = [];

        if (!empty($middleware)) {
            $this->middleware[] = $middleware;
        }

        $this->prefix = $previousPrefix . $prefix;
        $callback($this);
        $this->prefix = $previousPrefix;

        if (!empty($middleware)) {
            array_pop($this->middleware);
        }
    }

    /**
     * Adicionar uma rota
     */
    private function addRoute(string $method, string $path, string $controller, array $middleware = []): self
    {
        $fullPath = $this->prefix . $path;
        [$controllerName, $action] = $this->parseController($controller);
        $pattern = $this->pathToRegex($fullPath, $params);
        $allMiddleware = array_merge(...$this->middleware, $middleware);

        $this->routes[] = [
            'method' => $method,
            'path' => $fullPath,
            'pattern' => $pattern,
            'controller' => $controllerName,
            'action' => $action,
            'params' => $params,
            'middleware' => $allMiddleware
        ];

        return $this;
    }

    /**
     * Converter caminho para regex
     */
    private function pathToRegex(string $path, &$params): string
    {
        $params = [];
        preg_match_all('/{([a-zA-Z_][a-zA-Z0-9_]*)}/', $path, $matches);

        if (!empty($matches[1])) {
            $params = $matches[1];
        }

        $pattern = preg_replace('/{[a-zA-Z_][a-zA-Z0-9_]*}/', '([a-zA-Z0-9_-]+)', $path);
        return '^' . $pattern . '$';
    }

    /**
     * Parsear Controller@action
     */
    private function parseController(string $controller): array
    {
        if (strpos($controller, '@') === false) {
            throw new \Exception("Formato inválido: '$controller'. Use 'Controller@action'");
        }

        [$name, $action] = explode('@', $controller, 2);
        return [$name, $action];
    }

    /**
     * Encontrar rota que corresponde
     */
    public function match(): ?array
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remover prefixo base
        $url = str_replace('/infotech', '', $url);
        if (empty($url)) {
            $url = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (!preg_match('~' . $route['pattern'] . '~', $url, $matches)) {
                continue;
            }

            $parameters = [];
            if (!empty($route['params'])) {
                array_shift($matches);

                foreach ($route['params'] as $index => $paramName) {
                    $parameters[$paramName] = $matches[$index] ?? null;
                }
            }

            return [
                'controller' => $route['controller'],
                'action' => $route['action'],
                'parameters' => $parameters,
                'middleware' => $route['middleware'],
                'path' => $route['path'],
                'isAjax' => $this->isAjax
            ];
        }

        return null;
    }

    /**
     * Disparar a rota
     */
    public function dispatch(): void
    {
        $route = $this->match();

        if ($route === null) {
            http_response_code(404);
            header('Content-Type: text/html');
            include VIEW . '/NotFound/notfound.php';
            return;
        }

        // Executar middleware
        $this->executeMiddleware($route['middleware']);

        // Instanciar e executar controller
        $fullClassName = $this->namespace . '\\' . $route['controller'] . 'Controller';

        if (!class_exists($fullClassName)) {
            throw new \Exception("Controller não encontrado: $fullClassName");
        }

        $controller = new $fullClassName();

        if (!method_exists($controller, $route['action'])) {
            throw new \Exception("Ação não encontrada: {$fullClassName}::{$route['action']}()");
        }

        // ✨ NOVO: Informar ao controller se é AJAX
        if (method_exists($controller, 'setIsAjax')) {
            $controller->setIsAjax($route['isAjax']);
        }

        // Chamar ação
        call_user_func_array(
            [$controller, $route['action']],
            $route['parameters']
        );
    }

    /**
     * Executar middleware
     */
    private function executeMiddleware(array $middleware): void
    {
        foreach ($middleware as $middlewareName) {
            $middlewareClass = "InfoTech\Middleware\\{$middlewareName}";

            if (!class_exists($middlewareClass)) {
                throw new \Exception("Middleware não encontrado: $middlewareClass");
            }

            $middlewareInstance = new $middlewareClass();

            if (!method_exists($middlewareInstance, 'handle')) {
                throw new \Exception("Middleware $middlewareName deve ter método handle()");
            }

            $middlewareInstance->handle();
        }
    }

    /**
     * Verificar se é requisição AJAX
     */
    public function isAjax(): bool
    {
        return $this->isAjax;
    }

    /**
     * Debug
     */
    public function debug(): void
    {
        echo "<pre>";
        echo "=== ROTAS REGISTRADAS ===\n\n";

        foreach ($this->routes as $route) {
            echo "{$route['method']} {$route['path']}\n";
            echo "  → {$route['controller']}@{$route['action']}\n";
            if (!empty($route['params'])) {
                echo "  → Params: " . implode(', ', $route['params']) . "\n";
            }
            echo "\n";
        }

        echo "</pre>";
    }

    /**
     * Obter rotas
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * Definir namespace
     */
    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;
        return $this;
    }
}