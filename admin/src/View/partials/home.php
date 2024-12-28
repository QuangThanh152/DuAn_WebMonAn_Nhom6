<?php
require_once __DIR__ . '/../../../config/credentials.php';
require_once __DIR__ . '/../../Controllers/HomeController.php';

$homeController = new \App\Controllers\HomeController();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="main-content">
    <!-- Nội dung trang chủ -->
    <div id="homeContent" class="active">
        <div class="dashboard">
            <div class="welcome-message">
                Chào mừng, <?php echo htmlspecialchars($_SESSION['username']); ?>!
            </div>

            <!-- Các thẻ thống kê -->
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Tổng số thực đơn đang hoạt động</h3>
                    <div class="number">
                        <b><?= number_format($homeController->getActiveMenusCount()) ?></b>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Tổng số thực đơn không hoạt động</h3>
                    <div class="number">
                        <b><?= number_format($homeController->getInactiveMenusCount()) ?></b>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Đơn hàng cần xác minh</h3>
                    <div class="number">
                        <b><?= number_format($homeController->getOrdersForVerificationCount()) ?></b>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Đơn hàng đã xác nhận</h3>
                    <div class="number">
                        <b><?= number_format($homeController->getConfirmedOrdersCount()) ?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>