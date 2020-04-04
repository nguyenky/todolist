<?php

namespace App\Exceptions;

class AppException extends BaseException
{
    public function __construct(\Throwable $previous = null)
    {

        parent::__construct(
            'Somethings has wrongs !!',
            400,
            $previous
        );
    }
}
