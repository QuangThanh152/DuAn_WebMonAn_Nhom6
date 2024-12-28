<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config/utilities.php'; // Bao gồm file utilities.php

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user_id'])) {
    redirect('index.php');
}

// Bao gồm controller
require_once __DIR__ . '/src/Controllers/AuthController.php';

$authController = new \App\Controllers\AuthController();
$authController->login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/css/Login.css">
</head>

<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <!-- Thông báo kiểu toast -->
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div id="toast-container">
                <div class="<?php echo $_SESSION['flash_type']; ?>">
                    <?php echo $_SESSION['flash_message']; ?>
                </div>
            </div>
            <?php unset($_SESSION['flash_message'], $_SESSION['flash_type']); ?>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

    <script>
        // Tự động ẩn thông báo sau 3 giây
        setTimeout(() => {
            const toast = document.querySelector('.toast');
            if (toast) {
                toast.style.display = 'none';
            }
        }, 3000);
    </script>
</body>

</html>
