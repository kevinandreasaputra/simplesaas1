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
        if (strpos($path, '/api') === 0) {
            header("Content-Type: application/json; charset=UTF-8");

            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
            header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                http_response_code(200);
                exit;
            }

            ini_set('display_errors', 0);
        }
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']); 

        if (strpos($path, $scriptDir) === 0) {
            $path = substr($path, strlen($scriptDir));
        } elseif (strpos($path, dirname($scriptDir)) === 0) {
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
