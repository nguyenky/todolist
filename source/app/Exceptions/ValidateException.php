<?php

namespace App\Exceptions;

use Exception;

class ValidateException extends Exception
{
    public function __construct($message, $code, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
