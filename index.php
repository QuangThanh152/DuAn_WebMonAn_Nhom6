<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bao gồm các file cần thiết
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Core/Router.php';
require __DIR__ . '/config/credentials.php';

// Bao gồm các routes
$router = require __DIR__ . '/src/Core/routes.php';

// Xử lý request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseUri = parse_url(BASE_URL, PHP_URL_PATH);
$uri = str_replace($baseUri, '', $uri);

$router->match($uri);
?>
    