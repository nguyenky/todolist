<?php

namespace App\Core;

class View
{
    private $viewPath;
    private $data;

    public function __construct(string $view_path, array $data = [])
    {
        $this->setViewPath($view_path);
        $this->data = $data;
    }

    /**
     * @param  $path
     * @return string
     */
    public function setViewPath($path)
    {
        $view_path = explode('.', $path);
        $full_path = 'resources';
        foreach ($view_path as $path) {
            $full_path .= '/' . $path;
        }
        $full_path .= '.php';
        $real_path = realpath('../' . $full_path);
        if (!$real_path || !file_exists($real_path)) {
            $full_path = 'resources/errors/404.php';
        }

        $this->viewPath = $full_path;
        return $full_path;
    }

    /**
     * @return string
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }

    /**
     * @return array
     */
    public function getData():array
    {
        return $this->data;
    }
}
