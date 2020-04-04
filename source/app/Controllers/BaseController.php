<?php

namespace App\Controllers;

abstract class BaseController
{
    /**
     * Response successful
     *
     * @param $message:    Message notification
     * @param $data:       Data return
     * @param $statusCode: StatusCode
     *
     * @return JsonResponse
     */
    protected function responseSuccessful($data = [], $statusCode = 200)
    {
        return response()->json(
            [
            'status' => true,
            'data' => $data,
            'statusCode' => $statusCode,
            ],
            $statusCode
        );
    }
}
