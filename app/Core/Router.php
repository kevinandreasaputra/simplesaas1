<?php

namespace App\Core;

class Router
{

    private $routes = [];

    public function add($method, $path, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller
        ];
    }

    public function dispatch()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        $path = parse_url($path, PHP_URL_PATH);
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']); // /saas1/public

        if (strpos($path, $scriptDir) === 0) {
            $path = substr($path, strlen($scriptDir));
        }
        
        elseif (strpos($path, dirname($scriptDir)) === 0) {
            $path = substr($path, strlen(dirname($scriptDir)));
        }
        $path = preg_replace('#^/public/#', '', $path);

        $path = '/' . ltrim($path, '/');
        foreach ($this->routes as $route) {
            if ($route['path'] === $path && $route['method'] === $method) {
                [$controllerClass, $function] = $route['controller'];
                $controller = new $controllerClass();
                return $controller->$function();
            }
        }

        http_response_code(404);
        echo "404 Not Found - Path detected: " . $path;
    }
}
