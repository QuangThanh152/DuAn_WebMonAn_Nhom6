<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Header -->

<link rel="stylesheet" href="/php-Workspace/DuAn_WebMonAn_Nhom6/admin/assets/css/styles.css">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
<div class="header">
    <h1>Online Food Order - Admin Site</h1>
    <a href="/php-Workspace/DuAn_WebMonAn_Nhom6/admin/src/Controllers/AuthController.php?logout=true"
        class="logout-btn">
        <i class="fas fa-power-off"></i>
        <?php echo htmlspecialchars($_SESSION['username']); // Hiển thị tên người dùng từ phiên ?>
    </a>
</div>