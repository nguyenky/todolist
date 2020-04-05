<?php

namespace App\Validation\Todo;

use App\Models\Todo;
use App\Validation\BaseValidation;

class CreateTodoValidation extends BaseValidation
{
    public function validator():array
    {
        return [
            'name' => [
                'required',
                'string',
                'minLength:' . Todo::MIN_LENGTH,
                'maxLength:' . Todo::MAX_LENGTH
            ],
            'start_date' => [
                'required',
                'date'
            ],
            'end_date' => [
                'required',
                'date'
            ],
            'status' => [
                'required'
            ]
        ];
    }
}
