<?php

namespace App\Exceptions;

use Exception;
use App\Exceptions\BaseException;
use App\Core\Json;

class Handler
{
    public function __invoke(Exception $exception)
    {
        switch (true) {
            case $exception instanceof BaseException:
                $statusCode = 400;
                $type = 'ApplicationException';
                $message = $exception->getMessage();
                break;
            case $exception instanceof HttpException:
                $statusCode = 404;
                $type = 'HttpException';
                $message = $exception->getMessage();
                break;
            default:
                $message = $exception->getMessage();
                $statusCode = 500;
                $type = 'InternalError';
        }


        if (!isApi()) {
            include_once realpath('../resources/errors/404.php');

            die();
        }

        $json = new Json(
            json_encode(
                [
                'message' => $message,
                'type'  => $type,
                'code'    => $statusCode
                ]
            ),
            $statusCode
        );

        header($json->getContentType());
        http_response_code($json->getStatusCode());
        echo $json->getContent();
        die();
    }
}
