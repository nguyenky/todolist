<?php

namespace App\Core;

class Request
{
    /**
     * @var string
     */
    private $uri;
    private $query;
    private $inputs = [];
    private $variables = [];
    private $match_route;

    /**
     * Request constructor.
     *
     * @param string $uri
     * @param $query
     */
    public function __construct($uri = '', $query = '', array $inputs = [])
    {
        $this->inputs = $inputs;
        $this->uri = $uri;
        $this->query = $query;
    }

    public function all()
    {
        return array_filter($this->inputs);
    }

    /**
     * @param  $key
     * @param  bool $default
     * @return bool
     */
    public function get($key, $default = false)
    {
        return $this->$key ?? $default;
    }

    public function set($key, $value = false)
    {
        $this->variables[$key] = $value;
        return $this;
    }

    public function post($key, $default = false)
    {
        return $this->$key ?? false;
    }

    public function only(array $arr = [])
    {
        $request = [];

        foreach ($arr as $ar) {
            $request[$ar] = $this->inputs[$ar] ?? null;
        }

        return array_filter($request);
    }

    public function parseUri()
    {
        return array_filter(explode('/', $this->uri));
    }


    public function __get($key)
    {

        return $this->$key;
    }

    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    public function requestBinding()
    {
    }

    public function getVariables()
    {
        return $this->variables;
    }
}
