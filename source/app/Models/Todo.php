<?php
namespace App\Models;

use App\Core\EloquentModel;

class Todo extends EloquentModel
{
    const MIN_LENGTH = 10;
    const MAX_LENGTH = 100;

    protected $table = 'todos';
    
    protected $fillables = [
        'name',
        'start_date',
        'end_date',
        'status'
    ];
}
