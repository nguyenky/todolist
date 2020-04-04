<?php

namespace App\Exceptions;

use Exception;

class HttpException extends Exception
{
    public function __construct()
    {
        parent::__construct('Route not found', 400, null);
    }
}
