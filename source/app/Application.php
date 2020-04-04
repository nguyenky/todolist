<?php

namespace App;

use App\Core\Json;
use App\Core\Request;
use App\Core\Route;
use App\Exceptions\HttpException;
use App\Core\View;

class Application
{
    private $uri;
    public $router;
    private $httpMethod;
    private $queryString;
    private $inputs;

    public function __construct()
    {
        list(
            'path' => $this->uri,
            'query' => $this->queryString
        ) = array_merge(['query' => ''], parse_url($_SERVER['REQUEST_URI']));
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->inputs = $_REQUEST;
        $this->router = new Route();
    }

    /**
     * Handle Http Request
     */
    public function handleHttpRequest()
    {
        $request = new Request($this->uri, $this->queryString, $this->inputs);
        
        $match = $this->router->findRouter($this->httpMethod, $request->parseUri());
        if (!empty($match['variables'])) {
            foreach ($match['variables'] as $variable => $index) {
                $request->set($variable, $request->parseUri()[$index]);
            }
        }

        $handler = $match['handler'];

        if (is_null($handler)) {
            throw new HttpException();
        }

        list($controller, $action) = explode('@', $handler);
        $full_controller = "App\\Controllers\\$controller";

        $handle = new $full_controller;
        $response = $handle->$action($request);

        if ($response instanceof View) {
            $data = $response->getData();

            if (!empty($data)) {
                extract($data);
            }

            ob_start();
            include_once realpath('../' . $response->getViewPath());
            $content = ob_get_clean();
            include_once realpath('../resources/index.php');

            die();
        }

        if ($response instanceof Json) {
            header($response->getContentType());
            http_response_code($response->getStatusCode());
            echo $response->getContent();
            die();
        }
    }
}
