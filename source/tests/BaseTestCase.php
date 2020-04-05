<?php 

namespace Tests;

use App\Core\PDO;
use App\Exceptions\ValidateException;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    protected $http; 

    public function setup()
    {
        $migrate = new \App\Database\Migration();
        $migrate();
        
        $pdo = new PDO(
            env('DB_HOST'),
            env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_CHARSET')
        );

        $pdo->connect();
    }

    public function expectValidationException()
    {
        $this->expectException(ValidateException::class);
    }
}