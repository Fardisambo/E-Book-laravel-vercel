<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

<<<<<<< HEAD
// Nonaktifkan error reporting untuk deprecation warning
error_reporting(E_ALL & ~E_DEPRECATED);
=======

>>>>>>> 4afc5abff62504e955b6769ecdebd281dcc1d4fe

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
