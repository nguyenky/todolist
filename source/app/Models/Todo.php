<?php
namespace App\Models;

use App\Core\EloquentModel;

class Todo extends EloquentModel
{
    protected $table = 'todos';
    
    protected $fillables = [
        'name',
        'start_date',
        'end_date',
        'status'
    ];
}
