<?php

use App\Core\Router;
use App\Controllers\MenuController;
require_once __DIR__ . '/../../config/utilities.php';


// Khởi tạo router
$router = new Router();

// Thêm routes cho MenuController
$router->addRoute('/\/admin\/menus/', [new MenuController(), 'index']);
$router->addRoute('/\/admin\/menus\/add/', [new MenuController(), 'add']);
$router->addRoute('/\/admin\/menus\/edit\/(\d+)/', [new MenuController(), 'edit']);
$router->addRoute('/\/admin\/menus\/delete\/(\d+)/', [new MenuController(), 'delete']);

use App\Controllers\AuthController;

// Route cho trang đăng nhập
$router->addRoute('/admin/login', [new AuthController(), 'login']);
$router->addRoute('/admin/logout', [new AuthController(), 'logout']);




// Trả về đối tượng router
return $router;
?>