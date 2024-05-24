<?php
namespace app\core;

class Router {
    private $routes = [];

    public function get($path, $handler) {
        $this->routes['GET'][$path] = $handler;
    }

    public function put($path, $handler) {
        $this->routes['PUT'][$path] = $handler;
    }

    public function delete($path, $handler) {
        $this->routes['DELETE'][$path] = $handler;
    }

    public function post($path, $handler) {
        $this->routes['POST'][$path] = $handler;
    }

    public function resolve($method, $path) {
        foreach ($this->routes[$method] as $route => $handler) {
            $routePattern = preg_replace('/\/{\w+}/', '/([^/]+)', $route);
            if (preg_match('#^' . $routePattern . '$#', $path, $matches)) {
                $params = array_slice($matches, 1);
                call_user_func_array($handler, $params);
                return;
            }
        }
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
    
}
?>