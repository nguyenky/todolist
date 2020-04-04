<?php

namespace App\Core;

use App\Core\View;

class Response
{
    /**
     * @param  array $json_like
     * @param  int   $status_code
     * @return Json
     */
    public function json(array $json_like = [], int $status_code = 200)
    {
        return new Json(json_encode($json_like), $status_code);
    }

    public function view($view_path, array $data = [])
    {
        return new View($view_path, $data);
    }
}
