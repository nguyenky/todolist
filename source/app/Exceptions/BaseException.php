<?php

namespace App\Exceptions;

use Exception;

class BaseException extends Exception
{
    public function __construct($message, $code, $previous)
    {
        parent::__construct($message, $code, $previous);
    }
}
