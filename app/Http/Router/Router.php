<?php

namespace App\Http\Router;

class Router
{
    protected static $routes = [];

    public static function get($route, $controller)
    {
        self::$routes['GET'][$route] = $controller;
    }

    public static function post($route, $controller)
    {
        self::$routes['POST'][$route] = $controller;
    }

    public static function put($route, $controller)
    {
        self::$routes['PUT'][$route] = $controller;
    }

    public static function delete($route, $controller)
    {
        self::$routes['DELETE'][$route] = $controller;
    }

    public static function patch($route, $controller)
    {
        self::$routes['PATCH'][$route] = $controller;
    }

    public static function update($route, $controller)
    {
        self::$routes['UPDATE'][$route] = $controller;
    }

    public static function dispatch($method, $uri)
    {
        if (isset(self::$routes[$method][$uri])) {
            $controller = self::$routes[$method][$uri];
            if ($controller instanceof \Closure) {
                return $controller();
            } elseif (is_array($controller)) {
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
        } else {
            return '404 Not Found';
        }
    }
}
