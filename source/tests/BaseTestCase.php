<?php 

namespace Tests;

use App\Core\PDO;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    public function setup()
    {
        // $pdo = new PDO(
        //     env('DB_HOST'),
        //     env('DB_DATABASE'),
        //     env('DB_USERNAME'),
        //     env('DB_PASSWORD')
        // );

        // $pdo->connect();
    }
}