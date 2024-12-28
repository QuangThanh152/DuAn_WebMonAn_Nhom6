<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đồ Án PHP - Nhóm 6</title>
    <!-- Font chữ -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/css/login.css" rel="stylesheet">
</head>
<body>
   <header>  
   <div class="logo">
        <a href="http://localhost/php-Workspace/DuAn_WebMonAn_Nhom6/">
            <i class="fas fa-utensils"></i> <!-- Biểu tượng đồ ăn từ Font Awesome -->
            <h2>HOLO Restaurant</h2>
        </a>
    </div>

        <nav class="navigation">
            <button class="btnlogin-popup">Login</button>
            <button class="btnlogin-popup">Register</button>
        </nav>
    </header>
    <div class="wrapper">
        <!-- Form đăng nhập -->
        <div class="form-box login">
            <h2>Login</h2>
            <form action="/php-Workspace/DuAn_WebMonAn_Nhom6/login" method="POST">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-outline"></ion-icon>
                    </span>
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#" class="register-link">Register</a>
                </div>
                <button type="submit" class="btn">Log in</button>
                <div class="login-register">
                    <p>Don't have an account?
                        <a href="#" class="register-link">Register</a>
                    </p>
                </div>
                <!-- Hiển thị thông báo lỗi nếu có -->
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </form>
        </div>

        <!-- Form đăng ký -->
        <div class="form-box register">
            <h2>Registration</h2>
            <form action="/php-Workspace/DuAn_WebMonAn_Nhom6/signup" method="POST">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </span>
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </span>
                    <input type="text" name="first_name" required>
                    <label>First name</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </span>
                    <input type="text" name="last_name" required>
                    <label>Last name</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-outline"></ion-icon>
                    </span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password" name="confirm_password" required>
                    <label>Confirm Password</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="call-outline"></ion-icon>
                    </span>
                    <input type="text" name="phone" required>
                    <label>Phone Number</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="location-outline"></ion-icon>
                    </span>
                    <input type="text" name="address" required>
                    <label>Address</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" required> I agree to the terms & conditions</label>
                </div>
                <button type="submit" class="btn">Sign Up</button>
                <div class="login-register">
                    <p>Already have an account?
                        <a href="#" class="login-link">Login</a>
                    </p>
                </div>
                <!-- Hiển thị thông báo lỗi nếu có -->
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <script src="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/js/scripts.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
