<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;
use App\Models\UserInfoModel;

class LoginController extends Controller {
    private $userModel;
    private $userInfoModel;

    public function __construct() {
        $conn = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->userModel = new UserModel($conn);
        $this->userInfoModel = new UserInfoModel($conn);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userModel->getUserByUsername($username);

            if ($user === false) {
                $error = 'Username không tồn tại';
            } elseif ($password !== $user['password']) {
                $error = 'Mật khẩu không đúng';
            } elseif ($user['type'] != 2) {
                $error = 'Chỉ người dùng có thể đăng nhập';
            } else {
                // Lấy thông tin từ UserInfoModel
                $userInfo = $this->userInfoModel->getUserInfoById($user['id']);
                
                // Đăng nhập thành công và lưu thông tin vào session
                $_SESSION['user'] = [
                    'user_id' => $user['id'], // Lưu user_id vào session
                    'username' => $user['username'],
                    'name' => $user['first_name'] . ' ' . $user['last_name'],
                    'address' => $userInfo['address'],
                    'mobile' => $userInfo['mobile'],
                    'email' => $userInfo['email'],   
                ];
                $this->redirect('/products');
                return;
            }
            // Hiển thị thông báo lỗi cụ thể trong cùng trang
            $this->renderLoginPage($error);
        } else {
            $this->renderLoginPage();
        }
    }

    private function renderLoginPage($error = null) {
        // Chuyển đổi sang biến toàn cục để sử dụng trong HTML
        global $error;
        include __DIR__ . '/../View/layouts/LoginPage.php';
    }

    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        $this->redirect('/login');
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            if ($password !== $confirmPassword) {
                $error = 'Mật khẩu không khớp';
                $this->renderLoginPage($error);
                return;
            }

            $existingUser = $this->userModel->getUserByUsername($username);
            if ($existingUser) {
                $error = 'Tên người dùng đã tồn tại';
                $this->renderLoginPage($error);
                return;
            }

            $result = $this->userModel->createUser($username, $password, $firstName, $lastName, $email, $phone, $address);
            if ($result) {
                // Đăng ký thành công, chuyển hướng đến trang đăng nhập
                $this->redirect('/login');
            } else {
                $error = 'Tạo người dùng thất bại';
                $this->renderLoginPage($error);
            }
        } else {
            $this->renderLoginPage();
        }
    }
}
?>
