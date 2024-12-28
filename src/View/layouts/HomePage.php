<?php
// Kiểm tra và hiển thị thông báo chi tiết nếu có
if (isset($_SESSION['missing_info'])) {
    echo '<div class="alert alert-warning">' . $_SESSION['missing_info'] . '</div>';
    unset($_SESSION['missing_info']);
}

// Hiển thị thông báo lỗi nếu có
if (isset($error)) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
}
?>

<!-- Nội dung trang đăng nhập -->
<!-- ... -->

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
    <link rel="stylesheet" href="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/css/product-detail.css">
    <link rel="stylesheet" href="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/css/product_list.css">
    <link rel="stylesheet" href="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/css/cart_list.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            line-height: 1.5;
            background-color: #f9fafb;
        }
    </style>
</head>
<body>
    <!-- Include components -->
    <div id="header"><?php include __DIR__ . '/../partials/header.php'; ?></div>
    <?php if ($title == 'Danh sách sản phẩm') : ?>
        <div id="banner"><?php include __DIR__ . '/../partials/banner.php'; ?></div>
    <?php endif; ?>
    <br>
    <h1 class="menu-title">Thực đơn</h1>

    <main> <?php echo $content; ?> </main>
    <div id="menu"><?php include __DIR__ . '/../partials/menu.php'; ?></div>
    <div id="footer"><?php include __DIR__ . '/../partials/footer.php'; ?></div>

    <script src="../Components/JS/main.js"></script>
</body>
</html>
