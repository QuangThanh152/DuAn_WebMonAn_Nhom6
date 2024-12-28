<?php

use App\Core\Router;
use App\Controllers\ProductController;
use App\Controllers\LoginController;
use App\Controllers\CartController;

// Khởi tạo router
$router = new Router();
$router->addRoute('/^\/$/', [new ProductController(), 'listProducts']);
// Thêm routes cho ProductController
$router->addRoute('/^\/products$/', [new ProductController(), 'listProducts']);
$router->addRoute('/^\/product\/(\d+)$/', [new ProductController(), 'viewProduct']);
$router->addRoute('/^\/product\/create$/', [new ProductController(), 'createProduct']);
$router->addRoute('/^\/product\/edit\/(\d+)$/', [new ProductController(), 'editProduct']);
$router->addRoute('/^\/product\/delete\/(\d+)$/', [new ProductController(), 'deleteProduct']);

// Thêm routes cho LoginController
$router->addRoute('/^\/login$/', [new LoginController(), 'login']);
$router->addRoute('/^\/logout$/', [new LoginController(), 'logout']);
$router->addRoute('/^\/signup$/', [new LoginController(), 'signup']);
$router->addRoute('/^\/profile$/', [new LoginController(), 'profile']);

// Thêm routes cho CartController
$router->addRoute('/^\/cart$/', [new CartController(), 'viewCart']);
$router->addRoute('/^\/cart\/add\/(\d+)\/(\d+)$/', [new CartController(), 'addProductToCart']);
$router->addRoute('/^\/cart\/remove\/(\d+)$/', [new CartController(), 'removeProductFromCart']);
$router->addRoute('/^\/cart\/update\/(\d+)$/', [new CartController(), 'updateProductQtyInCart']);
$router->addRoute('/^\/cart\/checkout$/', [new CartController(), 'checkout']);

// Trả về đối tượng router
return $router;
?>
