<?php
namespace App\Core;

class Router
{
    private $routes = [];

    public function addRoute($path, $callback)
    {
        $this->routes[] = ['path' => $path, 'callback' => $callback];
    }

    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $route) {
            if (preg_match($route['path'], $requestUri, $matches)) {
                array_shift($matches);
                call_user_func_array($route['callback'], $matches);
                return;
            }
        }

        // Nếu không tìm thấy route phù hợp, trả về 404
        http_response_code(404);
        echo "404 Not Found";
    }
}
?>