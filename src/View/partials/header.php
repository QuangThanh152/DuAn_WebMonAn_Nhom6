<link rel="stylesheet" href="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/css/header.css">
<header class="header">
    <div class="header-content">
        <a href="http://localhost/php-Workspace/DuAn_WebMonAn_Nhom6/" class="logo">Đặt đồ ăn Online</a>
        <!-- Menu Toggle Button -->
        <div class="menu-container">
            <button class="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>
            <!-- Dropdown menu -->
            <nav class="nav" id="nav">
                <a href="http://localhost/php-Workspace/DuAn_WebMonAn_Nhom6/" class="nav-link">
                    <i class="fa-solid fa-house"></i>
                    Trang chủ
                </a>
                <a href="http://localhost/php-Workspace/DuAn_WebMonAn_Nhom6/cart" class="nav-link cart" onclick="scrollToMenu()">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Giỏ hàng
                </a>
                <a href="#footer" class="nav-link" onclick="scrollToFinal()">
                    <i class="fa-solid fa-info-circle"></i>
                    Thông tin
                </a>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        Hello, <?php echo htmlspecialchars($_SESSION['user']['username']); // Sử dụng username trong session ?>
                    </a>
                    <a href="/php-Workspace/DuAn_WebMonAn_Nhom6/logout" class="nav-link" style="margin-right: 1rem;">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        Đăng Xuất
                    </a>
                <?php else: ?>
                    <a href="/php-Workspace/DuAn_WebMonAn_Nhom6/login" class="nav-link">
                        <i class="fa-solid fa-sign-in-alt"></i>
                        Đăng Nhập
                    </a>
                    <a href="/php-Workspace/DuAn_WebMonAn_Nhom6/admin" class="nav-link">
                        <i class="fa-solid fa-user-shield"></i>
                        Admin đăng nhập
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>
