<?php

// Bao gồm các file cần thiết
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Core/Router.php';

// Bao gồm file chứa các hàm tiện ích
require_once __DIR__ . '/config/utilities.php';

// Bao gồm các routes
$router = require_once __DIR__ . '/../src/Core/routes.php';

// Xử lý request
// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $router->match($uri);

// Bao gồm file giao diện quản trị
require_once __DIR__ . '/src/View/layouts/indexadmin.php';
?>