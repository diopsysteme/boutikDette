<?php

namespace Core;

// class Route
// {
//     private static $routes = [];

//     public static function get($route, $controllerAction)
//     {
//         self::$routes['GET'][$route] = $controllerAction;
//     }

//     public static function post($route, $controllerAction)
//     {
//         self::$routes['POST'][$route] = $controllerAction;
//     }

//     public static function handleRequest()
//     {
//         $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//         $requestMethod = $_SERVER['REQUEST_METHOD'];
//         var_dump($requestMethod);
//         if (isset(self::$routes[$requestMethod][$requestUri])) {
//             $controllerAction = explode('@', self::$routes[$requestMethod][$requestUri]);
//             $controller = "Controller\\" . $controllerAction[0];
//             $action = $controllerAction[1];

//             $controllerInstance = new $controller();
//             $controllerInstance->$action();
//         } else {
//             http_response_code(404);
//             echo "Page not found";
//         }
//     }
// }
class Route
{
    private static $routes = [];

    public static function get($route, $controllerAction)
    {
        self::$routes['GET'][$route] = $controllerAction;
    }

    public static function post($route, $controllerAction)
    {
        self::$routes['POST'][$route] = $controllerAction;
    }

    public static function handleRequest()
    {
        $requestUri = self::cleanRequestUri($_SERVER['REQUEST_URI']);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        list($controllerName, $methodName, $params) = self::matchRoute($requestUri, $requestMethod);

        if ($controllerName === null || $methodName === null) {
            self::handleNotFound();
            return;
        }

        self::invokeControllerMethod($controllerName, $methodName, $params);
    }

    protected static function cleanRequestUri($requestUri)
    {
        $requestUri = explode('?', $requestUri)[0]; // Enlever les paramètres de requête
        return rtrim($requestUri, '/');
    }

    protected static function matchRoute($requestUri, $requestMethod)
    {
        foreach (self::$routes[$requestMethod] as $route => $routeConfig) {
            $routePattern = preg_replace('/#([a-zA-Z0-9_-]+)/', '([^/]+)', $route);
            $routePattern = '#^' . $routePattern . '$#';

            if (preg_match($routePattern, $requestUri, $matches)) {
                array_shift($matches); // Enlever le match complet
                $controllerName = "Controller\\" . $routeConfig['controller'];
                $methodName = $routeConfig['method'];
                return [$controllerName, $methodName, $matches];
            }
        }

        return [null, null, []];
    }

    protected static function handleNotFound()
    {
        $errorController = new ErrorController();
        
    }

    protected static function invokeControllerMethod($controllerName, $methodName, $params)
    {
        $reflectionClass = self::getReflectionClass($controllerName);

        if ($reflectionClass === null || !$reflectionClass->isInstantiable()) {
            http_response_code(404);
            echo "Controller not found or not instantiable";
            return;
        }

        if (!$reflectionClass->hasMethod($methodName) || !$reflectionClass->getMethod($methodName)->isPublic()) {
            http_response_code(404);
            echo "Method not found or not accessible";
            return;
        }

        $controllerInstance = $reflectionClass->newInstance();
        $reflectionClass->getMethod($methodName)->invokeArgs($controllerInstance, $params);
    }

    protected static function getReflectionClass($controllerName)
    {
        try {
            return new \ReflectionClass($controllerName);
        } catch (\ReflectionException $e) {
            return null;
        }
    }
}