<?php
namespace App\Controllers;

require_once __DIR__ . '/../Models/AuthModel.php';
require_once __DIR__ . '/../../config/utilities.php';

class AuthController
{
    private $authModel;

    public function __construct()
    {
        $this->authModel = new \App\Models\AuthModel();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
    
            $user = $this->authModel->getUserByUsername($username);
    
            if ($user && $password == $user['password']) {
                if ($user['type'] == 1) { // Chỉ Admin mới được phép đăng nhập
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_type'] = $user['type']; // Lưu trữ kiểu người dùng vào phiên
                    redirect('layouts/indexadmin.php');
                } else {
                    flash('Bạn không có quyền đăng nhập vào hệ thống quản trị!', 'toast toast-warning');
                    redirect('login.php'); // Quay lại trang login
                }
            } else {
                flash('Sai tên đăng nhập hoặc mật khẩu', 'toast toast-error');
                redirect('login.php');
            }
        }
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: http://localhost/php-Workspace/DuAn_WebMonAn_Nhom6');
    }
}

// Kiểm tra yêu cầu logout
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    $authController = new AuthController();
    $authController->logout();
}
?>