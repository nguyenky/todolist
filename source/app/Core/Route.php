<?php

namespace App\Core;

class Route
{
    private $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * @param  string $method
     * @param  array  $uri
     * @return mixed
     */
    public function findRouter(string $method, array $uri = [])
    {
        $routes = $this->getRoutesList($method);
        foreach ($routes as $route) {
            if (array_values($route['paths']) === $uri) {
                return $route;
            };

            if (count($route['paths']) === 0 || count($uri) !== count($route['paths'])) {
                continue;
            }

            $path_count = count($route['paths']);
            foreach (array_values($route['paths']) as $index => $route_partial) {
                if (preg_match("/{(\w+)}/", $route_partial) || $route_partial === array_values($uri)[$index]) {
                    if ($path_count === $index + 1) {
                        return $route;
                    }
                    continue;
                } elseif ($route_partial !== array_values($uri)[$index]) {
                    break;
                }
            }
        }
    }

    public function get($uri, $handler)
    {
        $uri = array_filter(explode('/', $uri));
        $variables = [];
        foreach ($uri as $index => $uri_partial) {
            if (preg_match("/{(\w+)}/", $uri_partial, $variable)) {
                $variables[$variable[1]] = $index;
            };
        }
        $this->routes['GET'][] = ['paths' => $uri, 'handler' => $handler, 'variables' => $variables];
    }

    public function post($uri, $handler)
    {
        $uri = array_filter(explode('/', $uri));

        $variables = [];
        foreach ($uri as $index => $uri_partial) {
            if (preg_match("/{(\w+)}/", $uri_partial, $variable)) {
                $variables[$variable[1]] = $index;
            };
        }
        $this->routes['POST'][] = ['paths' => $uri, 'handler' => $handler, 'variables' => $variables];
    }

    public function getRoutesList($method)
    {
        if (empty($this->routes[$method])) {
            return false;
        }

        return $this->routes[$method];
    }
}
