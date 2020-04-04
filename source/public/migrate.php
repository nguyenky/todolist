<?php

require_once __DIR__ . '/../vendor/autoload.php';

$migrate = new \App\Database\Migration();
$migrate();
die;
