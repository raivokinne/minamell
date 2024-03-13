<?php

namespace App\Http\Router;

class Router
{
    protected $routes = [];

    public function get($route, $controller)
    {
        $this->routes['GET'][$route] = $controller;
    }

    public function post($route, $controller)
    {
        $this->routes['POST'][$route] = $controller;
    }

    public function dispatch($method, $uri)
    {
        if (isset($this->routes[$method][$uri])) {
            $controller = $this->routes[$method][$uri];
            list($class, $method) = $controller;
            if (class_exists($class)) {
                $controllerInstance = new $class();
                if (method_exists($controllerInstance, $method)) {
                    return $controllerInstance->$method();
                } else {
                    return '404 Not Found: Method not implemented';
                }
            } else {
                return '404 Not Found: Class not found';
            }
        } else {
            return '404 Not Found';
        }
    }
}
