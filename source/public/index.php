<?php

use App\Exceptions\Handler;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Require all controller 
 */
foreach (glob("../app/Controllers/*.php") as $filename) {
    include $filename;
}

require_once('../app/Application.php');
ini_set('display_errors', 'On');

$app = new App\Application();

require_once('../routes/routes.php');

try {
    $app->handleHttpRequest();
} catch (\Exception $e) {
    $exception = new Handler();
    $exception($e);
}
